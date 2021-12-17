<?php

namespace Tests\Feature\Call;

use Tests\Feature\BaseTestCase;

class CallActivityTest extends BaseTestCase
{
    private const TEST_CALL_ID = 1;
    private const URI_GET_CALLS = 'api/calls/activities';
    private const URI_SHOW_CALL = 'api/calls/activities/show/' . self::TEST_CALL_ID;
    private const URI_CREATE_CALL = 'api/calls/activities/new';
    private const URI_EDIT_CALL = 'api/calls/activities/edit/' . self::TEST_CALL_ID;

    public function testGetCalls()
    {
        $response = $this->get(
            self::URI_GET_CALLS,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }

    public function testShowCall()
    {
        $response = $this->get(
            self::URI_SHOW_CALL,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }

    public function testCreateCall()
    {
        $response = $this->post(
            self::URI_CREATE_CALL,
            [
                'sourceType' => 1,
                'sourceId' => 1,
                'source' => '123',
                'destinationType' => 2,
                'destinationId' => 2,
                'destination' => '7890564563454',
                'companyId' => 1,
                'comment' => 'test',
                'dateStart' => '2020-03-01 12:00:00',
                'statusDial' => 1,
            ],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(201);
    }

    public function testEditCall()
    {
        $response = $this->put(
            self::URI_EDIT_CALL,
            [
                'sourceType' => 1,
                'sourceId' => 1,
                'source' => '123',
                'destinationType' => 2,
                'destinationId' => 2,
                'destination' => '7890564563454',
                'companyId' => 1,
                'companyPhonelineId' => 1,
                'phoneline' => 'test',
                'comment' => 'test',
                'dateStart' => '2020-03-01 12:00:00',
                'dateEnd' => '2020-03-01 12:30:00',
                'duration' => 3000,
                'durationLive' => 2800,
                'record' => 'test.wav',
                'uniqueId' => '23423434',
                'disposition' => 1,
                'statusDial' => 1,
            ],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }
}
