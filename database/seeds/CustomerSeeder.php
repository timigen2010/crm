<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
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
                'customer_id' => 1,
                'customer_group_id' => 3,
                'firstName' => 'Test',
                'lastName' => 'Test',
                'email' => 'email@test.com',
                'newsletter' => false,
                'status' => true,
                'address' => [
                    'customer_address_id' => 1,
                    'customer_id' => 1,
                    'city_id' => 1,
                    'address_1' => 'address_1',
                    'address_2' => 'address_2',
                    'is_main' => true
                ],
                'telephone' => [
                    'customer_telephone_id' => 1,
                    'customer_id' => 1,
                    'telephone' => '380953456786',
                    'is_main' => true
                ]
            ],
            [
                'customer_id' => 2,
                'customer_group_id' => 4,
                'firstName' => 'Test',
                'lastName' => 'Test',
                'email' => 'email2@test.com',
                'newsletter' => false,
                'status' => true,
                'address' => [
                    'customer_address_id' => 2,
                    'customer_id' => 2,
                    'city_id' => 1,
                    'address_1' => 'address_1',
                    'address_2' => 'address_2',
                    'is_main' => true
                ],
                'telephone' => [
                    'customer_telephone_id' => 2,
                    'customer_id' => 2,
                    'telephone' => '380953456777',
                    'is_main' => true
                ]
            ],
        ];
        foreach($data as $item) {
            DB::table('customers')->insert([
                'customer_id' => $item['customer_id'],
                'customer_group_id' => $item['customer_group_id'],
                'firstName' => $item['firstName'],
                'lastName' => $item['lastName'],
                'email' => $item['email'],
                'newsletter' => $item['newsletter'],
                'status' => $item['status'],
            ]);
            DB::table('customer_addresses')->insert([
                'customer_address_id' => $item['address']['customer_address_id'],
                'customer_id' => $item['address']['customer_id'],
                'city_id' => $item['address']['city_id'],
                'address_1' => $item['address']['address_1'],
                'address_2' => $item['address']['address_2'],
                'is_main' => $item['address']['is_main'],
            ]);
            DB::table('customer_telephones')->insert([
                'customer_telephone_id' => $item['telephone']['customer_telephone_id'],
                'customer_id' => $item['telephone']['customer_id'],
                'telephone' => $item['telephone']['telephone'],
                'is_main' => $item['telephone']['is_main'],
            ]);
        }
    }
}
