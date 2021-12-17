<?php

namespace Tests\Feature\Discount;

use Tests\Feature\BaseTestCase;

class DiscountCardTest extends BaseTestCase
{
    private const TEST_CARD_ID = '000001';
    private const TEST_NOT_ACTIVE_CARD_ID = '000002';
    private const URI_GET_OPERATIONS_HISTORY = 'api/discounts/operations/history';
    private const URI_RELEASE_MASS_FREE_CARDS = 'api/discounts/released_cards/release_mass';
    private const URI_SEND_REQUEST_ACTIVE_CARD = 'api/discounts/cards/send_request_activate';
    private const URI_ACTIVATE_CARD = 'api/discounts/cards/activate';
    private const URI_DEACTIVATE_CARD = 'api/discounts/cards/deactivate';
    private const URI_GET_BALANCE_CARD = 'api/discounts/cards/get_balance';
    private const URI_BALANCE_REPLENISHMENT_CARD = 'api/discounts/cards/balance_replenishment';
    private const URI_REBIND_CARD = 'api/discounts/cards/rebind';

    public function testGetOperationsHistory()
    {
        $response = $this->get(
            self::URI_GET_OPERATIONS_HISTORY,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }

    public function testReleaseMassFreeCards()
    {
        $response = $this->post(
            self::URI_RELEASE_MASS_FREE_CARDS,
            [
                'start' => 10,
                'end' => 15,
            ],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );
        $response->assertStatus(200);
    }

    public function testSendRequestActivate()
    {
        $response = $this->post(
            self::URI_SEND_REQUEST_ACTIVE_CARD,
            [
                'cardId' => self::TEST_NOT_ACTIVE_CARD_ID,
                'telephone' => '380953456777',
                'isSendCode' => 0,
            ],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );
        $response->assertStatus(200);
    }

    public function testActivateCard()
    {
        $response = $this->post(
            self::URI_ACTIVATE_CARD,
            [
                'cardId' => self::TEST_NOT_ACTIVE_CARD_ID,
                'customerTelephoneId' => 2,
                'code' => 1234,
            ],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );
        $response->assertStatus(200);
    }

    public function testDeactivateCard()
    {
        $response = $this->post(
            self::URI_DEACTIVATE_CARD,
            [
                'cardId' => self::TEST_CARD_ID,
                'telephone' => '380953456786',
                'code' => 1111,
            ],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );
        $response->assertStatus(200);
    }

    public function testGetBalanceCard()
    {
        $response = $this->post(
            self::URI_GET_BALANCE_CARD,
            [
                'cardId' => self::TEST_CARD_ID,
                'telephone' => '380953456786'
            ],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );
        $response->assertStatus(200);
    }

    public function testReplenishmentBalanceCard()
    {
        $response = $this->post(
            self::URI_BALANCE_REPLENISHMENT_CARD,
            [
                'cardId' => self::TEST_CARD_ID,
                'telephone' => '380953456786',
                'bonuses' => 100
            ],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );
        $response->assertStatus(200);
    }

    public function testRebindCard()
    {
        $response = $this->post(
            self::URI_REBIND_CARD,
            [
                'cardId' => self::TEST_CARD_ID,
                'telephone' => '380953456777',
                'code' => 1111
            ],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );
        $response->assertStatus(200);
    }
}
