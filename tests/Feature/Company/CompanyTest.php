<?php

namespace Tests\Feature\Company;

use Tests\Feature\BaseTestCase;

class CompanyTest extends BaseTestCase
{
    private const TEST_COMPANY_ID = 1;
    private const TEST_COMPANY_DELETE_ID = 2;
    private const TEST_COMPANY_URL = 'localhost';
    private const URI_GET_COMPANIES = 'api/companies';
    private const URI_SHOW_COMPANY = 'api/companies/show/' . self::TEST_COMPANY_ID;
    private const URI_SHOW_COMPANY_BY_URL = 'api/companies/show_by_url/' . self::TEST_COMPANY_URL;
    private const URI_CREATE_COMPANY = 'api/companies/new';
    private const URI_EDIT_COMPANY = 'api/companies/edit/' . self::TEST_COMPANY_ID;
    private const URI_DELETE_COMPANY = 'api/companies/delete/' . self::TEST_COMPANY_DELETE_ID;

    public function testGetCompany()
    {
        $response = $this->get(
            self::URI_GET_COMPANIES,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }

    public function testShowCompany()
    {
        $response = $this->get(
            self::URI_SHOW_COMPANY,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }

    public function testShowCompanyByUrl()
    {
        $response = $this->get(
            self::URI_SHOW_COMPANY_BY_URL,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }

    public function testCreateCompany()
    {
        $response = $this->post(
            self::URI_CREATE_COMPANY,
            [
                'isAdmin' => false,
                'url' => 'test',
                'ssl' => 'test',
                'settings' => [
                    [
                        'code' => 'test',
                        'key' => 'test_key',
                        'value' => 'test',
                        'isSerialized' => false
                    ]
                ],
                "descriptions" => [
                    [
                        'languageId' => 1,
                        'name' => 'name',
                        'longName' => 'longName',
                        'keyword' => 'keyword',
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

    public function testEditCompany()
    {
        $response = $this->put(
            self::URI_EDIT_COMPANY,
            [
                'isAdmin' => false,
                'url' => 'test',
                'ssl' => 'test',
                'settings' => [
                    [
                        'code' => 'test',
                        'key' => 'test_key',
                        'value' => 'test',
                        'isSerialized' => false
                    ]
                ],
                "descriptions" => [
                    [
                        'languageId' => 1,
                        'name' => 'name',
                        'longName' => 'longName',
                        'keyword' => 'keyword',
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

    public function testDeleteCompany()
    {
        $response = $this->delete(
            self::URI_DELETE_COMPANY,
            [],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }
}
