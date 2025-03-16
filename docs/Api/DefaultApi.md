# SpojeNET\CSas\DefaultApi

All URIs are relative to https://www.csas.cz/webapi/api/v3/accounts, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**downloadAccountStatement()**](DefaultApi.md#downloadAccountStatement) | **GET** /my/accounts/{id}/statements/{accountStatementId}/download | Download account statement |
| [**getAccountBalance()**](DefaultApi.md#getAccountBalance) | **GET** /my/accounts/{id}/balance | Get account balance |
| [**getAccountStatements()**](DefaultApi.md#getAccountStatements) | **GET** /my/accounts/{id}/statements | Get account statements |
| [**getAccounts()**](DefaultApi.md#getAccounts) | **GET** /my/accounts | Get account details |
| [**getTransactions()**](DefaultApi.md#getTransactions) | **GET** /my/accounts/{id}/transactions | Overview of transactions |


## `downloadAccountStatement()`

```php
downloadAccountStatement($id, $accountStatementId, $format): \SplFileObject
```

Download account statement

Download a specific account statement by ID.

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
$id = D2C8C1DCC51A3738538A40A4863CA288E0225E52; // string | Unique system identification of the client account
$accountStatementId = 002498aa881201c7; // string | Unique identifier of the account statement
$format = pdf; // string | Selected statement format

try {
    $result = $apiInstance->downloadAccountStatement($id, $accountStatementId, $format);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->downloadAccountStatement: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| Unique system identification of the client account | |
| **accountStatementId** | **string**| Unique identifier of the account statement | |
| **format** | **string**| Selected statement format | |

### Return type

**\SplFileObject**

### Authorization

[ApiKeyAuth](../../README.md#ApiKeyAuth), [bearerAuth](../../README.md#bearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/pdf`, `application/xml`, `text/csv`, `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

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
getAccountStatements($id, $fromDate, $toDate, $format, $size, $page): \SpojeNET\CSas\Model\GetAccountStatements200Response
```

Get account statements

Get a list of statements for a specific account by ID. Resource for obtaining a list of statements for an account and downloading a statement in available formats. Supported statement formats: - George: PDF, ABO, CSV (more details about data statements structure: https://www.csas.cz/cs/dokumenty-ke-stazeni#/995/George) - Business 24: PDF, XML, MT940, ABO (more details about data statements structure: https://www.csas.cz/cs/dokumenty-ke-stazeni#/175/BUSINESS-24) - George Business: PDF, XML, MT940, ABO, CSV (more details about data statements structure: https://www.csas.cz/cs/dokumenty-ke-stazeni#/1478/George-Business)

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
$id = D2C8C1DCC51A3738538A40A4863CA288E0225E52; // string | Unique system identification of the client account
$fromDate = 2022-03-07; // \DateTime | Date from which the statement history should be obtained
$toDate = 2022-04-07; // \DateTime | Date to which the statement history should be obtained (including this moment in time)
$format = pdf; // string | Selected statement format
$size = 10; // int | Pagination - Number of entries per page (max. 100)
$page = 0; // int | Pagination - The desired page (indexed from zero)

try {
    $result = $apiInstance->getAccountStatements($id, $fromDate, $toDate, $format, $size, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->getAccountStatements: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| Unique system identification of the client account | |
| **fromDate** | **\DateTime**| Date from which the statement history should be obtained | [optional] |
| **toDate** | **\DateTime**| Date to which the statement history should be obtained (including this moment in time) | [optional] |
| **format** | **string**| Selected statement format | [optional] |
| **size** | **int**| Pagination - Number of entries per page (max. 100) | [optional] |
| **page** | **int**| Pagination - The desired page (indexed from zero) | [optional] |

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
