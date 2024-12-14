<?php

use Ease\Shared as Shr;

require_once dirname(__DIR__) . '/vendor/autoload.php';

Shr::init([], dirname(__DIR__) . '/.env');

$apiInstance = new \SpojeNET\Csas\Accounts\DefaultApi(new SpojeNET\Csas\ApiClient(
    [
'apikey' => Shr::cfg('API_KEY'),
'token' => Shr::cfg('API_TOKEN'),
'debug' => Shr::cfg('API_DEBUG', false),
'sandbox' => Shr::cfg('SANDBOX_MODE')
]
));

try {
    $result = $apiInstance->getAccounts();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->getAccounts: ', $e->getMessage(), PHP_EOL;
}
