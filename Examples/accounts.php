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

Shr::init(['CSAS_API_KEY', 'CSAS_ACCESS_TOKEN', 'CSAS_API_DEBUG', 'CSAS_SANDBOX_MODE'], \dirname(__DIR__).'/.env');

$apiInstance = new \SpojeNET\CSas\Accounts\DefaultApi(new SpojeNET\CSas\ApiClient(
    [
        'apikey' => Shr::cfg('CSAS_API_KEY'),
        'token' => Shr::cfg('CSAS_ACCESS_TOKEN'),
        'debug' => Shr::cfg('CSAS_API_DEBUG', false),
        'sandbox' => Shr::cfg('CSAS_SANDBOX_MODE'),
    ],
));

try {
    $result = $apiInstance->getAccounts();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->getAccounts: ', $e->getMessage(), \PHP_EOL;
}

/*
"/usr/bin/php" "/home/vitex/Projects/SpojeNetIT/csas-accountsapi/Examples/accounts.php"
SpojeNET\CSas\Model\GetAccounts200Response Object
(
    [openAPINullablesSetToNull:protected] => Array
        (
        )

    [container:protected] => Array
        (
            [pageNumber] => 0
            [pageCount] => 1
            [pageSize] => 2
            [accounts] => Array
                (
                    [0] => SpojeNET\CSas\Model\Account Object
                        (
                            [openAPINullablesSetToNull:protected] => Array
                                (
                                )

                            [container:protected] => Array
                                (
                                    [id] => AA195E7DB499B4D9F48D46C208625FF53F2245F7
                                    [identification] => SpojeNET\CSas\Model\AccountIdentification Object
                                        (
                                            [openAPINullablesSetToNull:protected] => Array
                                                (
                                                )

                                            [container:protected] => Array
                                                (
                                                    [iban] => CZ1208000000000259459101
                                                    [other] => 0259459101/0800
                                                )

                                        )

                                    [currency] => CZK
                                    [servicer] => SpojeNET\CSas\Model\AccountServicer Object
                                        (
                                            [openAPINullablesSetToNull:protected] => Array
                                                (
                                                )

                                            [container:protected] => Array
                                                (
                                                    [bankCode] => 0800
                                                    [countryCode] => CZ
                                                    [bic] => GIBACZPX
                                                )

                                        )

                                    [nameI18N] => Jiří Spokojený
                                    [productI18N] => Osobní účet ČS II
                                    [ownersNames] => Array
                                        (
                                            [0] => Jiří Spokojený
                                        )

                                    [relationship] => SpojeNET\CSas\Model\AccountRelationship Object
                                        (
                                            [openAPINullablesSetToNull:protected] => Array
                                                (
                                                )

                                            [container:protected] => Array
                                                (
                                                    [isOwner] => 1
                                                )

                                        )

                                    [suitableScope] => SpojeNET\CSas\Model\AccountSuitableScope Object
                                        (
                                            [openAPINullablesSetToNull:protected] => Array
                                                (
                                                )

                                            [container:protected] => Array
                                                (
                                                    [aISP] =>
                                                    [pISP] =>
                                                )

                                        )

                                    [status] =>
                                    [relatedAgents] =>
                                    [currencyExchange] =>
                                )

                        )

                    [1] => SpojeNET\CSas\Model\Account Object
                        (
                            [openAPINullablesSetToNull:protected] => Array
                                (
                                )

                            [container:protected] => Array
                                (
                                    [id] => DEBCD8673D9A3F3EF3EFE4B799053FD49D2FF59F
                                    [identification] => SpojeNET\CSas\Model\AccountIdentification Object
                                        (
                                            [openAPINullablesSetToNull:protected] => Array
                                                (
                                                )

                                            [container:protected] => Array
                                                (
                                                    [iban] => CZ4108000000000782553098
                                                    [other] => 0782553098/0800
                                                )

                                        )

                                    [currency] => CZK
                                    [servicer] => SpojeNET\CSas\Model\AccountServicer Object
                                        (
                                            [openAPINullablesSetToNull:protected] => Array
                                                (
                                                )

                                            [container:protected] => Array
                                                (
                                                    [bankCode] => 0800
                                                    [countryCode] => CZ
                                                    [bic] => GIBACZPX
                                                )

                                        )

                                    [nameI18N] => Jiří SPokojený - CM
                                    [productI18N] => Cizoměnový účet
                                    [ownersNames] => Array
                                        (
                                            [0] => Jiří Spokojený
                                        )

                                    [relationship] => SpojeNET\CSas\Model\AccountRelationship Object
                                        (
                                            [openAPINullablesSetToNull:protected] => Array
                                                (
                                                )

                                            [container:protected] => Array
                                                (
                                                    [isOwner] =>
                                                )

                                        )

                                    [suitableScope] => SpojeNET\CSas\Model\AccountSuitableScope Object
                                        (
                                            [openAPINullablesSetToNull:protected] => Array
                                                (
                                                )

                                            [container:protected] => Array
                                                (
                                                    [aISP] =>
                                                    [pISP] =>
                                                )

                                        )

                                    [status] =>
                                    [relatedAgents] =>
                                    [currencyExchange] =>
                                )

                        )

                )

        )

)
Done.
 */
