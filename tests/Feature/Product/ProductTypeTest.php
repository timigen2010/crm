<?php

namespace Tests\Feature\Product;

use Tests\Feature\BaseTestCase;

class ProductTypeTest extends BaseTestCase
{
    private const URI_GET_PRODUCT_TYPES = 'api/products/types';

    public function testGetProductTypes()
    {
        $response = $this->get(
            self::URI_GET_PRODUCT_TYPES,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }
}
