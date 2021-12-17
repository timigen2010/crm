<?php

namespace Tests\Feature\Common;

use Tests\Feature\BaseTestCase;

class DirectoryTest extends BaseTestCase
{
    private const URI_GET_DIRECTORIES = 'api/directories';

    public function testGetDirectories()
    {
        $response = $this->get(
            self::URI_GET_DIRECTORIES,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('ACCESS_TOKEN')
            ]
        );
        $response->assertStatus(200);
    }
}
