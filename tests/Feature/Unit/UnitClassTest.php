<?php

namespace Tests\Feature\Unit;

use Tests\Feature\BaseTestCase;

class UnitClassTest extends BaseTestCase
{
    private const TEST_UNIT_CLASS_ID = 1;
    private const TEST_UNIT_CLASS_DELETE_ID = 2;
    private const URI_GET_UNIT_CLASSES = 'api/unit_classes';
    private const URI_SHOW_UNIT_CLASS = 'api/unit_classes/show/' . self::TEST_UNIT_CLASS_ID;
    private const URI_CREATE_UNIT_CLASS = 'api/unit_classes/new';
    private const URI_EDIT_UNIT_CLASS = 'api/unit_classes/edit/' . self::TEST_UNIT_CLASS_ID;
    private const URI_DELETE_UNIT_CLASS = 'api/unit_classes/delete/' . self::TEST_UNIT_CLASS_DELETE_ID;

    public function testGetUnitClasses()
    {
        $response = $this->get(
            self::URI_GET_UNIT_CLASSES,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }

    public function testShowUnitClass()
    {
        $response = $this->get(
            self::URI_SHOW_UNIT_CLASS,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }

    public function testCreateUnitClass()
    {
        $response = $this->post(
            self::URI_CREATE_UNIT_CLASS,
            [
                'mainClassId' => 1,
                'value' => 15,
                'descriptions' => [
                    [
                        'title' => 'title',
                        'unit' => 'unit',
                        'languageId' => 1,
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

    public function testEditUnitClass()
    {
        $response = $this->put(
            self::URI_EDIT_UNIT_CLASS,
            [
                'mainClassId' => null,
                'value' => 15,
                'descriptions' => [
                    [
                        'title' => 'title',
                        'unit' => 'unit',
                        'languageId' => 1,
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

    public function testDeleteUnitClass()
    {
        $response = $this->delete(
            self::URI_DELETE_UNIT_CLASS,
            [],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }
}
