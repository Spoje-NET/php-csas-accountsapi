<?php
/**
 * Start the PHP development server from root with the command: php -S localhost:80 -t Examples/
 */
require_once __DIR__ . '/../vendor/autoload.php';

// For better show response problems
class ResponseException extends Exception
{
  private array $context;

  public function __construct(string $message, int $code, array $context) {
    parent::__construct($message, $code);
    $this->context = $context;
  }

  public function getContext(): array
  {
    return $this->context;
  }
}

// Persistent storage
class Storage
{
  private ?array $values = null;
  private SplFileInfo $file;

  public function __construct(SplFileInfo $file)
  {
    $this->file = $file;
  }

  public function __destruct()
  {
    if (isset($this->values)) {
      file_put_contents($this->file->getPathname(), serialize($this->values));
    }
  }

  /**
   * @return mixed
   */
  public function read(string $key)
  {
    $this->values ??= unserialize(@file_get_contents($this->file->getPathname()) ?: 'a:0:{}');

    return $this->values[$key] ?? null;
  }

  /**
   * @param mixed $value
   */
  public function write(string $key, $value): void
  {
    $this->values[$key] = $value;
  }
}


// Initialization *****************************************************************************************************
const AccessTokenKey = 'accessToken';
const RefreshTokenKey = 'refreshToken';
define('RootDir', dirname(__DIR__));
Ease\Shared::init([], RootDir . '/.env');
// global instance for token storage
$storage = new Storage(new SplFileInfo(RootDir . '/.storage'));

// Checks config ******************************************************************************************************
if (empty(Ease\Shared::cfg('API_KEY'))) throw new RuntimeException('Missing API_KEY');
if (empty(Ease\Shared::cfg('CLIENT_ID'))) throw new RuntimeException('Missing CLIENT_ID');
if (empty(Ease\Shared::cfg('CLIENT_SECRET'))) throw new RuntimeException('Missing CLIENT_SECRET');
if (empty(Ease\Shared::cfg('REDIRECT_URI'))) throw new RuntimeException('Missing REDIRECT_URI');
// for this example must be REDIRECT_URI=http://localhost/redirectedFromBank, don't forget changed in Erste Group system
if (Ease\Shared::cfg('REDIRECT_URI') !== 'http://localhost/redirectedFromBank') throw new RuntimeException('Invalid REDIRECT_URI for this example');

// Sandbox URLs *******************************************************************************************************
const CsasSandboxUrl = 'https://webapi.developers.erstegroup.com/api/csas';
const CsasOAuthUrl = CsasSandboxUrl . '/sandbox/v1/sandbox-idp';
const CsasAccountsUrl = CsasSandboxUrl . '/public/sandbox/v3/accounts';


// Utilities **********************************************************************************************************

/**
 * Just for fancy
 */
function writeLabel(string $label): void
{
  static $level = 2;
  echo "<h{$level}>{$label}</h{$level}>";
  if ($level < 5) $level++;
}

/**
 * For better show output
 */
function writeOutput($output): void
{
  $output = is_string($output) ? $output : var_export($output, true);
  echo "<pre>\n{$output}</pre>";
}

/**
 * For fancy show money
 */
function formatMoney(?float $amount, string $currency): string
{
  if ($amount === null) return '';

  $thinSpace = "\xE2\x80\x89";
  $nonBreakSpace = "\xC2\xA0";

  return number_format($amount, 2, '.', $thinSpace) . $nonBreakSpace . $currency;
}

/**
 * This function replacing some HTTP client to send requests
 *
 * @param non-empty-string $method "GET"|"POST"
 * @param array<non-empty-string, string|int>|null $data
 * @param array<non-empty-string, string>|null $headers
 * @return string|array<non-empty-string, mixed>
 * @throws InvalidArgumentException|ResponseException|JsonException
 */
function sendRequest(string $method, string $url, ?array $data = null, ?array $headers = null)
{
  $ch = curl_init();

  switch (strtoupper($method)) {
    case 'GET':
      curl_setopt($ch, CURLOPT_HTTPGET, true);
      $url .= isset($data) ? ('?' . http_build_query($data)) : '';
      break;
    case 'POST':
      if (empty($data)) throw new InvalidArgumentException('Data for POST missing');
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
      break;
    default:
      throw new InvalidArgumentException("Unknown method, given '{$method}'");
  }

  if (!empty($headers)) {
    $hdrs = [];
    foreach ($headers as $name => $value) {
      $hdrs[] = "{$name}: {$value}";
    }
    curl_setopt($ch, CURLOPT_HTTPHEADER, $hdrs);
  }

  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $response = curl_exec($ch);
  $info = curl_getinfo($ch);
  $errMsg = curl_error($ch);
  $errCode = curl_errno($ch);

  curl_close($ch);

  if ($errCode > 0) throw new ResponseException($errMsg, $errCode, $info);

  if (preg_match('~application/json~', $info['content_type']) !== false) {
    $response = json_decode($response, true, 512, JSON_THROW_ON_ERROR);
  }

  if ($info['http_code'] != 200) {
    $isArray = is_array($response);
    writeOutput($response);
    $message = $isArray ? ($response['error_description'] ?? trim(array_reduce($response['errors'] ?? [], fn(string $carry, array $err) => $carry . ' ' . $err['error'] ?? '', '')) ?: 'Unknown error') : $response;
    $code = $isArray ? ($response['error_code'] ?? $response['status'] ?? 0) : $info['http_code'];
    throw new ResponseException($message, (int)$code, ['headers' => $headers, 'data' => $data, 'CURL' => $info]);
  }

  return $response;
}

/**
 * Basic headers with authorization
 */
function createAuthHeaders(): array
{
  return [
    'WEB-API-key' => Ease\Shared::cfg('API_KEY'),
    'Authorization' => 'Bearer ' . loadAccessToken(),
    'Content-Type' => 'application/json',
  ];
}


// Work with tokens ***************************************************************************************************

function saveAccessToken(string $token, int $secondsExpiration): void
{
  global $storage;

  if (empty($token)) throw new InvalidArgumentException('Access token cannot be empty');
  if ($token <= 0) throw new InvalidArgumentException("Seconds of expiration must be greater than 0, given {$secondsExpiration}");

  $storage->write(AccessTokenKey, [$token, new DateTimeImmutable("+{$secondsExpiration} seconds")]);
}

function saveRefreshToken(string $token): void
{
  global $storage;

  if (empty($token)) throw new InvalidArgumentException('Refresh token cannot be empty');

  $storage->write(RefreshTokenKey, $token);
}

function readAccessToken(): ?string
{
  global $storage;

  /** @var string|null $token */
  /** @var DateTimeImmutable|null $expiration */
  [$token, $expiration] = (array)$storage->read(AccessTokenKey) + [null, null];

  if ($expiration === null || $expiration->getTimestamp() < time()) return null;

  return $token;
}

function readRefreshToken(): ?string
{
  global $storage;
  return $storage->read(RefreshTokenKey);
}

/**
 * Complete logic for obtaining an access token, including renewal after expiration
 */
function loadAccessToken(): ?string
{
  $accessToken = readAccessToken();

  if (empty($accessToken)) {
    $refreshToken = readRefreshToken();

    if (empty($refreshToken)) throw new RuntimeException('Refresh token not found, authorization required');

    $data = [
      'client_id' => Ease\Shared::cfg('CLIENT_ID'),
      'client_secret' => Ease\Shared::cfg('CLIENT_SECRET'),
      'grant_type' => 'refresh_token',
      'refresh_token' => $refreshToken,
    ];

    $response = sendRequest('POST', CsasOAuthUrl . '/token', $data);

    if (!array_key_exists('access_token', $response)) throw new ResponseException('Missing access token in response from bank', 404, $response);

    saveAccessToken($response['access_token'], $response['expires_in'] ?? 300);

    $accessToken = readAccessToken();
  }

  return $accessToken;
}


// Router's handlers for page *****************************************************************************************

/**
 * Default handler showing whether authorization is required
 */
function status(): void
{
  writeLabel('Status');
  writeLabel(readRefreshToken()
    ? '✅ <small>No authorization needed</small>'
    : '⚠️ <small>Authorization required</small>'
  );
}

/**
 * Handler for creating an authorization URL and redirects to it
 */
function redirectToAuth(): void
{
  writeLabel('Redirect to authorization');

  $url = CsasOAuthUrl . '/auth?' . http_build_query([
    'client_id' => Ease\Shared::cfg('CLIENT_ID'),
    'response_type' => 'code',
    'redirect_uri' => Ease\Shared::cfg('REDIRECT_URI'),
    'state' => Ease\Functions::randomString(),
    'access_type' => 'offline',
    'scope' => implode('%20', [
      'siblings.accounts',
      // 'siblings.payments',
      // 'AISP',
      // 'PISP'
    ]),
  ]);
  header("Location: {$url}");
}

/**
 * After authorization, this handler processes the request and stores the tokens
 */
function handleRedirectFromBank(): void
{
  writeLabel('Processing redirect from bank');

  // check URL params
  if (!array_key_exists('code', $_GET)) throw new Exception('Missing authorization code in URL');

  $data = [
    'client_id' => Ease\Shared::cfg('CLIENT_ID'),
    'client_secret' => Ease\Shared::cfg('CLIENT_SECRET'),
    'grant_type' => 'authorization_code',
    'code' => $_GET['code'],
    'redirect_uri' => Ease\Shared::cfg('REDIRECT_URI'),
  ];

  $response = sendRequest('POST', CsasOAuthUrl . '/token', $data);

  if (!array_key_exists('refresh_token', $response)) throw new ResponseException('Missing refresh token in response from bank', 404, $response);
  if (!array_key_exists('access_token', $response)) throw new ResponseException('Missing access token in response from bank', 404, $response);

  saveRefreshToken($response['refresh_token']);
  saveAccessToken($response['access_token'], $response['expires_in'] ?? 300);

  writeLabel('Scope');
  writeOutput($response['scope']);
}

/**
 * Handler for listing available accounts
 */
function listAccounts(): void
{
  writeLabel('List accounts');

  $data = [
    'size' => 10,
    'page' => 0,
    'sort' => 'iban',
    'order' => 'asc',
  ];
  $headers = createAuthHeaders();
  $response = sendRequest('GET', CsasAccountsUrl . '/my/accounts', $data, $headers);

  class Account
  {
    public string $id;
    public string $iban;
    public string $code;
    public string $currency;
    public string $name;
    public string $product;

    public function __construct(array $data) {
      $this->id = $data['id'] ?? 'MISSING';
      $this->iban = $data['identification']['iban'] ?? 'MISSING';
      $this->code = $data['identification']['other'] ?? 'MISSING';
      $this->currency = $data['currency'];
      $this->name = $data['nameI18N'] ?? 'MISSING';
      $this->product = $data['productI18N'] ?? 'MISSING';
    }
  }

  echo '<table>';
  echo '<tr><th>Name</th><th>Product</th><th>IBAN</th><th>Currency</th><th></th></tr>';
  foreach ($response['accounts'] as $accountData) {
    $act = new Account($accountData);
    echo <<<TABLE
      <tr>
        <td>{$act->name}</td>
        <td>{$act->product}</td>
        <td>{$act->iban}</td>
        <td>{$act->currency}</td>
        <td><a href="/detail?id={$act->id}">info</a></td>
      </tr>
      TABLE;
  }
  echo '</table>';
}

/**
 * Handler for show balance and listing transaction of selected account
 */
function accountDetail(): void
{
  writeLabel('Detail account');

  $accountId = $_GET['id'] ?? '';

  if (preg_match('~^[0-9A-F]{40}$~', $accountId) === false) throw new RuntimeException('Invalid account id');

  // Balance
  writeLabel('Balance');
  $headers = createAuthHeaders();
  $response = sendRequest('GET', CsasAccountsUrl . "/my/accounts/{$accountId}/balance", null, $headers);

  $balance = array_pop($response['balances']) ?? null;
  if (empty($balance)) {
    echo '<p>🤷‍♂️</p>';
  } else {
    $amount = $balance['amount']['value'];
    if ($balance['creditDebitIndicator'] === 'DBIT') $amount *= -1;
    $money = formatMoney($amount, $balance['amount']['currency']);
    echo "<p>{$money}</p>";
  }

  // Transactions
  writeLabel('Transactions');
  $data = [
    'fromDate' => date('Y-m-d', strtotime('-1 month')),
    'toDate' => date('Y-m-d'),
    'size' => 20,
    'page' => 0,
    'sort' => 'bookingdate',
    'order' => 'desc',
  ];
  $response = sendRequest('GET', CsasAccountsUrl . "/my/accounts/{$accountId}/transactions", $data, $headers);

  class Transaction {
    public string $booked;
    public ?float $amount;
    public string $currency;
    public string $description;

    public function __construct(array $data) {
      $this->booked = $data['bookingDate']['date'] ?? 'MISSING';
      $this->currency = $data['amount']['currency'] ?? 'MISSING';
      $this->description = $data['entryDetails']['transactionDetails']['additionalTransactionInformation'] ?? '🤷‍♂️';

      $this->amount = $data['amount']['value'] ?? null;
      if (isset($this->amount) && $data['creditDebitIndicator'] === 'DBIT') $this->amount *= -1;
    }
  }

  echo '<table>';
  echo '<tr><th>Booked</th><th>Amount</th><th>Description</th></tr>';
  foreach ($response['transactions'] as $transactionData) {
    $trn = new Transaction($transactionData);
    $money = formatMoney($trn->amount, $trn->currency);

    echo <<<TABLE
      <tr>
        <td class="mono">{$trn->booked}</td>
        <td style="text-align:right">{$money}</td>
        <td>{$trn->description}</td>
      </tr>
      TABLE;
  }
  echo '</table>';
}


// Application logic **************************************************************************************************
function run(): void
{
  try {
    /**
     * Router must cover all required paths
     * @var array<string, callable> $routerByUrlPath
     */
    $routerByUrlPath = [
      '/' => fn() => status(),
      '/auth' => fn() => redirectToAuth(),
      '/redirectedFromBank' => fn() => handleRedirectFromBank(),
      '/accounts' => fn() => listAccounts(),
      '/detail' => fn() => accountDetail(),
    ];

    $path = $_SERVER['PATH_INFO'] ?? '/';
    $action = $routerByUrlPath[$path] ?? null;

    if (empty($action)) throw new Exception("Action for path missing, given '{$path}'");

    $action();

  } catch (ResponseException $exc) {
    writeLabel("Response error [{$exc->getCode()}]: <small>{$exc->getMessage()}</small>");
    writeLabel('Context');
    writeOutput($exc->getContext());
    writeLabel('Trace');
    writeOutput(str_replace(RootDir . '/', '', $exc->getTraceAsString()));

  } catch (Throwable $exc) {
    $error = get_class($exc);
    writeLabel("{$error}: <small>{$exc->getMessage()}</small>");
    writeLabel('Trace');
    writeOutput(str_replace(RootDir . '/', '', $exc->getTraceAsString()));
  }
}


// HTML ***************************************************************************************************************
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>CSAS</title>
  <link rel="icon" type="image/png" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAAIGNIUk0AAHomAACAhAAA+gAAAIDoAAB1MAAA6mAAADqYAAAXcJy6UTwAAAD8UExURShw7Shw7Shw7Shw7Sdv7S507i907iZv7SZu7Shw7SZv7U2J8LrR+bzS+VCK8J2+9////6PC9ydv7SZu7YGr9Pv8//z9/4au9SVu7S507mud82yd8y917kuH8I+09pe69pS49pK29pi69o609kqG8Cdw7TJ27sLW+sTY+jJ37j5+7+Hr/dnm/MHW+sLX+q3J+Dh77j1+7+Dq/KLB92ia8mqc82uc82GW8uPs/f39//3+//v9/9zo/D5/7zZ67qXD+LvS+dXj/OLs/T9/72SY8m2e86bE+Dp87v7+/93o/Dp87ypx7Yuy9eTt/erx/Yyz9Sty7UCA70eF8EGA757JW7wAAAAJdFJOUzbB+Pr6+vr6+pvscZ0AAAABYktHRBCVsg0sAAAACXBIWXMAAFxGAABcRgEUlENBAAAAB3RJTUUH5wQNCyEodQCtfwAAAMNJREFUGNMtj9d2wkAMRNe7NJsmlmbAJPTeS4IpAULvhPz/vyAt3JfRuWceNIxpXAjhcLocGFxjTNMRw+vzBwy6NMaVCAKEJF2cCYpwJBqLq4YgYZhmIpmyTNN4CZn++Mxks5lcviBJFEtleFOpFlHIWh0azRZSaXckiW4P+oMh8vVt6UqMAGzbHk+i05lq/Mz9C8S3hN8VCd1ab4jh9i3krgExYg+HIwqun86Xq+JyO+HrOO7+91D832kczXd7FG6a/wRQUBvXZgD5igAAACV0RVh0ZGF0ZTpjcmVhdGUAMjAyMy0wNC0xM1QxMDoyMDowOSswMDowMCIZpIUAAAAldEVYdGRhdGU6bW9kaWZ5ADIwMjMtMDQtMTNUMTA6MjA6MDkrMDA6MDBTRBw5AAAAKHRFWHRkYXRlOnRpbWVzdGFtcAAyMDIzLTA0LTEzVDExOjMzOjQwKzAwOjAw4qzLiQAAAABJRU5ErkJggg==">
  <style>
    :root { --light: #ddd; --dark: #111 }
    body { font-family: ui-sans-serif, system-ui, sans-serif; background-color: var(--light); color: var(--dark) }
    pre, textarea, .mono { font-family: ui-monospace, monospace }
    h1 { font-size: 2.4rem }
    h2 { font-size: 2.1rem }
    h3 { font-size: 1.8rem }
    h4 { font-size: 1.5rem }
    h5 { font-size: 1.3rem }
    a { color: dodgerblue }
    table { border-collapse: collapse }
    th, td { padding: .25rem .5rem }
    tr { border-bottom: 1px solid currentColor }
    tr:has(td):hover { background-color: rgb(from currentColor r g b / .1) }
    @media (prefers-color-scheme: dark) {
      body { background-color: var(--dark); color: var(--light) }
    }
  </style>
</head>
<body>
<h1>Erste Group connection example</h1>
<nav>
  <a href="/">status</a>
  <a href="/auth">authorization</a>
  <a href="/accounts">accounts</a>
</nav>
<?php run(); ?>
</body>
</html>