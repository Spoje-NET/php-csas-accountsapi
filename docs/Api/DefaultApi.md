# SpojeNET\\CsasWebApi\DefaultApi

All URIs are relative to https://www.csas.cz/webapi/api/v3/accounts, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**myAccountsGet()**](DefaultApi.md#myAccountsGet) | **GET** /my/accounts | Get account details |
| [**myAccountsIdBalanceGet()**](DefaultApi.md#myAccountsIdBalanceGet) | **GET** /my/accounts/{id}/balance | Get account balance |
| [**myAccountsIdStatementsGet()**](DefaultApi.md#myAccountsIdStatementsGet) | **GET** /my/accounts/{id}/statements | Get statements list |
| [**myAccountsIdTransactionsGet()**](DefaultApi.md#myAccountsIdTransactionsGet) | **GET** /my/accounts/{id}/transactions | Overview of transactions |


## `myAccountsGet()`

```php
myAccountsGet($size, $page, $sort, $order): \SpojeNET\\CsasWebApi\Model\Account
```

Get account details

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new SpojeNET\\CsasWebApi\Api\DefaultApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$size = 56; // int | Number of accounts to return
$page = 56; // int | Page number to return
$sort = 'sort_example'; // string | Field to sort by
$order = 'order_example'; // string | Sort order

try {
    $result = $apiInstance->myAccountsGet($size, $page, $sort, $order);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->myAccountsGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **size** | **int**| Number of accounts to return | [optional] |
| **page** | **int**| Page number to return | [optional] |
| **sort** | **string**| Field to sort by | [optional] |
| **order** | **string**| Sort order | [optional] |

### Return type

[**\SpojeNET\\CsasWebApi\Model\Account**](../Model/Account.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `myAccountsIdBalanceGet()`

```php
myAccountsIdBalanceGet($id): \SpojeNET\\CsasWebApi\Model\AccountBalance
```

Get account balance

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new SpojeNET\\CsasWebApi\Api\DefaultApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id = 'id_example'; // string | Opaque system ID of the account

try {
    $result = $apiInstance->myAccountsIdBalanceGet($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->myAccountsIdBalanceGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| Opaque system ID of the account | |

### Return type

[**\SpojeNET\\CsasWebApi\Model\AccountBalance**](../Model/AccountBalance.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `myAccountsIdStatementsGet()`

```php
myAccountsIdStatementsGet($id, $fromDate, $toDate, $format, $size, $page): \SpojeNET\\CsasWebApi\Model\StatementList
```

Get statements list

Obtain list of statements for a given account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new SpojeNET\\CsasWebApi\Api\DefaultApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id = 'id_example'; // string | Unique system identification of the client account
$fromDate = new \DateTime('2013-10-20T19:20:30+01:00'); // \DateTime | Date from which the statement history should be obtained (yyyy-MM-dd)
$toDate = new \DateTime('2013-10-20T19:20:30+01:00'); // \DateTime | Date to which the statement history should be obtained (yyyy-MM-dd)
$format = 'format_example'; // string | Selected statement format
$size = 56; // int | Number of entries per page (max. 100)
$page = 56; // int | The desired page (indexed from zero)

try {
    $result = $apiInstance->myAccountsIdStatementsGet($id, $fromDate, $toDate, $format, $size, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->myAccountsIdStatementsGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| Unique system identification of the client account | |
| **fromDate** | **\DateTime**| Date from which the statement history should be obtained (yyyy-MM-dd) | [optional] |
| **toDate** | **\DateTime**| Date to which the statement history should be obtained (yyyy-MM-dd) | [optional] |
| **format** | **string**| Selected statement format | [optional] |
| **size** | **int**| Number of entries per page (max. 100) | [optional] |
| **page** | **int**| The desired page (indexed from zero) | [optional] |

### Return type

[**\SpojeNET\\CsasWebApi\Model\StatementList**](../Model/StatementList.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `myAccountsIdTransactionsGet()`

```php
myAccountsIdTransactionsGet($id, $fromDate, $toDate, $size, $page, $sort, $order): \SpojeNET\\CsasWebApi\Model\TransactionList
```

Overview of transactions

Paginated and optionally filtered (by dates) transaction list for given account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new SpojeNET\\CsasWebApi\Api\DefaultApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id = 'id_example'; // string | Unique system identification of the client account
$fromDate = new \DateTime('2013-10-20T19:20:30+01:00'); // \DateTime | Filter transactions starting from a specific day in UTC (yyyy-MM-dd)
$toDate = new \DateTime('2013-10-20T19:20:30+01:00'); // \DateTime | Filter transactions up to the chosen day in UTC (yyyy-MM-dd)
$size = 56; // int | Number of entries per page (max. 200)
$page = 56; // int | The desired page (indexed from zero)
$sort = 'sort_example'; // string | One single field that should be used for sorting
$order = 'order_example'; // string | Sort order

try {
    $result = $apiInstance->myAccountsIdTransactionsGet($id, $fromDate, $toDate, $size, $page, $sort, $order);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->myAccountsIdTransactionsGet: ', $e->getMessage(), PHP_EOL;
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

[**\SpojeNET\\CsasWebApi\Model\TransactionList**](../Model/TransactionList.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
