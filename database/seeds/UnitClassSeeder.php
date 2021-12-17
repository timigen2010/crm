<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitClassSeeder extends Seeder
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
                'unit_class_id' => 1,
                'main_class_id' => null,
                'deleted' => false,
                'value' => 1,
                'descriptions' => [
                    [
                        'unit_class_description_id' => 1,
                        'title' => 'title',
                        'unit' => 'unit',
                        'language_id' => 1,
                    ]
                ]
            ],
            [
                'unit_class_id' => 2,
                'main_class_id' => 1,
                'deleted' => false,
                'value' => 15,
                'descriptions' => [
                    [
                        'unit_class_description_id' => 2,
                        'title' => 'title',
                        'unit' => 'unit',
                        'language_id' => 1,
                    ]
                ]
            ]
        ];
        foreach($data as $item) {
            DB::table('unit_classes')->insert([
                'unit_class_id' => $item['unit_class_id'],
                'main_class_id' => $item['main_class_id'],
                'deleted' => $item['deleted'],
                'value' => $item['value'],
            ]);
            if (!empty($item["descriptions"]) && is_array($item["descriptions"])) {
                foreach ($item["descriptions"] as $description) {
                    DB::table('unit_class_descriptions')->insert([
                        'unit_class_id' => $item['unit_class_id'],
                        'unit_class_description_id' => $description['unit_class_description_id'],
                        'title' => $description['title'],
                        'unit' => $description['unit'],
                        'language_id' => $description['language_id'],
                    ]);
                }
            }
        }
    }
}
