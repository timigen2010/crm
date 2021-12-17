<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscountCardSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $dataRelease = [
            [ 'discount_released_card_id' => '000001' ],
            [ 'discount_released_card_id' => '000002' ]
        ];
        $data = [
            [
                'discount_card_id' => '000001',
                'customer_id' => 1,
                'customer_telephone_id' => 1,
                'user_id' => 1,
                'confirm_code' => 1111,
                'active' => true,
                'blocked' => false,
                'balance' => 10000,
                'date_released' => (new DateTime())->format('Y-m-d H:i:s'),
                'date_request' => (new DateTime())->format('Y-m-d H:i:s'),
                'date_activated' => (new DateTime())->format('Y-m-d H:i:s'),
                'date_blocked' => null,
            ],
            [
                'discount_card_id' => '000002',
                'customer_id' => 2,
                'customer_telephone_id' => 2,
                'user_id' => 1,
                'confirm_code' => 1234,
                'active' => false,
                'blocked' => false,
                'balance' => 0,
                'date_released' => (new DateTime())->format('Y-m-d H:i:s'),
                'date_request' => null,
                'date_activated' => null,
                'date_blocked' => null,
            ],
        ];
        foreach($dataRelease as $item) {
            DB::table('discount_released_cards')->insert([
                'discount_released_card_id' => $item['discount_released_card_id'],
            ]);
        }
        foreach($data as $item) {
            DB::table('discount_cards')->insert([
                'discount_card_id' => $item['discount_card_id'],
                'customer_id' => $item['customer_id'],
                'customer_telephone_id' => $item['customer_telephone_id'],
                'user_id' => $item['user_id'],
                'confirm_code' => $item['confirm_code'],
                'active' => $item['active'],
                'blocked' => $item['blocked'],
                'balance' => $item['balance'],
                'date_released' => $item['date_released'],
                'date_request' => $item['date_request'],
                'date_activated' => $item['date_activated'],
                'date_blocked' => $item['date_blocked'],
            ]);
        }
    }
}
