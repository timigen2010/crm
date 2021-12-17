<?php

namespace Tests\Feature\Customer;

use Tests\Feature\BaseTestCase;

class CustomerTest extends BaseTestCase
{
    private const TEST_CUSTOMER_ID = 1;
    private const URI_GET_CUSTOMERS = 'api/customers';
    private const URI_SHOW_CUSTOMER = 'api/customers/show/' . self::TEST_CUSTOMER_ID;
    private const URI_CREATE_CUSTOMER = 'api/customers/new';
    private const URI_EDIT_CUSTOMER = 'api/customers/edit/' . self::TEST_CUSTOMER_ID;

    public function testGetCustomers()
    {
        $response = $this->get(
            self::URI_GET_CUSTOMERS,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }

    public function testShowCustomer()
    {
        $response = $this->get(
            self::URI_SHOW_CUSTOMER,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }

    public function testCreateCustomer()
    {
        $response = $this->post(
            self::URI_CREATE_CUSTOMER,
            [
                'customerGroupId' => 1,
                'firstName' => 'firstName',
                'lastName' => 'lastName',
                'email' => 'email33@test.com',
                'newsletter' => false,
                'status' => true,
                'addresses' =>
                    [
                       [
                           'cityId' => 1,
                           'address_1' => 'address_1',
                           'address_2' => 'address_2',
                           'isMain' => true,
                       ]
                    ],
                'addTelephones' =>
                    [
                        [
                            'telephone' => '3444444444444',
                            'isMain' => true,
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

    public function testEditCustomer()
    {
        $response = $this->put(
            self::URI_EDIT_CUSTOMER,
            [
                'customerGroupId' => 1,
                'firstName' => 'Test',
                'lastName' => 'Test',
                'email' => 'email@test.com',
                'newsletter' => false,
                'status' => true,
                'addresses' =>
                    [
                        [
                            'cityId' => 1,
                            'address_1' => 'address_1',
                            'address_2' => 'address_2',
                            'isMain' => true,
                        ]
                    ],
            ],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }
}
