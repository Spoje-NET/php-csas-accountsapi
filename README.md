# Premium - Accounts API

API for managing production accounts.

For more information, please visit [https://www.csas.cz/content/dam/cz/csas/www_csas_cz/dokumenty/obecne/how-to-connect-to-api-of-cs.pdf](https://www.csas.cz/content/dam/cz/csas/www_csas_cz/dokumenty/obecne/how-to-connect-to-api-of-cs.pdf).

## Installation & Usage

### Requirements

PHP 7.4 and later.
Should also work with PHP 8.0.

### Composer

To install the bindings via [Composer](https://getcomposer.org/), add the following to `composer.json`:

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/Spoje-NET/php-csas-webapi.git"
    }
  ],
  "require": {
    "Spoje-NET/php-csas-webapi": "*@dev"
  }
}
```

Then run `composer install`

### Manual Installation

Download the files and include `autoload.php`:

```php
<?php
require_once('/path/to/Premium - Accounts API/vendor/autoload.php');
```

## Getting Started

Please follow the [installation procedure](#installation--usage) and then run the following:

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
$id = 'id_example'; // string | Opaque system ID of the account

try {
    $result = $apiInstance->getAccountBalance($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->getAccountBalance: ', $e->getMessage(), PHP_EOL;
}

```

## API Endpoints

All URIs are relative to *https://www.csas.cz/webapi/api/v3/accounts*

Class | Method | HTTP request | Description
------------ | ------------- | ------------- | -------------
*DefaultApi* | [**getAccountBalance**](docs/Api/DefaultApi.md#getaccountbalance) | **GET** /my/accounts/{id}/balance | Get account balance
*DefaultApi* | [**getAccounts**](docs/Api/DefaultApi.md#getaccounts) | **GET** /my/accounts | Get account details
*DefaultApi* | [**getStatements**](docs/Api/DefaultApi.md#getstatements) | **GET** /my/accounts/{id}/statements | Get statements list
*DefaultApi* | [**getTransactions**](docs/Api/DefaultApi.md#gettransactions) | **GET** /my/accounts/{id}/transactions | Overview of transactions

## Models

- [Account](docs/Model/Account.md)
- [AccountBalance](docs/Model/AccountBalance.md)
- [AccountCurrencyExchange](docs/Model/AccountCurrencyExchange.md)
- [AccountIdentification](docs/Model/AccountIdentification.md)
- [AccountRelatedAgents](docs/Model/AccountRelatedAgents.md)
- [AccountRelationship](docs/Model/AccountRelationship.md)
- [AccountServicer](docs/Model/AccountServicer.md)
- [AccountSuitableScope](docs/Model/AccountSuitableScope.md)
- [GetAccountBalance400Response](docs/Model/GetAccountBalance400Response.md)
- [GetAccountBalance403Response](docs/Model/GetAccountBalance403Response.md)
- [GetAccountBalance404Response](docs/Model/GetAccountBalance404Response.md)
- [GetAccountBalance405Response](docs/Model/GetAccountBalance405Response.md)
- [GetAccountBalance412Response](docs/Model/GetAccountBalance412Response.md)
- [GetAccountBalance429Response](docs/Model/GetAccountBalance429Response.md)
- [GetAccountBalance500Response](docs/Model/GetAccountBalance500Response.md)
- [GetAccountBalance503Response](docs/Model/GetAccountBalance503Response.md)
- [GetAccounts200Response](docs/Model/GetAccounts200Response.md)
- [GetAccounts403Response](docs/Model/GetAccounts403Response.md)
- [GetAccounts403ResponseErrorsInner](docs/Model/GetAccounts403ResponseErrorsInner.md)
- [GetStatements400Response](docs/Model/GetStatements400Response.md)
- [GetStatements403Response](docs/Model/GetStatements403Response.md)
- [GetStatements404Response](docs/Model/GetStatements404Response.md)
- [GetTransactions400Response](docs/Model/GetTransactions400Response.md)
- [GetTransactions401Response](docs/Model/GetTransactions401Response.md)
- [GetTransactions404Response](docs/Model/GetTransactions404Response.md)
- [StatementList](docs/Model/StatementList.md)
- [StatementListAccountStatementsInner](docs/Model/StatementListAccountStatementsInner.md)
- [StatementListAccountStatementsInnerPeriod](docs/Model/StatementListAccountStatementsInnerPeriod.md)
- [TransactionList](docs/Model/TransactionList.md)
- [TransactionListTransactionsInner](docs/Model/TransactionListTransactionsInner.md)

## Authorization

Authentication schemes defined for the API:
### bearerAuth

- **Type**: Bearer authentication (JWT)

### ApiKeyAuth

- **Type**: API key
- **API key parameter name**: WEB-API-key
- **Location**: HTTP header


## Tests

To run the tests, use:

```bash
composer install
vendor/bin/phpunit
```

## Author

vitezslav.dvorak@spojenet.cz

## About this package

This PHP package is automatically generated by the [OpenAPI Generator](https://openapi-generator.tech) project:

- API version: `1.0.0`
    - Generator version: `7.10.0`
- Build package: `org.openapitools.codegen.languages.PhpClientCodegen`
