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

Shr::init([], \dirname(__DIR__).'/.env');

$apiInstance = new \SpojeNET\CSas\Accounts\DefaultApi(new SpojeNET\CSas\ApiClient(
    [
        'apikey' => Shr::cfg('API_KEY'),
        'token' => Shr::cfg('ACCESS_TOKEN'),
        'debug' => Shr::cfg('API_DEBUG', false),
        'sandbox' => Shr::cfg('SANDBOX_MODE'),
    ],
));

try {
    $toDate = new \DateTime();
    $fromDate = (clone $toDate)->modify('-1 month');
    $result = $apiInstance->getStatements('AA195E7DB499B4D9F48D46C208625FF53F2245F7', $fromDate->format('Y-m-d'), $toDate->format('Y-m-d'));

    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->getStatements: ', $e->getMessage(), \PHP_EOL;
}
