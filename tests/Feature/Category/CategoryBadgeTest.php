<?php

namespace Tests\Feature\Category;

use Tests\Feature\BaseTestCase;

class CategoryBadgeTest extends BaseTestCase
{
    private const TEST_BADGE_ID = 1;
    private const TEST_BADGE_DELETE_ID = 2;
    private const URI_GET_BADGES = 'api/categories/badges';
    private const URI_SHOW_BADGE = 'api/categories/badges/show/' . self::TEST_BADGE_ID;
    private const URI_CREATE_BADGE = 'api/categories/badges/new';
    private const URI_EDIT_BADGE = 'api/categories/badges/edit/' . self::TEST_BADGE_ID;
    private const URI_DELETE_BADGE = 'api/categories/badges/delete/' . self::TEST_BADGE_DELETE_ID;

    public function testGetBadges()
    {
        $response = $this->get(
            self::URI_GET_BADGES,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }

    public function testShowBadge()
    {
        $response = $this->get(
            self::URI_SHOW_BADGE,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }

    public function testCreateBadge()
    {
        $response = $this->post(
            self::URI_CREATE_BADGE,
            [
                'code' => 'test',
                'image' => ''
            ],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(201);
    }

    public function testEditBadge()
    {
        $response = $this->put(
            self::URI_EDIT_BADGE,
            [
                'code' => 'test',
                'image' => ''
            ],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }

    public function testDeleteBadge()
    {
        $response = $this->delete(
            self::URI_DELETE_BADGE,
            [],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }
}
