<?php

namespace Tests\Feature\User;

use Tests\Feature\BaseTestCase;

class UserGroupTest extends BaseTestCase
{
    private const TEST_USER_GROUP_ID = 3;
    private const TEST_USER_GROUP_DELETE_ID = 4;
    private const URI_GET_USER_GROUPS = 'api/user_groups';
    private const URI_SHOW_USER_GROUP = 'api/user_groups/show/' . self::TEST_USER_GROUP_ID;
    private const URI_CREATE_USER_GROUP = 'api/user_groups/new';
    private const URI_EDIT_USER_GROUP = 'api/user_groups/edit/' . self::TEST_USER_GROUP_ID;
    private const URI_DELETE_USER_GROUP = 'api/user_groups/delete/' . self::TEST_USER_GROUP_DELETE_ID;

    public function testGetUserGroups()
    {
        $response = $this->get(
            self::URI_GET_USER_GROUPS,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }

    public function testShowUserGroup()
    {
        $response = $this->get(
            self::URI_SHOW_USER_GROUP,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }

    public function testCreateUserGroup()
    {
        $response = $this->post(
            self::URI_CREATE_USER_GROUP,
            [
                "name" => "test",
                "permissions" => [1, 2, 3]
            ],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(201);
    }

    public function testEditUserGroup()
    {
        $response = $this->put(
            self::URI_EDIT_USER_GROUP,
            [
                "name" => "test",
                "permissions" => [1, 2, 3]
            ],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }

    public function testDeleteUserGroup()
    {
        $response = $this->delete(
            self::URI_DELETE_USER_GROUP,
            [],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }
}
