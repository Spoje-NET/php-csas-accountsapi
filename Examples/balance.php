<?php

use Ease\Shared as Shr;
use Ease\Functions as Fnc;

require_once dirname(__DIR__) . '/vendor/autoload.php';

Shr::init([], dirname(__DIR__) . '/.env');

$apiInstance = new \SpojeNET\Csas\Accounts\DefaultApi(new SpojeNET\Csas\ApiClient(
    [
'apikey' => \Ease\Shared::cfg('API_KEY'),
'token' => \Ease\Shared::cfg('API_TOKEN'),
'debug' => \Ease\Shared::cfg('API_DEBUG', false),
'sandbox' => \Ease\Shared::cfg('SANDBOX_MODE')
]
));

try {
    $result = $apiInstance->getAccountBalance(\Ease\Shared::cfg('ACCOUNT'));
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->getAccountBalance: ', $e->getMessage(), PHP_EOL;
}
