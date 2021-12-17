<?php

namespace Tests\Feature\Weight;

use Tests\Feature\BaseTestCase;

class WeightClassTest extends BaseTestCase
{
    private const TEST_WEIGHT_CLASS_ID = 1;
    private const TEST_WEIGHT_CLASS_DELETE_ID = 2;
    private const URI_GET_WEIGHT_CLASSES = 'api/weight_classes';
    private const URI_SHOW_WEIGHT_CLASS = 'api/weight_classes/' . self::TEST_WEIGHT_CLASS_ID . '/show';
    private const URI_CREATE_WEIGHT_CLASS = 'api/weight_classes/new';
    private const URI_EDIT_WEIGHT_CLASS = 'api/weight_classes/' . self::TEST_WEIGHT_CLASS_ID . '/edit';
    private const URI_DELETE_WEIGHT_CLASS = 'api/weight_classes/' . self::TEST_WEIGHT_CLASS_DELETE_ID . '/delete';
    private const URI_REBIND_WEIGHT_CLASS = 'api/weight_classes/' . self::TEST_WEIGHT_CLASS_ID . '/rebind';

    public function testGetWeightClasses()
    {
        $response = $this->get(
            self::URI_GET_WEIGHT_CLASSES,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }

    public function testShowWeightClass()
    {
        $response = $this->get(
            self::URI_SHOW_WEIGHT_CLASS,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }

    public function testCreateWeightClass()
    {
        $response = $this->post(
            self::URI_CREATE_WEIGHT_CLASS,
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

    public function testEditWeightClass()
    {
        $response = $this->put(
            self::URI_EDIT_WEIGHT_CLASS,
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

    public function testDeleteWeightClass()
    {
        $response = $this->delete(
            self::URI_DELETE_WEIGHT_CLASS,
            [],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }

    public function testRebindWeightClass()
    {
        $response = $this->post(
            self::URI_REBIND_WEIGHT_CLASS,
            [],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }
}
