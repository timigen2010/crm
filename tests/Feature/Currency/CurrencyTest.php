<?php

namespace Tests\Feature\Currency;

use Aveiv\OpenExchangeRatesApi\Client;
use Mockery;
use Tests\Feature\BaseTestCase;

class CurrencyTest extends BaseTestCase
{
    private const TEST_CURRENCY_ID = 1;
    private const TEST_CURRENCY_DELETE_ID = 2;
    private const TEST_CURRENCY_REBIND_ID = 2;
    private const URI_GET_CURRENCIES = 'api/currencies';
    private const URI_SHOW_CURRENCY = 'api/currencies/' . self::TEST_CURRENCY_ID . '/show';
    private const URI_CREATE_CURRENCY = 'api/currencies/new';
    private const URI_EDIT_CURRENCY = 'api/currencies/' . self::TEST_CURRENCY_ID . '/edit';
    private const URI_DELETE_CURRENCY = 'api/currencies/' . self::TEST_CURRENCY_DELETE_ID . '/delete';
    private const URI_REBIND_CURRENCY = 'api/currencies/' . self::TEST_CURRENCY_REBIND_ID . '/rebind';
    private const URI_REFRESH_EXCHANGE = 'api/currencies/refresh_exchange_rate';

    public function testGetCurrencies()
    {
        $response = $this->get(
            self::URI_GET_CURRENCIES,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }

    public function testShowCurrency()
    {
        $response = $this->get(
            self::URI_SHOW_CURRENCY,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }

    public function testCreateCurrency()
    {
        $response = $this->post(
            self::URI_CREATE_CURRENCY,
            [
                'mainCurrencyId' => 1,
                'code' => 'uah',
                'decimalPlace' => 2,
                'value' => 28,
                'status' => true,
                'descriptions' => [
                    [
                        'name' => 'title',
                        'symbolLeft' => 'symbol_left',
                        'symbolRight' => 'symbol_left',
                        'languageId' => 1,
                    ]
                ]
            ],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );
        $response->assertStatus(201);
    }

    public function testEditCurrency()
    {
        $response = $this->put(
            self::URI_EDIT_CURRENCY,
            [
                'mainCurrencyId' => 1,
                'code' => 'uah',
                'decimalPlace' => 2,
                'value' => 28,
                'status' => true,
                'descriptions' => [
                    [
                        'name' => 'title',
                        'symbolLeft' => 'symbol_left',
                        'symbolRight' => 'symbol_left',
                        'languageId' => 1,
                    ]
                ]
            ],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );
        $response->assertStatus(200);
    }

    public function testDeleteCurrency()
    {
        $response = $this->delete(
            self::URI_DELETE_CURRENCY,
            [],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }

    public function testRebindCurrency()
    {
        $response = $this->post(
            self::URI_REBIND_CURRENCY,
            [],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }

    public function testRefreshExchange()
    {
        $client = Mockery::mock(Client::class);
        $client->shouldReceive('getLatest')
                ->andReturn([
                    "disclaimer" => "Usage subject to terms: https://openexchangerates.org/terms",
                    "license" => "https://openexchangerates.org/license",
                    "timestamp" => 1584943200,
                    "base" => "USD",
                    "rates" => [
                        "EUR" => 0.930211,
                        "RUB" => 80.7596,
                        "UAH" => 27.410741,
                        "USD" => 1
                    ]
                ])
                ->once();
        app()->instance(Client::class, $client);
        $response = $this->post(
            self::URI_REFRESH_EXCHANGE,
            [],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );
        $response->assertStatus(200);
    }
}
