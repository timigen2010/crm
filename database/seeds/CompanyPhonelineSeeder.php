<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyPhonelineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'company_phoneline_id' => 1,
                'company_phoneline_description_id' => 1,
                'keyword' => 'phoneline1',
                'name' => 'phoneline1'
            ],
            [
                'company_phoneline_id' => 2,
                'company_phoneline_description_id' => 2,
                'keyword' => 'phoneline2',
                'name' => 'phoneline2'
            ],
            [
                'company_phoneline_id' => 3,
                'company_phoneline_description_id' => 3,
                'keyword' => 'test',
                'name' => 'Тест'
            ]
        ];
        foreach($data as $item) {
            DB::table('company_phonelines')->insert([
                'company_phoneline_id' => $item['company_phoneline_id'],
                'company_id' => 1,
                'keyword' => $item['keyword']
            ]);
            DB::table('company_phoneline_descriptions')->insert([
                'company_phoneline_description_id' => $item['company_phoneline_description_id'],
                'company_phoneline_id' => $item['company_phoneline_id'],
                'name' => $item['name'],
                'language_id' => 1
            ]);
        }
    }
}
