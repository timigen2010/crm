<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $userId = DB::table('users')->insertGetId([
            'username' => 'Admin',
            'password' => '2b358e5679ae081d0b591ba55fb8f0a7f5acbdc7', // testing
            'salt' => '3436cd7e7',
            'status' => true,
            'hide_phone' => false,
            'user_group_id' => 1
        ]);
        DB::table('user_profiles')->insert([
            'user_id' => $userId,
            'first_name' => 'Admin',
            'last_name' => 'Test',
            'email' => 'test@gmail.com',
            'avatar' => null,
        ]);

        $userId = DB::table('users')->insertGetId([
            'username' => 'Operator',
            'password' => '3e7eb344b94ec736ca101ad5f1fd9eb86c5f2e20', // test
            'salt' => 'dc71acb66',
            'status' => true,
            'hide_phone' => false,
            'user_group_id' => 2
        ]);
        DB::table('user_profiles')->insert([
            'user_id' => $userId,
            'first_name' => 'Operator',
            'last_name' => 'Test',
            'email' => 'operator@gmail.com',
            'avatar' => null,
        ]);

        $userId = DB::table('users')->insertGetId([
            'username' => 'Test',
            'password' => '3e7eb344b94ec736ca101ad5f1fd9eb86c5f2e20', // test
            'salt' => 'dc71acb66',
            'status' => true,
            'hide_phone' => false,
            'user_group_id' => 2
        ]);
        DB::table('user_profiles')->insert([
            'user_id' => $userId,
            'first_name' => 'Test',
            'last_name' => 'Delete',
            'email' => 'delete@gmail.com',
            'avatar' => null,
        ]);
    }
}
