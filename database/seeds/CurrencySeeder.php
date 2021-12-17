<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
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
                'currency_id' => 1,
                'main_currency_id' => null,
                'deleted' => false,
                'code' => 'usd',
                'decimal_place' => 2,
                'value' => 1,
                'status' => true,
                'descriptions' => [
                    [
                        'currency_description_id' => 1,
                        'name' => 'title',
                        'symbol_left' => 'symbol_left',
                        'symbol_right' => 'symbol_left',
                        'language_id' => 1,
                    ]
                ],
                'created_at' => (new \DateTime())->format('Y-m-d h:i:s'),
                'updated_at' => (new \DateTime())->format('Y-m-d h:i:s'),
            ],
            [
                'currency_id' => 2,
                'main_currency_id' => 1,
                'deleted' => false,
                'code' => 'rub',
                'decimal_place' => 2,
                'value' => 65,
                'status' => true,
                'descriptions' => [
                    [
                        'currency_description_id' => 2,
                        'name' => 'title',
                        'symbol_left' => 'symbol_left',
                        'symbol_right' => 'symbol_left',
                        'language_id' => 1,
                    ]
                ],
                'created_at' => (new \DateTime())->format('Y-m-d h:i:s'),
                'updated_at' => (new \DateTime())->format('Y-m-d h:i:s'),
            ],
            [
                'currency_id' => 3,
                'main_currency_id' => 1,
                'deleted' => false,
                'code' => 'eur',
                'decimal_place' => 2,
                'value' => 1,
                'status' => true,
                'descriptions' => [
                    [
                        'currency_description_id' => 3,
                        'name' => 'title',
                        'symbol_left' => 'symbol_left',
                        'symbol_right' => 'symbol_left',
                        'language_id' => 1,
                    ]
                ],
                'created_at' => (new \DateTime())->format('Y-m-d h:i:s'),
                'updated_at' => (new \DateTime())->format('Y-m-d h:i:s'),
            ],
            [
                'currency_id' => 4,
                'main_currency_id' => 1,
                'deleted' => false,
                'code' => 'uah',
                'decimal_place' => 2,
                'value' => 28,
                'status' => true,
                'descriptions' => [
                    [
                        'currency_description_id' => 4,
                        'name' => 'title',
                        'symbol_left' => 'symbol_left',
                        'symbol_right' => 'symbol_left',
                        'language_id' => 1,
                    ]
                ],
                'created_at' => (new \DateTime())->format('Y-m-d h:i:s'),
                'updated_at' => (new \DateTime())->format('Y-m-d h:i:s'),
            ],
        ];
        foreach($data as $item) {
            DB::table('currencies')->insert([
                'currency_id' => $item['currency_id'],
                'main_currency_id' => $item['main_currency_id'],
                'deleted' => $item['deleted'],
                'value' => $item['value'],
                'code' => $item['code'],
                'decimal_place' => $item['decimal_place'],
                'status' => $item['status'],
            ]);
            if (!empty($item["descriptions"]) && is_array($item["descriptions"])) {
                foreach ($item["descriptions"] as $description) {
                    DB::table('currency_descriptions')->insert([
                        'currency_id' => $item['currency_id'],
                        'currency_description_id' => $description['currency_description_id'],
                        'language_id' => $description['language_id'],
                        'name' => $description['name'],
                        'symbol_left' => $description['symbol_left'],
                        'symbol_right' => $description['symbol_right'],
                    ]);
                }
            }
        }
    }
}
