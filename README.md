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

## API Endpoints

All URIs are relative to *https://www.csas.cz/webapi/api/v3/accounts*

Class | Method | HTTP request | Description
------------ | ------------- | ------------- | -------------
*DefaultApi* | [**downloadAccountStatement**](docs/Api/DefaultApi.md#downloadaccountstatement) | **GET** /my/accounts/{id}/statements/{accountStatementId}/download | Download account statement
*DefaultApi* | [**getAccountBalance**](docs/Api/DefaultApi.md#getaccountbalance) | **GET** /my/accounts/{id}/balance | Get account balance
*DefaultApi* | [**getAccountStatements**](docs/Api/DefaultApi.md#getaccountstatements) | **GET** /my/accounts/{id}/statements | Get account statements
*DefaultApi* | [**getAccounts**](docs/Api/DefaultApi.md#getaccounts) | **GET** /my/accounts | Get account details
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
- [GetAccountBalance200Response](docs/Model/GetAccountBalance200Response.md)
- [GetAccountBalance200ResponseBalancesInner](docs/Model/GetAccountBalance200ResponseBalancesInner.md)
- [GetAccountBalance200ResponseBalancesInnerAmount](docs/Model/GetAccountBalance200ResponseBalancesInnerAmount.md)
- [GetAccountBalance200ResponseBalancesInnerDate](docs/Model/GetAccountBalance200ResponseBalancesInnerDate.md)
- [GetAccountBalance200ResponseBalancesInnerType](docs/Model/GetAccountBalance200ResponseBalancesInnerType.md)
- [GetAccountBalance200ResponseBalancesInnerTypeCodeOrProprietary](docs/Model/GetAccountBalance200ResponseBalancesInnerTypeCodeOrProprietary.md)
- [GetAccountStatements200Response](docs/Model/GetAccountStatements200Response.md)
- [GetAccountStatements200ResponseAccountStatementsInner](docs/Model/GetAccountStatements200ResponseAccountStatementsInner.md)
- [GetAccountStatements200ResponseAccountStatementsInnerFormatsInner](docs/Model/GetAccountStatements200ResponseAccountStatementsInnerFormatsInner.md)
- [GetAccountStatements400Response](docs/Model/GetAccountStatements400Response.md)
- [GetAccountStatements400ResponseErrorsInner](docs/Model/GetAccountStatements400ResponseErrorsInner.md)
- [GetAccountStatements404Response](docs/Model/GetAccountStatements404Response.md)
- [GetAccountStatements404ResponseErrorsInner](docs/Model/GetAccountStatements404ResponseErrorsInner.md)
- [GetAccountStatements429Response](docs/Model/GetAccountStatements429Response.md)
- [GetAccountStatements429ResponseErrorsInner](docs/Model/GetAccountStatements429ResponseErrorsInner.md)
- [GetAccountStatements500Response](docs/Model/GetAccountStatements500Response.md)
- [GetAccountStatements500ResponseErrorsInner](docs/Model/GetAccountStatements500ResponseErrorsInner.md)
- [GetAccountStatements503Response](docs/Model/GetAccountStatements503Response.md)
- [GetAccountStatements503ResponseErrorsInner](docs/Model/GetAccountStatements503ResponseErrorsInner.md)
- [GetAccounts200Response](docs/Model/GetAccounts200Response.md)
- [GetAccounts403Response](docs/Model/GetAccounts403Response.md)
- [GetAccounts403ResponseErrorsInner](docs/Model/GetAccounts403ResponseErrorsInner.md)
- [GetTransactions200Response](docs/Model/GetTransactions200Response.md)
- [GetTransactions200ResponseTransactionsInner](docs/Model/GetTransactions200ResponseTransactionsInner.md)
- [GetTransactions200ResponseTransactionsInnerAmount](docs/Model/GetTransactions200ResponseTransactionsInnerAmount.md)
- [GetTransactions200ResponseTransactionsInnerBankTransactionCode](docs/Model/GetTransactions200ResponseTransactionsInnerBankTransactionCode.md)
- [GetTransactions200ResponseTransactionsInnerBankTransactionCodeProprietary](docs/Model/GetTransactions200ResponseTransactionsInnerBankTransactionCodeProprietary.md)
- [GetTransactions200ResponseTransactionsInnerBookingDate](docs/Model/GetTransactions200ResponseTransactionsInnerBookingDate.md)
- [GetTransactions200ResponseTransactionsInnerEntryDetails](docs/Model/GetTransactions200ResponseTransactionsInnerEntryDetails.md)
- [GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetails](docs/Model/GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetails.md)
- [GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsAmountDetails](docs/Model/GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsAmountDetails.md)
- [GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsAmountDetailsCounterValueAmount](docs/Model/GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsAmountDetailsCounterValueAmount.md)
- [GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsAmountDetailsCounterValueAmountAmount](docs/Model/GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsAmountDetailsCounterValueAmountAmount.md)
- [GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsAmountDetailsCounterValueAmountCurrencyExchange](docs/Model/GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsAmountDetailsCounterValueAmountCurrencyExchange.md)
- [GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsAmountDetailsInstructedAmount](docs/Model/GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsAmountDetailsInstructedAmount.md)
- [GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsAmountDetailsInstructedAmountAmount](docs/Model/GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsAmountDetailsInstructedAmountAmount.md)
- [GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsReferences](docs/Model/GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsReferences.md)
- [GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsRelatedAgents](docs/Model/GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsRelatedAgents.md)
- [GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsRelatedAgentsCreditorAgent](docs/Model/GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsRelatedAgentsCreditorAgent.md)
- [GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsRelatedAgentsCreditorAgentFinancialInstitutionIdentification](docs/Model/GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsRelatedAgentsCreditorAgentFinancialInstitutionIdentification.md)
- [GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsRelatedAgentsDebtorAgent](docs/Model/GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsRelatedAgentsDebtorAgent.md)
- [GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsRelatedAgentsDebtorAgentFinancialInstitutionIdentification](docs/Model/GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsRelatedAgentsDebtorAgentFinancialInstitutionIdentification.md)
- [GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsRelatedParties](docs/Model/GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsRelatedParties.md)
- [GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsRelatedPartiesCreditor](docs/Model/GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsRelatedPartiesCreditor.md)
- [GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsRelatedPartiesCreditorAccount](docs/Model/GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsRelatedPartiesCreditorAccount.md)
- [GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsRelatedPartiesCreditorAccountIdentification](docs/Model/GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsRelatedPartiesCreditorAccountIdentification.md)
- [GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsRelatedPartiesCreditorAccountIdentificationOther](docs/Model/GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsRelatedPartiesCreditorAccountIdentificationOther.md)
- [GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsRelatedPartiesDebtor](docs/Model/GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsRelatedPartiesDebtor.md)
- [GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsRelatedPartiesDebtorAccount](docs/Model/GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsRelatedPartiesDebtorAccount.md)
- [GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsRelatedPartiesDebtorAccountIdentification](docs/Model/GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsRelatedPartiesDebtorAccountIdentification.md)
- [GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsRelatedPartiesDebtorAccountIdentificationOther](docs/Model/GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsRelatedPartiesDebtorAccountIdentificationOther.md)
- [GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsRemittanceInformation](docs/Model/GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsRemittanceInformation.md)
- [GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsRemittanceInformationStructured](docs/Model/GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsRemittanceInformationStructured.md)
- [GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsRemittanceInformationStructuredCreditorReferenceInformation](docs/Model/GetTransactions200ResponseTransactionsInnerEntryDetailsTransactionDetailsRemittanceInformationStructuredCreditorReferenceInformation.md)
- [GetTransactions200ResponseTransactionsInnerValueDate](docs/Model/GetTransactions200ResponseTransactionsInnerValueDate.md)
- [StatementList](docs/Model/StatementList.md)
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
