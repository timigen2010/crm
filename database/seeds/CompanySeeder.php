<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
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
                'company_id' => 1,
                'is_admin' => true,
                'url' => 'test.ru',
                'ssl' => '',
                'settings' => [
                    [
                        'code' => 'config',
                        'key' => 'config_admin_language',
                        'value' => '1',
                        'is_serialized' => false
                    ],
                    [
                        'code' => 'config',
                        'key' => 'config_admin_currency',
                        'value' => '1',
                        'is_serialized' => false
                    ]
                ],
                "descriptions" => [
                    [
                        'company_description_id' => 1,
                        'language_id' => 1,
                        'name' => 'name',
                        'long_name' => 'longName',
                        'keyword' => 'keyword',
                    ]
                ]
            ],
            [
                'company_id' => 2,
                'is_admin' => false,
                'url' => 'localhost',
                'ssl' => '',
                'settings' => [
                    [
                        'code' => 'config',
                        'key' => 'config_admin_language',
                        'value' => '1',
                        'is_serialized' => false
                    ],
                    [
                        'code' => 'config',
                        'key' => 'config_admin_currency',
                        'value' => '1',
                        'is_serialized' => false
                    ]
                ],
                "descriptions" => [
                    [
                        'company_description_id' => 2,
                        'language_id' => 1,
                        'name' => 'name',
                        'long_name' => 'longName',
                        'keyword' => 'keyword',
                    ]
                ]
            ]
        ];
        foreach($data as $item) {
            DB::table('companies')->insert([
                'company_id' => $item['company_id'],
                'is_admin' => $item['is_admin'],
                'url' => $item['url'],
                'ssl' => $item['ssl'],
            ]);
            foreach ($item['settings'] as $setting) {
                DB::table('company_settings')->insert([
                    'company_id' => $item['company_id'],
                    'code' => $setting['code'],
                    'key' => $setting['key'],
                    'value' => $setting['value'],
                    'is_serialized' => $setting['is_serialized']
                ]);
            }
            foreach ($item['descriptions'] as $description) {
                DB::table('company_descriptions')->insert([
                    'company_id' => $item['company_id'],
                    'company_description_id' => $description['company_description_id'],
                    'language_id' => $description['language_id'],
                    'name' => $description['name'],
                    'long_name' => $description['long_name'],
                    'keyword' => $description['keyword'],
                ]);
            }
        }
    }
}
