<?php

declare(strict_types=1);

namespace SpojeNet\CSas\Test;

use PHPUnit\Framework\TestCase;
use SpojeNet\CSas\Accounts\DefaultApi;
use SpojeNet\CSas\Model\Account;
use SpojeNet\CSas\Model\AccountIdentification;
use SpojeNet\CSas\Model\GetAccounts200Response;
use SpojeNet\CSas\Statementor;

/**
 * The account lookups must never return an account which was not asked for.
 */
class StatementorLookupTest extends TestCase
{
    private function api(): DefaultApi
    {
        $accounts = [];

        foreach ([['uuid-1', 'CZ01'], ['uuid-2', 'CZ02']] as [$id, $iban]) {
            $identification = $this->createMock(AccountIdentification::class);
            $identification->method('getIban')->willReturn($iban);
            $account = $this->createMock(Account::class);
            $account->method('getId')->willReturn($id);
            $account->method('getIdentification')->willReturn($identification);
            $accounts[] = $account;
        }

        $response = $this->createMock(GetAccounts200Response::class);
        $response->method('getAccounts')->willReturn($accounts);
        $api = $this->createMock(DefaultApi::class);
        $api->method('getAccounts')->willReturn($response);

        return $api;
    }

    public function testFindsAccountByIbanAndId(): void
    {
        $this->assertSame('uuid-1', Statementor::getAccountByIban($this->api(), 'CZ01')->getId());
        $this->assertSame('uuid-2', Statementor::getAccountById($this->api(), 'uuid-2')->getId());
    }

    public function testUnknownAccountReturnsNullInsteadOfTheLastOne(): void
    {
        $this->assertNull(Statementor::getAccountByIban($this->api(), 'CZ99'));
        $this->assertNull(Statementor::getAccountById($this->api(), 'nope'));
    }
}
