<?php

namespace Tests\Feature\User;

use Tests\Feature\BaseTestCase;

class PermissionTest extends BaseTestCase
{
    private const TEST_PERMISSION_ID = 10;
    private const TEST_PERMISSION_DELETE_ID = 16;
    private const URI_GET_PERMISSIONS = 'api/user_permissions';
    private const URI_SHOW_PERMISSION = 'api/user_permissions/show/' . self::TEST_PERMISSION_ID;
    private const URI_CREATE_PERMISSION = 'api/user_permissions/new';
    private const URI_EDIT_PERMISSION = 'api/user_permissions/edit/' . self::TEST_PERMISSION_ID;
    private const URI_DELETE_PERMISSION = 'api/user_permissions/delete/' . self::TEST_PERMISSION_DELETE_ID;

    public function testGetPermissions()
    {
        $response = $this->get(
            self::URI_GET_PERMISSIONS,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );
        $response->assertStatus(200);
    }

    public function testShowPermission()
    {
        $response = $this->get(
            self::URI_SHOW_PERMISSION,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );
        $response->assertStatus(200);
    }

    public function testCreatePermission()
    {
        $response = $this->post(
            self::URI_CREATE_PERMISSION,
            [
                "name" => "test_permission",
                "descriptions" => [
                    [
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

    public function testEditPermission()
    {
        $response = $this->put(
            self::URI_EDIT_PERMISSION,
            [
                "name" => "test_permission11",
                "descriptions" => [
                    [
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

    public function testDeletePermission()
    {
        $response = $this->delete(
            self::URI_DELETE_PERMISSION,
            [],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );
        $response->assertStatus(200);
    }
}
