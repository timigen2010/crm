<?php

namespace Tests\Feature\Company;

use Tests\Feature\BaseTestCase;

class CompanyPhonelineTest extends BaseTestCase
{
    private const TEST_COMPANY_PHONELINE_ID = 2;
    private const TEST_COMPANY_PHONELINE_DELETE_ID = 3;
    private const URI_GET_COMPANY_PHONELINES = 'api/companies/phonelines';
    private const URI_SHOW_COMPANY_PHONELINE = 'api/companies/phonelines/show/' . self::TEST_COMPANY_PHONELINE_ID;
    private const URI_CREATE_COMPANY_PHONELINE = 'api/companies/phonelines/new';
    private const URI_EDIT_COMPANY_PHONELINE = 'api/companies/phonelines/edit/' . self::TEST_COMPANY_PHONELINE_ID;
    private const URI_DELETE_COMPANY_PHONELINE = 'api/companies/phonelines/delete/' . self::TEST_COMPANY_PHONELINE_DELETE_ID;

    public function testGetCompanyPhonelines()
    {
        $response = $this->get(
            self::URI_GET_COMPANY_PHONELINES,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }

    public function testShowCompanyPhoneline()
    {
        $response = $this->get(
            self::URI_SHOW_COMPANY_PHONELINE,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }

    public function testCreateCompanyPhoneline()
    {
        $response = $this->post(
            self::URI_CREATE_COMPANY_PHONELINE,
            [
                "keyword" => 'testing_creation',
                "companyId" => 1,
                "descriptions" => [
                    [
                        "name" => "Тестовая запись",
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

    public function testEditCompanyPhoneline()
    {
        $response = $this->put(
            self::URI_EDIT_COMPANY_PHONELINE,
            [
                "keyword" => "edit_testing",
                "companyId" => 1,
                "descriptions" => [
                    [
                        "name" => "Тестовая запись 2",
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

    public function testDeleteCompanyPhoneline()
    {
        $response = $this->delete(
            self::URI_DELETE_COMPANY_PHONELINE,
            [],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }
}
