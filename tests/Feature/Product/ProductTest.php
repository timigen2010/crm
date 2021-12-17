<?php

namespace Tests\Feature\Product;

use Tests\Feature\BaseTestCase;

class ProductTest extends BaseTestCase
{
    private const TEST_PRODUCT_ID = 1;
    private const TEST_PRODUCT_DELETE_ID = 2;
    private const TEST_MENU_ID = 1;
    private const URI_GET_PRODUCTS = 'api/products';
    private const URI_GET_PRODUCTS_BY_MENU = 'api/products/by_menu/' . self::TEST_MENU_ID;
    private const URI_SHOW_PRODUCT = 'api/products/show/' . self::TEST_PRODUCT_ID;
    private const URI_CREATE_PRODUCT = 'api/products/new';
    private const URI_EDIT_PRODUCT = 'api/products/edit/' . self::TEST_PRODUCT_ID;
    private const URI_DELETE_PRODUCT = 'api/products/delete/' . self::TEST_PRODUCT_DELETE_ID;

    public function testGetProducts()
    {
        $response = $this->get(
            self::URI_GET_PRODUCTS,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }

    public function testGetProductsByMenu()
    {
        $response = $this->get(
            self::URI_GET_PRODUCTS_BY_MENU,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }

    public function testShowProduct()
    {
        $response = $this->get(
            self::URI_SHOW_PRODUCT,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }

    public function testCreateProduct()
    {
        $response = $this->post(
            self::URI_CREATE_PRODUCT,
            [
                'productTypeId' => 1,
                'name' => 'test',
                'status' => true,
                'costPrice' => 100.10,
                'price' => 110.10,
                'currencyId' => 1,
                'unitClassId' => 1,
                'weightClassId' => 1,
                'minimum' => 1,
                'weight' => 1,
                'saleAble' => true,
                'cookingTime' => 50,
                'deleted' => false,
                'mainCategoryId' => 1,
                'dateAvailable' => (new \DateTime('+5 days'))->format('Y-m-d h:i:s'),
                'descriptions' => [
                    [
                        'languageId' => 1,
                        'companyId' => 1,
                        'description' => 'description',
                        'seoDescription' => 'seo_description',
                        'metaTitle' => 'meta_title',
                        'metaDescription' => 'metaDescription',
                        'metaKeywords' => 'metaKeywords',
                    ]
                ],
                'categories' => [1],
                'menus' => [1],
            ],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );
        $response->assertStatus(201);
    }

    public function testEditProduct()
    {
        $response = $this->put(
            self::URI_EDIT_PRODUCT,
            [
                'productTypeId' => 1,
                'name' => 'test',
                'status' => true,
                'costPrice' => 100.10,
                'price' => 110.10,
                'currencyId' => 1,
                'unitClassId' => 1,
                'weightClassId' => 1,
                'minimum' => 1,
                'weight' => 1,
                'saleAble' => true,
                'cookingTime' => 50,
                'deleted' => false,
                'mainCategoryId' => 1,
                'dateAvailable' => (new \DateTime('+5 days'))->format('Y-m-d h:i:s'),
                'descriptions' => [
                    [
                        'languageId' => 1,
                        'companyId' => 1,
                        'description' => 'description',
                        'seoDescription' => 'seo_description',
                        'metaTitle' => 'meta_title',
                        'metaDescription' => 'metaDescription',
                        'metaKeywords' => 'metaKeywords',
                    ]
                ],
                'categories' => [1],
                'menus' => [1],
            ],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }

    public function testDeleteProduct()
    {
        $response = $this->delete(
            self::URI_DELETE_PRODUCT,
            [],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }
}
