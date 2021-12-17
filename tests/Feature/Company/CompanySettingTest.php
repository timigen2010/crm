<?php

namespace Tests\Feature\Company;

use Tests\Feature\BaseTestCase;

class CompanySettingTest extends BaseTestCase
{
    private const TEST_COMPANY_ID = 1;
    private const TEST_SETTING_KEY = 'config_admin_language';
    private const URI_GET_SETTING_BY_KEY = 'api/companies/' . self::TEST_COMPANY_ID . '/settings/' . self::TEST_SETTING_KEY;

    public function testGetSettingByKey()
    {
        $response = $this->get(
            self::URI_GET_SETTING_BY_KEY,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }
}
