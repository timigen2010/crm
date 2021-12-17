<?php

use Illuminate\Database\Seeder;

class DialStatusSeeder extends Seeder
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
                'dial_status_id' => 1,
                'code' => 'Bridge',
                'descriptions' => [
                    [
                        'dial_status_description_id' => 1,
                        'language_id' => 1,
                        'name' => 'Соединение',
                        'description' => '',
                    ]
                ]
            ],
            [
                'dial_status_id' => 2,
                'code' => 'DialBegin',
                'descriptions' => [
                    [
                        'dial_status_description_id' => 2,
                        'language_id' => 1,
                        'name' => 'Начат дозвон',
                        'description' => '',
                    ]
                ]
            ],
            [
                'dial_status_id' => 3,
                'code' => 'DialEnd',
                'descriptions' => [
                    [
                        'dial_status_description_id' => 3,
                        'language_id' => 1,
                        'name' => 'Дозвон окончен',
                        'description' => '',
                    ]
                ]
            ],
            [
                'dial_status_id' => 4,
                'code' => 'new',
                'descriptions' => [
                    [
                        'dial_status_description_id' => 4,
                        'language_id' => 1,
                        'name' => 'Новый',
                        'description' => '',
                    ]
                ]
            ],
            [
                'dial_status_id' => 5,
                'code' => 'complete',
                'descriptions' => [
                    [
                        'dial_status_description_id' => 5,
                        'language_id' => 1,
                        'name' => 'Завершенный',
                        'description' => '',
                    ]
                ]
            ]
        ];
        foreach($data as $item) {
            DB::table('dial_statuses')->insert([
                'dial_status_id' => $item['dial_status_id'],
                'code' => $item['code']
            ]);
            if (!empty($item["descriptions"]) && is_array($item["descriptions"])) {
                foreach ($item["descriptions"] as $description) {
                    DB::table('dial_status_descriptions')->insert([
                        'dial_status_id' => $item['dial_status_id'],
                        'dial_status_description_id' => $description['dial_status_description_id'],
                        'language_id' => $description['language_id'],
                        'name' => $description['name'],
                        'description' => $description['description'],
                    ]);
                }
            }
        }
    }
}
