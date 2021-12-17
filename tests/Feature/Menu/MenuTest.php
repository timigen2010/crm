<?php

namespace Tests\Feature\Menu;

use Tests\Feature\BaseTestCase;

class MenuTest extends BaseTestCase
{
    private const TEST_MENU_ID = 1;
    private const TEST_MENU_DELETE_ID = 2;
    private const URI_GET_MENUS = 'api/menus';
    private const URI_SHOW_MENU = 'api/menus/show/' . self::TEST_MENU_ID;
    private const URI_CREATE_MENU = 'api/menus/new';
    private const URI_EDIT_MENU = 'api/menus/edit/' . self::TEST_MENU_ID;
    private const URI_DELETE_MENU = 'api/menus/delete/' . self::TEST_MENU_DELETE_ID;

    public function testGetMenus()
    {
        $response = $this->get(
            self::URI_GET_MENUS,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }

    public function testShowMenu()
    {
        $response = $this->get(
            self::URI_SHOW_MENU,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }

    public function testCreateMenu()
    {
        $response = $this->post(
            self::URI_CREATE_MENU,
            [
                'name' => 'name',
                'companies' => [1],
            ],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(201);
    }

    public function testEditMenu()
    {
        $response = $this->put(
            self::URI_EDIT_MENU,
            [
                'name' => 'name',
                'companies' => [1],
            ],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }

    public function testDeleteMenu()
    {
        $response = $this->delete(
            self::URI_DELETE_MENU,
            [],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }
}
