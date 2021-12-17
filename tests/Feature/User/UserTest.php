<?php

namespace Tests\Feature\User;

use Tests\Feature\BaseTestCase;

class UserTest extends BaseTestCase
{
    private const TEST_USER_ID = 2;
    private const TEST_USER_DELETE_ID = 3;
    private const TEST_USER_GROUP_ID = 3;
    private const URI_GET_USERS = "/api/users";
    private const URI_SHOW_USER = "/api/users/show/" . self::TEST_USER_ID;
    private const URI_REGISTER_USER = "/api/users/register";
    private const URI_EDIT_USER = "/api/users/edit/" . self::TEST_USER_ID;
    private const URI_DELETE_USER = "/api/users/delete/" . self::TEST_USER_DELETE_ID;
    private const URI_CHANGE_PASSWORD = "/api/users/change_password";

    public function testGetUsers()
    {
        $response = $this->get(
            self::URI_GET_USERS,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );
        $response->assertStatus(200);
    }

    public function testShowUser()
    {
        $response = $this->get(
            self::URI_SHOW_USER,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );
        $response->assertStatus(200);
    }

    public function testRegisterUser()
    {
        $response = $this->post(
            self::URI_REGISTER_USER,
            [
                "username" => "testing",
                "userGroupId" => self::TEST_USER_GROUP_ID,
                'password' => "test333",
                'salt' => 'test',
                "hidePhone" => false,
                "status" => true,
                "firstName" => "First Name",
                "lastName" => "Last Name",
                "email" => "fl@test.com",
                "sipPhone" => "1234",
                "sipPassword" => "test333",
            ],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );
        $response->assertStatus(201);
    }

    public function testEditUser()
    {
        $response = $this->put(
            self::URI_EDIT_USER,
            [
                "username" => "OperatorTesting",
                "userGroupId" => self::TEST_USER_GROUP_ID,
                'password' => "test333",
                "hidePhone" => false,
                "status" => true,
                "firstName" => "Operator",
                "lastName" => "Test",
                "email" => "operator_test@gmail.com"
            ],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );
        $response->assertStatus(200);
    }

    public function testDeleteUser()
    {
        $response = $this->delete(
            self::URI_DELETE_USER,
            [],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );
        $response->assertStatus(200);
    }

    public function testChangePassword()
    {
        $response = $this->post(
            self::URI_CHANGE_PASSWORD,
            [
                "oldPassword" => "testing",
                "newPassword" => "123456",
            ],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );
        $response->assertStatus(200);
    }
}
