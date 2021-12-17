<?php

namespace Tests\Feature\Category;

use Tests\Feature\BaseTestCase;

class CategoryTest extends BaseTestCase
{
    private const TEST_CATEGORY_ID = 1;
    private const TEST_CATEGORY_DELETE_ID = 2;
    private const URI_GET_CATEGORIES = 'api/categories';
    private const URI_SHOW_CATEGORY = 'api/categories/show/' . self::TEST_CATEGORY_ID;
    private const URI_CREATE_CATEGORY = 'api/categories/new';
    private const URI_EDIT_CATEGORY = 'api/categories/edit/' . self::TEST_CATEGORY_ID;
    private const URI_DELETE_CATEGORY = 'api/categories/delete/' . self::TEST_CATEGORY_DELETE_ID;

    public function testGetCategories()
    {
        $response = $this->get(
            self::URI_GET_CATEGORIES,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }

    public function testShowCategory()
    {
        $response = $this->get(
            self::URI_SHOW_CATEGORY,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }

    public function testCreateCategory()
    {
        $response = $this->post(
            self::URI_CREATE_CATEGORY,
            [
                'categoryBadgeId' => 1,
                'status' => 1,
                'descriptions' => [
                    [
                        'description' => 'description',
                        'name' => 'name',
                        'languageId' => 1,
                        'companyId' => 1,
                        'h1Title' => 'h1Title',
                        'metaTitle' => 'metaTitle',
                        'shortDescription' => 'shortDescription',
                        'metaDescription' => 'metaDescription',
                        'metaKeywords' => 'metaKeywords',
                    ]
                ],
                'menus' => [1, 2]
            ],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(201);
    }

    public function testEditCategory()
    {
        $response = $this->put(
            self::URI_EDIT_CATEGORY,
            [
                'categoryBadgeId' => 1,
                'status' => 1,
                'descriptions' => [
                    [
                        'description' => 'description',
                        'name' => 'name',
                        'languageId' => 1,
                        'companyId' => 1,
                        'h1Title' => 'h1Title',
                        'metaTitle' => 'metaTitle',
                        'shortDescription' => 'shortDescription',
                        'metaDescription' => 'metaDescription',
                        'metaKeywords' => 'metaKeywords',
                    ]
                ],
                'menus' => [1, 2]
            ],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }

    public function testDeleteCategory()
    {
        $response = $this->delete(
            self::URI_DELETE_CATEGORY,
            [],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }
}
