<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryBadgeSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'category_badge_id' => 1,
                'code' => 'test',
                'image' => ''
            ],
            [
                'category_badge_id' => 2,
                'code' => 'test_delete',
                'image' => ''
            ]
        ];
        foreach($data as $item) {
            DB::table('category_badges')->insert([
                'category_badge_id' => $item['category_badge_id'],
                'code' => $item['code'],
                'image' => $item['image']
            ]);
        }
    }
}
