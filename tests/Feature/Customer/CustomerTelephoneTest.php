<?php

namespace Tests\Feature\Customer;

use Tests\Feature\BaseTestCase;

class CustomerTelephoneTest extends BaseTestCase
{
    private const TEST_TELEPHONE_PREFIX = '38095';
    private const URI_FIND_TELEPHONES = 'api/customers/find_telephones?telephone=' . self::TEST_TELEPHONE_PREFIX;

    public function testFindTelephones()
    {
        $response = $this->get(
            self::URI_FIND_TELEPHONES,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }
}
