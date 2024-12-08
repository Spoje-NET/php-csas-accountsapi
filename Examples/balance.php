<?php

require_once(dirname(__DIR__) . '/vendor/autoload.php');

$apiInstance = new \SpojeNET\Csas\Accounts\DefaultApi(
        // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
        // This is optional, `GuzzleHttp\Client` will be used as default.
        new GuzzleHttp\Client()
);
$id = 'id_example'; // string | Opaque system ID of the account

try {
    $result = $apiInstance->getAccountBalance($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->getAccountBalance: ', $e->getMessage(), PHP_EOL;
}
