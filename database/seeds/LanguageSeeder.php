<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
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
                'language_id' => 1,
                'name' => 'ru',
                'code' => 'ru_RU',
                'locale' => 'russian',
                'image' => '',
                'status' => true,
                'deleted' => false,
            ],
            [
                'language_id' => 2,
                'name' => 'en',
                'code' => 'en_EN',
                'locale' => 'english',
                'image' => '',
                'status' => true,
                'deleted' => false,
            ]
        ];
        foreach($data as $item) {
            DB::table('languages')->insert([
                'language_id' => $item['language_id'],
                'name' => $item['name'],
                'code' => $item['code'],
                'locale' => $item['locale'],
                'image' => $item['image'],
                'status' => $item['status'],
                'deleted' => $item['deleted'],
            ]);
        }
    }
}
