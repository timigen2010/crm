<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerGroupSeeder extends Seeder
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
                'customer_group_id' => 1,
                'customer_group_description_id' => 1,
                'name' => 'V.I.P',
                'description' => 'Особые, важные клиенты'
            ],
            [
                'customer_group_id' => 2,
                'customer_group_description_id' => 2,
                'name' => 'Компания',
                'description' => 'организация'
            ],
            [
                'customer_group_id' => 3,
                'customer_group_description_id' => 3,
                'name' => 'Новые',
                'description' => 'Сделавшие один заказ'
            ],
            [
                'customer_group_id' => 4,
                'customer_group_description_id' => 4,
                'name' => 'Постоянные',
                'description' => 'Сделавшие 2 или более заказов'
            ],

            [
                'customer_group_id' => 5,
                'customer_group_description_id' => 5,
                'name' => 'Потенциальный',
                'description' => 'Группа новых клиентов без заказов'
            ]
        ];
        foreach($data as $item) {
            DB::table('customer_groups')->insert([
                'customer_group_id' => $item['customer_group_id'],
                'company_id' => 1
            ]);
            DB::table('customer_group_descriptions')->insert([
                'customer_group_description_id' => $item['customer_group_description_id'],
                'customer_group_id' => $item['customer_group_id'],
                'description' => $item['description'],
                'name' => $item['name'],
                'language_id' => 1
            ]);
        }
    }
}
