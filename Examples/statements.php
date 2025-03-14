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

require_once \dirname(__DIR__) . '/vendor/autoload.php';

Shr::init(['CSAS_API_KEY', 'CSAS_ACCESS_TOKEN', 'CSAS_SANDBOX_MODE'], \dirname(__DIR__) . '/.env');

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
    $toDate = new \DateTime();
    $fromDate = (clone $toDate)->modify('-1 month');

    // See: https://jsapi.apiary.io/apis/eahaccountsapiv3prod/reference/statements/list-of-statements/get-statements-list.html

    $account = Shr::cfg('CSAS_ACCOUNT_IBAN');
    'AA195E7DB499B4D9F48D46C208625FF53F2245F7';
            
    $result = $apiInstance->getStatements($account, $fromDate->format('Y-m-d'), $toDate->format('Y-m-d'));

    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->getStatements: ', $e->getMessage(), \PHP_EOL;
}
