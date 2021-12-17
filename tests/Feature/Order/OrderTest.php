<?php

namespace Tests\Feature\Order;

use Tests\Feature\BaseTestCase;

class OrderTest extends BaseTestCase
{
    private const ORDER_ID = 1;

    private const URI_GET_ORDERS = 'api/orders';
    private const URI_SHOW_ORDER = 'api/orders/' . self::ORDER_ID . '/show';
    private const URI_CREATE_ORDER = 'api/orders/new';
    private const URI_EDIT_ORDER = 'api/orders/' . self::ORDER_ID . '/edit';

    private array $orderParams = [
        'companyId' => 1,
        'menuCompanyId' => 1,
        'countPerson' => 1,
        'countOddmoney' => 0,
        'countUncash' => 0,
        'countBonus' => 0,
        'countBonusAdd' => 0,
        'countVoucher' => 0,
        'deliveryMethod' => 'self',
        'deliveryType' => 'none',
        'deliveryTime' => '',
        'deliveryDay' => '',
        'comment' => '',
        'total' => 110.10,
        'languageId' => 1,
        'customerId' => 1,
        'firstName' => 'Test',
        'lastName' => 'Test',
        'email' => 'email@test.com',
        'telephone' => '380953456786',
        'paymentFirstName' => 'Test',
        'paymentLastName' => 'Test',
        'address_1' => 'address_1',
        'address_2' => 'address_2',
        'coords' => '',
        'city' => 'Test',
        'paymentMethod' => 'method',
        'paymentCode' => 'code',
        'products' => [
            [
                'productId' => 1,
                'unitClassId' => 1,
                'discountCardId' => null,
                'currencyId' => 2,
                'name' => 'test',
                'key' => 'key',
                'amount' => 1,
                'discount' => 1,
                'price' => 110.10,
                'total' => 110.10,
            ]
        ],
    ];

    public function testGetOrders()
    {
        $response = $this->get(
            self::URI_GET_ORDERS,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }

    public function testShowOrder()
    {
        $response = $this->get(
            self::URI_SHOW_ORDER,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }

    public function testCreateOrder()
    {
        $response = $this->post(
            self::URI_CREATE_ORDER,
            $this->orderParams,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );
        $response->assertStatus(201);
    }

    public function testEditOrder()
    {
        $response = $this->put(
            self::URI_EDIT_ORDER,
            $this->orderParams,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }
}
