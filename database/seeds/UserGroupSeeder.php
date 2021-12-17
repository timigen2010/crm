<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserGroupSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $groupId = DB::table('user_groups')->insertGetId([
            'user_group_id' => 1,
            'name' => 'admin'
        ]);
        $permissions = [1,2,3,4,5,6,7,8,9,11,12,13,14,15,17,18,19,20,
            21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,
            41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,
            61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,
            81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100,
            101,102,103,104,105,106,107];
        foreach ($permissions as $permission) {
            DB::table('user_groups_to_permissions')->insert([
                'user_group_id' => $groupId,
                'user_permission_id' => $permission
            ]);
        }

        DB::table('user_groups')->insert([
            'user_group_id' => 2,
            'name' => 'operator'
        ]);

        DB::table('user_groups')->insert([
            'user_group_id' => 3,
            'name' => 'test'
        ]);

        DB::table('user_groups')->insert([
            'user_group_id' => 4,
            'name' => 'test_delete'
        ]);
    }
}
