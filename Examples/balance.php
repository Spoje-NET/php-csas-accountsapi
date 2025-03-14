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

$apiInstance = new \SpojeNET\CSas\Accounts\DefaultApi(new SpojeNET\CSas\ApiClient(
    [
        'apikey' => Shr::cfg('CSAS_API_KEY'),
        'token' => Shr::cfg('CSAS_ACCESS_TOKEN'),
        'debug' => Shr::cfg('CSAS_API_DEBUG', false),
        'sandbox' => Shr::cfg('CSAS_SANDBOX_MODE'),
    ],
));

try {
    $result = $apiInstance->getAccountBalance(Shr::cfg('CSAS_ACCOUNT_IBAN'));
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->getAccountBalance: ', $e->getMessage(), \PHP_EOL;
}

/* 
"/usr/bin/php" "/home/vitex/Projects/SpojeNetIT/csas-accountsapi/Examples/balance.php"
SpojeNET\CSas\Model\GetAccountBalance200Response Object
(
    [openAPINullablesSetToNull:protected] => Array
        (
        )

    [container:protected] => Array
        (
            [balances] => Array
                (
                    [0] => SpojeNET\CSas\Model\GetAccountBalance200ResponseBalancesInner Object
                        (
                            [openAPINullablesSetToNull:protected] => Array
                                (
                                )

                            [container:protected] => Array
                                (
                                    [type] => SpojeNET\CSas\Model\GetAccountBalance200ResponseBalancesInnerType Object
                                        (
                                            [openAPINullablesSetToNull:protected] => Array
                                                (
                                                )

                                            [container:protected] => Array
                                                (
                                                    [codeOrProprietary] => SpojeNET\CSas\Model\GetAccountBalance200ResponseBalancesInnerTypeCodeOrProprietary Object
                                                        (
                                                            [openAPINullablesSetToNull:protected] => Array
                                                                (
                                                                )

                                                            [container:protected] => Array
                                                                (
                                                                    [code] => CLAV
                                                                )

                                                        )

                                                )

                                        )

                                    [amount] => SpojeNET\CSas\Model\GetAccountBalance200ResponseBalancesInnerAmount Object
                                        (
                                            [openAPINullablesSetToNull:protected] => Array
                                                (
                                                )

                                            [container:protected] => Array
                                                (
                                                    [value] => 48923.15
                                                    [currency] => CZK
                                                )

                                        )

                                    [creditDebitIndicator] => DBIT
                                    [date] => SpojeNET\CSas\Model\GetAccountBalance200ResponseBalancesInnerDate Object
                                        (
                                            [openAPINullablesSetToNull:protected] => Array
                                                (
                                                )

                                            [container:protected] => Array
                                                (
                                                    [dateTime] => DateTime Object
                                                        (
                                                            [date] => 2017-02-17 12:32:41.000000
                                                            [timezone_type] => 2
                                                            [timezone] => Z
                                                        )

                                                )

                                        )

                                )

                        )

                )

        )

)
*/