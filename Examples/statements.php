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

use Ease\Shared as Shr;

require_once \dirname(__DIR__).'/vendor/autoload.php';

Shr::init(['CSAS_API_KEY', 'CSAS_ACCESS_TOKEN', 'CSAS_SANDBOX_MODE'], \dirname(__DIR__).'/.env');

// Keep your tokens fresh using https://github.com/Spoje-NET/csas-authorize.git

$apiInstance = new \SpojeNet\CSas\Accounts\DefaultApi(new SpojeNet\CSas\ApiClient(
    [
        'apikey' => Shr::cfg('CSAS_API_KEY'),
        'token' => Shr::cfg('CSAS_ACCESS_TOKEN'),
        'debug' => Shr::cfg('CSAS_API_DEBUG', false),
        'sandbox' => Shr::cfg('CSAS_SANDBOX_MODE'),
    ],
));

try {
    $toDate = new \DateTime();
    $fromDate = (clone $toDate)->modify('-1 month');

    // See: https://jsapi.apiary.io/apis/eahaccountsapiv3prod/reference/statements/list-of-statements/get-statements-list.html

    $account = Shr::cfg('CSAS_ACCOUNT_IBAN');

    $result = $apiInstance->getAccountStatements($account, $fromDate->format('Y-m-d'), $toDate->format('Y-m-d'));

    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->getStatements: ', $e->getMessage(), \PHP_EOL;
}

/*
"/usr/bin/php" "/home/vitex/Projects/SpojeNetIT/csas-accountsapi/Examples/statements.php"
SpojeNet\CSas\Model\GetAccountStatements200Response Object
(
    [openAPINullablesSetToNull:protected] => Array
        (
        )

    [container:protected] => Array
        (
            [pageNumber] => 0
            [pageCount] => 1
            [pageSize] => 7
            [nextPage] => 
            [accountStatements] => Array
                (
                    [0] => SpojeNet\CSas\Model\GetAccountStatements200ResponseAccountStatementsInner Object
                        (
                            [openAPINullablesSetToNull:protected] => Array
                                (
                                )

                            [container:protected] => Array
                                (
                                    [accountStatementId] => 123
                                    [year] => 2022
                                    [month] => 2
                                    [sequenceNumber] => 150
                                    [period] => MONTH
                                    [dateFrom] => DateTime Object
                                        (
                                            [date] => 2022-02-01 00:00:00.000000
                                            [timezone_type] => 3
                                            [timezone] => UTC
                                        )

                                    [dateTo] => DateTime Object
                                        (
                                            [date] => 2022-02-28 00:00:00.000000
                                            [timezone_type] => 3
                                            [timezone] => UTC
                                        )

                                    [formats] => Array
                                        (
                                            [0] => SpojeNet\CSas\Model\GetAccountStatements200ResponseAccountStatementsInnerFormatsInner Object
                                                (
                                                    [openAPINullablesSetToNull:protected] => Array
                                                        (
                                                        )

                                                    [container:protected] => Array
                                                        (
                                                            [availability] => IMMEDIATE
                                                            [format] => pdf
                                                        )

                                                )

                                        )

                                )

                        )

                    [1] => SpojeNet\CSas\Model\GetAccountStatements200ResponseAccountStatementsInner Object
                        (
                            [openAPINullablesSetToNull:protected] => Array
                                (
                                )

                            [container:protected] => Array
                                (
                                    [accountStatementId] => 124
                                    [year] => 2022
                                    [month] => 3
                                    [sequenceNumber] => 156
                                    [period] => MONTH
                                    [dateFrom] => DateTime Object
                                        (
                                            [date] => 2022-03-01 00:00:00.000000
                                            [timezone_type] => 3
                                            [timezone] => UTC
                                        )

                                    [dateTo] => DateTime Object
                                        (
                                            [date] => 2022-03-31 00:00:00.000000
                                            [timezone_type] => 3
                                            [timezone] => UTC
                                        )

                                    [formats] => Array
                                        (
                                            [0] => SpojeNet\CSas\Model\GetAccountStatements200ResponseAccountStatementsInnerFormatsInner Object
                                                (
                                                    [openAPINullablesSetToNull:protected] => Array
                                                        (
                                                        )

                                                    [container:protected] => Array
                                                        (
                                                            [availability] => IMMEDIATE
                                                            [format] => abo-standard
                                                        )

                                                )

                                        )

                                )

                        )

                )

        )

)
*/