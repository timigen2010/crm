<?php

namespace Tests\Feature\Customer;

use Tests\Feature\BaseTestCase;

class CustomerGroupTest extends BaseTestCase
{
    private const TEST_CUSTOMER_GROUP_ID = 1;
    private const TEST_CUSTOMER_GROUP_DELETE_ID = 2;
    private const URI_GET_CUSTOMER_GROUPS = 'api/customers/groups';
    private const URI_SHOW_CUSTOMER_GROUP = 'api/customers/groups/show/' . self::TEST_CUSTOMER_GROUP_ID;
    private const URI_CREATE_CUSTOMER_GROUP = 'api/customers/groups/new';
    private const URI_EDIT_CUSTOMER_GROUP = 'api/customers/groups/edit/' . self::TEST_CUSTOMER_GROUP_ID;
    private const URI_DELETE_CUSTOMER_GROUP = 'api/customers/groups/delete/' . self::TEST_CUSTOMER_GROUP_DELETE_ID;

    public function testGetCustomerGroups()
    {
        $response = $this->get(
            self::URI_GET_CUSTOMER_GROUPS,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }

    public function testShowCustomerGroup()
    {
        $response = $this->get(
            self::URI_SHOW_CUSTOMER_GROUP,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }

    public function testCreateCustomerGroup()
    {
        $response = $this->post(
            self::URI_CREATE_CUSTOMER_GROUP,
            [
                "companyId" => 1,
                "descriptions" => [
                    [
                        "name" => "Тестовая запись",
                        "description" => "Тестовая запись",
                        "languageId" => 1
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

    public function testEditCustomerGroup()
    {
        $response = $this->put(
            self::URI_EDIT_CUSTOMER_GROUP,
            [
                "companyId" => 1,
                "descriptions" => [
                    [
                        "name" => "Тестовая запись",
                        "description" => "Тестовая запись",
                        "languageId" => 1
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

    public function testDeleteCustomerGroup()
    {
        $response = $this->delete(
            self::URI_DELETE_CUSTOMER_GROUP,
            [],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }
}
