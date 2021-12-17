<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WeightClassSeeder extends Seeder
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
                'weight_class_id' => 1,
                'main_class_id' => null,
                'deleted' => false,
                'value' => 1,
                'descriptions' => [
                    [
                        'weight_class_description_id' => 1,
                        'title' => 'title',
                        'unit' => 'unit',
                        'language_id' => 1,
                    ]
                ]
            ],
            [
                'weight_class_id' => 2,
                'main_class_id' => 1,
                'deleted' => false,
                'value' => 15,
                'descriptions' => [
                    [
                        'weight_class_description_id' => 2,
                        'title' => 'title',
                        'unit' => 'unit',
                        'language_id' => 1,
                    ]
                ]
            ]
        ];
        foreach($data as $item) {
            DB::table('weight_classes')->insert([
                'weight_class_id' => $item['weight_class_id'],
                'main_class_id' => $item['main_class_id'],
                'deleted' => $item['deleted'],
                'value' => $item['value'],
            ]);
            if (!empty($item["descriptions"]) && is_array($item["descriptions"])) {
                foreach ($item["descriptions"] as $description) {
                    DB::table('weight_class_descriptions')->insert([
                        'weight_class_id' => $item['weight_class_id'],
                        'weight_class_description_id' => $description['weight_class_description_id'],
                        'title' => $description['title'],
                        'unit' => $description['unit'],
                        'language_id' => $description['language_id'],
                    ]);
                }
            }
        }
    }
}
