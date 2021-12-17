<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OAuthClientSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oauth_clients')->insert([
            'id' => 1,
            'name' => 'test_new_crm',
            'secret' => '3ckOCRQLRzqA0nyqTkcLoHejiXiwABsj6g2xPYkP',
            'redirect' => 'http://localhost',
            'personal_access_client' => false,
            'password_client' => true,
            'revoked' => false
        ]);

        DB::table('oauth_personal_access_clients')->insert([
            'id' => 1,
            'client_id' => 1
        ]);
    }
}
