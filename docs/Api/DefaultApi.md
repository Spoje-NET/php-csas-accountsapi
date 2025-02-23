# SpojeNET\Csas\DefaultApi

All URIs are relative to https://www.csas.cz/webapi/api/v3/accounts, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getAccountBalance()**](DefaultApi.md#getAccountBalance) | **GET** /my/accounts/{id}/balance | Get account balance |
| [**getAccountStatements()**](DefaultApi.md#getAccountStatements) | **GET** /my/accounts/{id}/statements | Get account statements |
| [**getAccounts()**](DefaultApi.md#getAccounts) | **GET** /my/accounts | Get account details |
| [**getTransactions()**](DefaultApi.md#getTransactions) | **GET** /my/accounts/{id}/transactions | Overview of transactions |


## `getAccountBalance()`

```php
getAccountBalance($id): \SpojeNET\Csas\Model\GetAccountBalance200Response
```

Get account balance

Get the balance of a specific account by ID.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: ApiKeyAuth
$config = SpojeNET\Csas\Configuration::getDefaultConfiguration()->setApiKey('WEB-API-key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = SpojeNET\Csas\Configuration::getDefaultConfiguration()->setApiKeyPrefix('WEB-API-key', 'Bearer');

// Configure Bearer (JWT) authorization: bearerAuth
$config = SpojeNET\Csas\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new SpojeNET\Csas\Api\DefaultApi(
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

[**\SpojeNET\Csas\Model\GetAccountBalance200Response**](../Model/GetAccountBalance200Response.md)

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
getAccountStatements($id): \SpojeNET\Csas\Model\GetAccountStatements200Response
```

Get account statements

Get a list of statements for a specific account by ID.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: ApiKeyAuth
$config = SpojeNET\Csas\Configuration::getDefaultConfiguration()->setApiKey('WEB-API-key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = SpojeNET\Csas\Configuration::getDefaultConfiguration()->setApiKeyPrefix('WEB-API-key', 'Bearer');

// Configure Bearer (JWT) authorization: bearerAuth
$config = SpojeNET\Csas\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new SpojeNET\Csas\Api\DefaultApi(
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

[**\SpojeNET\Csas\Model\GetAccountStatements200Response**](../Model/GetAccountStatements200Response.md)

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
getAccounts($size, $page): \SpojeNET\Csas\Model\GetAccounts200Response
```

Get account details

Get a list of accounts for the authenticated user.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: ApiKeyAuth
$config = SpojeNET\Csas\Configuration::getDefaultConfiguration()->setApiKey('WEB-API-key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = SpojeNET\Csas\Configuration::getDefaultConfiguration()->setApiKeyPrefix('WEB-API-key', 'Bearer');

// Configure Bearer (JWT) authorization: bearerAuth
$config = SpojeNET\Csas\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new SpojeNET\Csas\Api\DefaultApi(
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

[**\SpojeNET\Csas\Model\GetAccounts200Response**](../Model/GetAccounts200Response.md)

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
getTransactions($id, $fromDate, $toDate, $size, $page, $sort, $order): \SpojeNET\Csas\Model\TransactionList
```

Overview of transactions

Paginated and optionally filtered (by dates) transaction list for given account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: ApiKeyAuth
$config = SpojeNET\Csas\Configuration::getDefaultConfiguration()->setApiKey('WEB-API-key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = SpojeNET\Csas\Configuration::getDefaultConfiguration()->setApiKeyPrefix('WEB-API-key', 'Bearer');

// Configure Bearer (JWT) authorization: bearerAuth
$config = SpojeNET\Csas\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new SpojeNET\Csas\Api\DefaultApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | Unique system identification of the client account
$fromDate = new \DateTime('2013-10-20T19:20:30+01:00'); // \DateTime | Filter transactions starting from a specific day in UTC (yyyy-MM-dd)
$toDate = new \DateTime('2013-10-20T19:20:30+01:00'); // \DateTime | Filter transactions up to the chosen day in UTC (yyyy-MM-dd)
$size = 56; // int | Number of entries per page (max. 200)
$page = 56; // int | The desired page (indexed from zero)
$sort = 'sort_example'; // string | One single field that should be used for sorting
$order = 'order_example'; // string | Sort order

try {
    $result = $apiInstance->getTransactions($id, $fromDate, $toDate, $size, $page, $sort, $order);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->getTransactions: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| Unique system identification of the client account | |
| **fromDate** | **\DateTime**| Filter transactions starting from a specific day in UTC (yyyy-MM-dd) | [optional] |
| **toDate** | **\DateTime**| Filter transactions up to the chosen day in UTC (yyyy-MM-dd) | [optional] |
| **size** | **int**| Number of entries per page (max. 200) | [optional] |
| **page** | **int**| The desired page (indexed from zero) | [optional] |
| **sort** | **string**| One single field that should be used for sorting | [optional] |
| **order** | **string**| Sort order | [optional] |

### Return type

[**\SpojeNET\Csas\Model\TransactionList**](../Model/TransactionList.md)

### Authorization

[ApiKeyAuth](../../README.md#ApiKeyAuth), [bearerAuth](../../README.md#bearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
