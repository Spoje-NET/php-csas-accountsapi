<?php

declare(strict_types=1);

/**
 * This file is part of the CSasWebApi package
 *
 * https://github.com/Spoje-NET/php-csas-webapi
 *
 * (c) SpojeNetIT <http://spoje.net/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SpojeNet\CSas;

/**
 * Description of Statementor.
 *
 * @author vitex
 *
 * @no-named-arguments
 */
class Statementor extends \Ease\Sand
{
    use \Ease\Logger\Logging;
    public \DateTime $since;
    public \DateTime $until;
    public string $currency = 'CZK';

    /**
     * DateTime Formating eg. 2021-08-01T10:00:00.0Z.
     */
    public static string $dateTimeFormat = 'Y-m-d\\TH:i:s.0\\Z';

    /**
     * DateTime Formating eg. 2021-08-01T10:00:00.0Z.
     */
    public static string $dateFormat = 'Y-m-d';
    private string $scope;
    private string $accountNumber = '';
    private string $accountUuid = '';

    public function __construct(string $accountUuid, string $accountNumber = '', string $scope = '')
    {
        $this->setAccountUuid($accountUuid);

        if ($accountNumber) {
            $this->setAccountNumber($accountNumber);
        }

        if ($scope) {
            $this->setScope($scope);
        }
    }

    /**
     * Set AccountNumber for further operations.
     *
     * @param string $accountNumber
     *
     * @return Statementor
     */
    public function setAccountNumber($accountNumber)
    {
        $this->accountNumber = $accountNumber;
        $this->setObjectName($accountNumber.'@'.\get_class($this));

        return $this;
    }

    /**
     * Obtain Statements from ČSas.
     *
     * @param string $format pdf, xml, xml-data, abo-standard, abo-internal, abo-standard-extended, abo-internal-extended, csv-comma, csv-semicolon, mt940
     */
    public function getStatements($format = 'pdf'): array
    {
        $apiInstance = new \SpojeNet\CSas\Accounts\DefaultApi();
        $page = 0;
        $statements = [];
        $this->addStatusMessage(sprintf(_('Request %s statements from %s to %s'), $format, $this->since->format(self::$dateFormat), $this->until->format(self::$dateFormat)), 'debug');

        try {
            do {
                $result = $apiInstance->getAccountStatements($this->getAccountUuid(), $this->getSince()->format('Y-m-d'), $this->getUntil()->format('Y-m-d'), $format);

                if ($result->getAccountStatements()) {
                    $statements = array_merge($statements, $result->getAccountStatements());
                } else {
                    $this->addStatusMessage(sprintf(_('No transactions from %s to %s'), $this->since->format(self::$dateFormat), $this->until->format(self::$dateFormat)));
                }
            } while ($result->getNextPage());
        } catch (\Ease\Exception $e) {
            echo 'Exception when calling GetTransactionListApi->getTransactionList: ', $e->getMessage(), \PHP_EOL;
        }

        return $statements;
    }

    /**
     * Prepare processing interval.
     *
     * @param mixed $scope
     *
     * @throws \Exception
     */
    public function setScope($scope): \DatePeriod
    {
        switch ($scope) {
            case 'yesterday':
                $this->since = (new \DateTime('yesterday'))->setTime(0, 0);
                $this->until = (new \DateTime('yesterday'))->setTime(23, 59);

                break;
            case 'current_month':
                $this->since = new \DateTime('first day of this month');
                $this->until = new \DateTime();

                break;
            case 'last_month':
                $this->since = new \DateTime('first day of last month');
                $this->until = new \DateTime('last day of last month');

                break;
            case 'last_week':
                $this->since = new \DateTime('first day of last week');
                $this->until = new \DateTime('last day of last week');

                break;
            case 'last_two_months':
                $this->since = (new \DateTime('first day of last month'))->modify('-1 month');
                $this->until = (new \DateTime('last day of last month'));

                break;
            case 'previous_month':
                $this->since = new \DateTime('first day of -2 month');
                $this->until = new \DateTime('last day of -2 month');

                break;
            case 'two_months_ago':
                $this->since = new \DateTime('first day of -3 month');
                $this->until = new \DateTime('last day of -3 month');

                break;
            case 'this_year':
                $this->since = new \DateTime('first day of January '.date('Y'));
                $this->until = new \DateTime('last day of December'.date('Y'));

                break;
            case 'January':  // 1
            case 'February': // 2
            case 'March':    // 3
            case 'April':    // 4
            case 'May':      // 5
            case 'June':     // 6
            case 'July':     // 7
            case 'August':   // 8
            case 'September':// 9
            case 'October':  // 10
            case 'November': // 11
            case 'December': // 12
                $this->since = new \DateTime('first day of '.$scope.' '.date('Y'));
                $this->until = new \DateTime('last day of '.$scope.' '.date('Y'));

                break;
            case 'auto':
                $latestRecord = $this->getColumnsFromPohoda(['id', 'lastUpdate'], ['limit' => 1, 'order' => 'lastUpdate@A', 'source' => $this->sourceString(), 'banka' => $this->bank]);

                if (\array_key_exists(0, $latestRecord) && \array_key_exists('lastUpdate', $latestRecord[0])) {
                    $this->since = $latestRecord[0]['lastUpdate'];
                } else {
                    $this->addStatusMessage('Previous record for "auto since" not found. Defaulting to today\'s 00:00', 'warning');
                    $this->since = (new \DateTime())->setTime(0, 0);
                }

                $this->until = new \DateTime(); // Now

                break;

            default:
                if (strstr($scope, '>')) {
                    [$begin, $end] = explode('>', $scope);
                    $this->since = new \DateTime($begin);
                    $this->until = new \DateTime($end);
                } else {
                    if (preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $scope)) {
                        $this->since = new \DateTime($scope);
                        $this->until = (new \DateTime($scope))->setTime(23, 59, 59, 999);
                    }

                    throw new \InvalidArgumentException('Unknown scope '.$scope);
                }

                break;
        }

        if ($scope !== 'auto' && $scope !== 'today' && $scope !== 'yesterday') {
            $this->since = $this->since->setTime(0, 0);
            $this->until = $this->until->setTime(23, 59, 59, 999);
        }

        $this->scope = $scope;

        return $this->getScope();
    }

    public function getScopeSymbolic(): string
    {
        return $this->scope;
    }

    public function getScope(): \DatePeriod
    {
        return new \DatePeriod($this->since, new \DateInterval('P1D'), $this->until);
    }

    /**
     * Save Statement PDF files.
     *
     * @param array<mixed> $statements - produced by getStatements() function
     * @param string       $format     pdf|xml
     */
    public function download(string $saveTo, array $statements, string $format = 'pdf', string $currencyCode = 'CZK'): array
    {
        $saved = [];
        $apiInstance = new \SpojeNet\CSas\Accounts\DefaultApi();
        $success = 0;

        foreach ($statements as $statement) {
            //        'accountStatementId' => 'getAccountStatementId',
            //        'year' => 'getYear',
            //        'month' => 'getMonth',
            //        'sequenceNumber' => 'getSequenceNumber',
            //        'period' => 'getPeriod',
            //        'dateFrom' => 'getDateFrom',
            //        'dateTo' => 'getDateTo',
            //        'formats' => 'getFormats',

            $statementFilename =
                    $statement->getSequenceNumber().'_'.
                    $this->getAccountNumber().'_'.
                    $statement->getAccountStatementId().'_'.
                    $this->currency.'_'.$statement->getDateFrom()->format('Y-m-d').'.'.$format;

            $pdfStatementRaw = $apiInstance->downloadAccountStatement($this->getAccountUuid(), $statement->getAccountStatementId(), $format);

            if (file_put_contents($saveTo.'/'.$statementFilename, $pdfStatementRaw->fread($pdfStatementRaw->getSize()))) {
                $saved[$statementFilename] = $saveTo.'/'.$statementFilename;
                $this->addStatusMessage($statementFilename.' saved', 'success');
                unset($pdfStatementRaw);
                ++$success;
            }
        }

        $this->addStatusMessage('Download done. '.$success.' of '.\count($statements).' saved');

        return $saved;
    }

    /**
     * Since time getter.
     */
    public function getSince(): \DateTime
    {
        return $this->since;
    }

    /**
     * Until time getter.
     */
    public function getUntil(): \DateTime
    {
        return $this->until;
    }

    public function getAccountNumber(): string
    {
        return $this->accountNumber;
    }

    public function setAccountUuid($accountUuid): void
    {
        $this->accountUuid = $accountUuid;
    }

    public function getAccountUuid(): string
    {
        return $this->accountUuid;
    }

    /**
     * IBAN=>UUID listing of accounts.
     *
     * @return array<string, string>
     */
    public static function getAccountIDs(Accounts\DefaultApi $apiInstance): array
    {
        $accounts = [];
        $accountsRaw = $apiInstance->getAccounts()->getAccounts();

        if (isset($accountsRaw) && \is_array($accountsRaw)) {
            foreach ($accountsRaw as $account) {
                $accounts[$account->getIdentification()->getIban()] = $account->getId();
            }
        }

        return $accounts;
    }

    // Helper function to map IBAN to account ID
    public static function getAccountIdByIban(Accounts\DefaultApi $apiInstance, string $iban): ?string
    {
        $accountsRaw = $apiInstance->getAccounts()->getAccounts();
        $accId = null;

        if (isset($accountsRaw) && \is_array($accountsRaw)) {
            foreach ($accountsRaw as $account) {
                if ($account->getIdentification()->getIban() === $iban) {
                    $accId = $account->getId();

                    break;
                }
            }
        }

        return $accId;
    }

    public static function getAccountByIban(Accounts\DefaultApi $apiInstance, string $iban): ?\SpojeNet\CSas\Model\Account
    {
        $accountsRaw = $apiInstance->getAccounts()->getAccounts();
        $account = null;

        if (isset($accountsRaw) && \is_array($accountsRaw)) {
            foreach ($accountsRaw as $account) {
                if ($account->getIdentification()->getIban() === $iban) {
                    break;
                }
            }
        }

        return $account;
    }

    public static function getAccountById(Accounts\DefaultApi $apiInstance, string $uuid): ?\SpojeNet\CSas\Model\Account
    {
        $accountsRaw = $apiInstance->getAccounts()->getAccounts();
        $account = null;

        if (isset($accountsRaw) && \is_array($accountsRaw)) {
            foreach ($accountsRaw as $account) {
                if ($account->getIdentification()->getId() === $uuid) {
                    break;
                }
            }
        }

        return $account;
    }


}
