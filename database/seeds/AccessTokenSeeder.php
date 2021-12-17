<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccessTokenSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oauth_access_tokens')->insert([
            'id' => 'ee3c57cc0128656d5e37a62cccfb379f446948f0e2f1b630ab50ee6f09f995c6715644272288f0c9',
            'user_id' => 1,
            'client_id' => 1,
            'expires_at' => '2021-02-19 06:55:27',
            'created_at' => '2020-02-20 06:55:27',
            'updated_at' => '2020-02-20 06:55:27',
            'revoked' => false,
        ]);
    }
}
