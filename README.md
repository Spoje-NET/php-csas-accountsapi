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




$apiInstance = new SpojeNET\Csas\Api\DefaultApi(
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
- [AccountRelatedAgents](docs/Model/AccountRelatedAgents.md)
- [GetAccounts400Response](docs/Model/GetAccounts400Response.md)
- [GetAccounts403Response](docs/Model/GetAccounts403Response.md)
- [GetAccounts404Response](docs/Model/GetAccounts404Response.md)
- [GetAccounts405Response](docs/Model/GetAccounts405Response.md)
- [GetAccounts412Response](docs/Model/GetAccounts412Response.md)
- [GetAccounts429Response](docs/Model/GetAccounts429Response.md)
- [GetAccounts500Response](docs/Model/GetAccounts500Response.md)
- [GetAccounts503Response](docs/Model/GetAccounts503Response.md)
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
Endpoints do not require authorization.

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
