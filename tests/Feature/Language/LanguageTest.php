<?php

namespace Tests\Feature\Language;

use Tests\Feature\BaseTestCase;

class LanguageTest extends BaseTestCase
{
    private const TEST_LANGUAGE_ID = 1;
    private const TEST_LANGUAGE_DELETE_ID = 2;
    private const URI_GET_LANGUAGES = 'api/languages';
    private const URI_SHOW_LANGUAGE = 'api/languages/' . self::TEST_LANGUAGE_ID . '/show';
    private const URI_CREATE_LANGUAGE = 'api/languages/new';
    private const URI_EDIT_LANGUAGE = 'api/languages/' . self::TEST_LANGUAGE_ID . '/edit';
    private const URI_DELETE_LANGUAGE = 'api/languages/' . self::TEST_LANGUAGE_DELETE_ID . '/delete';

    public function testGetLanguages()
    {
        $response = $this->get(
            self::URI_GET_LANGUAGES,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }

    public function testShowLanguage()
    {
        $response = $this->get(
            self::URI_SHOW_LANGUAGE,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }

    public function testCreateLanguage()
    {
        $response = $this->post(
            self::URI_CREATE_LANGUAGE,
            [
                'name' => 'uk',
                'code' => 'uk_UK',
                'locale' => 'ukrainian',
                'image' => '',
                'status' => true,
                'deleted' => false,
            ],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );
        $response->assertStatus(201);
    }

    public function testEditLanguage()
    {
        $response = $this->put(
            self::URI_EDIT_LANGUAGE,
            [ 'name' => 'uk',
                'code' => 'uk_UK',
                'locale' => 'ukrainian',
                'image' => '',
                'status' => true,
                'deleted' => false,
            ],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }

    public function testDeleteLanguage()
    {
        $response = $this->delete(
            self::URI_DELETE_LANGUAGE,
            [],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );

        $response->assertStatus(200);
    }
}
