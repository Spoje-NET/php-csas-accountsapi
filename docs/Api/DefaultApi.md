# SpojeNET\CSas\DefaultApi

All URIs are relative to https://www.csas.cz/webapi/api/v3/accounts, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getAccountBalance()**](DefaultApi.md#getAccountBalance) | **GET** /my/accounts/{id}/balance | Get account balance |
| [**getAccountStatements()**](DefaultApi.md#getAccountStatements) | **GET** /my/accounts/{id}/statements | Get account statements |
| [**getAccounts()**](DefaultApi.md#getAccounts) | **GET** /my/accounts | Get account details |
| [**getTransactions()**](DefaultApi.md#getTransactions) | **GET** /my/accounts/{id}/transactions | Overview of transactions |


## `getAccountBalance()`

```php
getAccountBalance($id): \SpojeNET\CSas\Model\GetAccountBalance200Response
```

Get account balance

Get the balance of a specific account by ID.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: ApiKeyAuth
$config = SpojeNET\CSas\Configuration::getDefaultConfiguration()->setApiKey('WEB-API-key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = SpojeNET\CSas\Configuration::getDefaultConfiguration()->setApiKeyPrefix('WEB-API-key', 'Bearer');

// Configure Bearer (JWT) authorization: bearerAuth
$config = SpojeNET\CSas\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new SpojeNET\CSas\Api\DefaultApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | The ID of the account

try {
    $result = $apiInstance->getAccountBalance($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->getAccountBalance: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| The ID of the account | |

### Return type

[**\SpojeNET\CSas\Model\GetAccountBalance200Response**](../Model/GetAccountBalance200Response.md)

### Authorization

[ApiKeyAuth](../../README.md#ApiKeyAuth), [bearerAuth](../../README.md#bearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getAccountStatements()`

```php
getAccountStatements($id): \SpojeNET\CSas\Model\GetAccountStatements200Response
```

Get account statements

Get a list of statements for a specific account by ID.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: ApiKeyAuth
$config = SpojeNET\CSas\Configuration::getDefaultConfiguration()->setApiKey('WEB-API-key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = SpojeNET\CSas\Configuration::getDefaultConfiguration()->setApiKeyPrefix('WEB-API-key', 'Bearer');

// Configure Bearer (JWT) authorization: bearerAuth
$config = SpojeNET\CSas\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new SpojeNET\CSas\Api\DefaultApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | The ID of the account

try {
    $result = $apiInstance->getAccountStatements($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->getAccountStatements: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| The ID of the account | |

### Return type

[**\SpojeNET\CSas\Model\GetAccountStatements200Response**](../Model/GetAccountStatements200Response.md)

### Authorization

[ApiKeyAuth](../../README.md#ApiKeyAuth), [bearerAuth](../../README.md#bearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getAccounts()`

```php
getAccounts($size, $page): \SpojeNET\CSas\Model\GetAccounts200Response
```

Get account details

Get a list of accounts for the authenticated user.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: ApiKeyAuth
$config = SpojeNET\CSas\Configuration::getDefaultConfiguration()->setApiKey('WEB-API-key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = SpojeNET\CSas\Configuration::getDefaultConfiguration()->setApiKeyPrefix('WEB-API-key', 'Bearer');

// Configure Bearer (JWT) authorization: bearerAuth
$config = SpojeNET\CSas\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new SpojeNET\CSas\Api\DefaultApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$size = 56; // int | Number of accounts to return
$page = 56; // int | Page number to return

try {
    $result = $apiInstance->getAccounts($size, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->getAccounts: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **size** | **int**| Number of accounts to return | [optional] |
| **page** | **int**| Page number to return | [optional] |

### Return type

[**\SpojeNET\CSas\Model\GetAccounts200Response**](../Model/GetAccounts200Response.md)

### Authorization

[ApiKeyAuth](../../README.md#ApiKeyAuth), [bearerAuth](../../README.md#bearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getTransactions()`

```php
getTransactions($id, $fromDate, $toDate): \SpojeNET\CSas\Model\GetTransactions200Response
```

Overview of transactions

Paginated and optionally filtered (by dates) transaction list for given account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: ApiKeyAuth
$config = SpojeNET\CSas\Configuration::getDefaultConfiguration()->setApiKey('WEB-API-key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = SpojeNET\CSas\Configuration::getDefaultConfiguration()->setApiKeyPrefix('WEB-API-key', 'Bearer');

// Configure Bearer (JWT) authorization: bearerAuth
$config = SpojeNET\CSas\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new SpojeNET\CSas\Api\DefaultApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | Unique system identification of the client account
$fromDate = new \DateTime('2013-10-20T19:20:30+01:00'); // \DateTime | Start date for filtering transactions
$toDate = new \DateTime('2013-10-20T19:20:30+01:00'); // \DateTime | End date for filtering transactions

try {
    $result = $apiInstance->getTransactions($id, $fromDate, $toDate);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->getTransactions: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| Unique system identification of the client account | |
| **fromDate** | **\DateTime**| Start date for filtering transactions | [optional] |
| **toDate** | **\DateTime**| End date for filtering transactions | [optional] |

### Return type

[**\SpojeNET\CSas\Model\GetTransactions200Response**](../Model/GetTransactions200Response.md)

### Authorization

[ApiKeyAuth](../../README.md#ApiKeyAuth), [bearerAuth](../../README.md#bearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
