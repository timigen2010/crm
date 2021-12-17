<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $orderStatuses = [
            [
                'order_status_id' => 1,
                'language_id' => 1,
                'name' => 'Создан/изменили',
            ],
            [
                'order_status_id' => 2,
                'language_id' => 1,
                'name' => 'Ожидание (новый)',
            ],
            [
                'order_status_id' => 3,
                'language_id' => 1,
                'name' => 'В разработке ',
            ],
            [
                'order_status_id' => 4,
                'language_id' => 1,
                'name' => 'Отправлен',
            ],
            [
                'order_status_id' => 5,
                'language_id' => 1,
                'name' => 'Завершен',
            ],
            [
                'order_status_id' => 6,
                'language_id' => 1,
                'name' => 'Возвращен',
            ],
            [
                'order_status_id' => 7,
                'language_id' => 1,
                'name' => 'Отменен',
            ],
            [
                'order_status_id' => 8,
                'language_id' => 1,
                'name' => 'Аннулирован',
            ],
            [
                'order_status_id' => 9,
                'language_id' => 1,
                'name' => 'Разъединен',
            ],
            [
                'order_status_id' => 10,
                'language_id' => 1,
                'name' => 'Объединен',
            ],
            [
                'order_status_id' => 11,
                'language_id' => 1,
                'name' => 'Оплачен',
            ]
        ];

        $orders = [
            [
                'order_id' => 1,
                'company_id' => 1,
                'menu_company_id' => 1,
                'count_person' => 1,
                'count_oddmoney' => 0,
                'count_uncash' => 0,
                'discount_card_id' => null,
                'discount_card_transaction_id' => null,
                'count_bonus' => 0,
                'count_bonus_add' => 0,
                'count_voucher' => 0,
                'user_id' => 1,
                'last_editor_id' => 1,
                'deleted' => false,
                'delivery_method' => 'self',
                'comment' => '',
                'total' => 110.10,
                'order_status_id' => 1,
                'language_id' => 1,
                'currency_id' => 2,
                'currency_code' => 'rub',
                'currency_value' => 65,
                'orderCustomer' => [
                    'customer_id' => 1,
                    'first_name' => 'Test',
                    'last_name' => 'Test',
                    'email' => 'email@test.com',
                    'telephone' => '380953456786',
                ],
                'order_payments' => [
                    'first_name' => 'Test',
                    'last_name' => 'Test',
                    'address_1' => 'address_1',
                    'address_2' => 'address_2',
                    'coords' => '',
                    'city' => 'Test',
                    'method' => 'cash',
                    'code' => 'code',
                ],
                'order_products' => [
                    [
                        'product_id' => 1,
                        'unit_class_id' => 1,
                        'discount_card_id' => null,
                        'currency_id' => 2,
                        'name' => 'test',
                        'amount' => 1,
                        'discount' => 1,
                        'price' => 110.10,
                        'total' => 110.10,
                        'deleted' => false,
                    ]
                ],
                'order_totals' => [
                    [
                        'code' => 'sub_total',
                        'title' => 'Сумма',
                        'value' => 110.10,
                    ],
                    [
                        'code' => 'cash',
                        'title' => 'Рубли',
                        'value' => 110.10,
                    ],
                    [
                        'code' => 'total',
                        'title' => 'Итого',
                        'value' => 110.10,
                    ]
                ]
            ]
        ];

        foreach ($orderStatuses as $orderStatus) {
            DB::table('order_statuses')->insert([
                'order_status_id' => $orderStatus['order_status_id'],
                'language_id' => $orderStatus['language_id'],
                'name' => $orderStatus['name'],
            ]);
        }

        foreach ($orders as $order) {
            DB::table('orders')->insert([
                'order_id' => $order['order_id'],
                'company_id' => $order['company_id'],
                'menu_company_id' => $order['menu_company_id'],
                'count_person' => $order['count_person'],
                'count_oddmoney' => $order['count_oddmoney'],
                'count_uncash' => $order['count_uncash'],
                'discount_card_id' => $order['discount_card_id'],
                'discount_card_transaction_id' => $order['discount_card_transaction_id'],
                'count_bonus' => $order['count_bonus'],
                'count_bonus_add' => $order['count_bonus_add'],
                'count_voucher' => $order['count_voucher'],
                'user_id' => $order['user_id'],
                'last_editor_id' => $order['last_editor_id'],
                'deleted' => $order['deleted'],
                'delivery_method' => $order['delivery_method'],
                'comment' => $order['comment'],
                'total' => $order['total'],
                'order_status_id' => $order['order_status_id'],
                'language_id' => $order['language_id'],
                'currency_id' => $order['currency_id'],
                'currency_code' => $order['currency_code'],
                'currency_value' => $order['currency_value'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
            DB::table('order_customers')->insert([
                'order_id' => $order['order_id'],
                'customer_id' => $order['orderCustomer']['customer_id'],
                'first_name' => $order['orderCustomer']['first_name'],
                'last_name' => $order['orderCustomer']['last_name'],
                'email' => $order['orderCustomer']['email'],
                'telephone' => $order['orderCustomer']['telephone'],
            ]);
            DB::table('order_payments')->insert([
                'order_id' => $order['order_id'],
                'first_name' => $order['order_payments']['first_name'],
                'last_name' => $order['order_payments']['last_name'],
                'address_1' => $order['order_payments']['address_1'],
                'address_2' => $order['order_payments']['address_2'],
                'coords' => $order['order_payments']['coords'],
                'city' => $order['order_payments']['city'],
                'method' => $order['order_payments']['method'],
                'code' => $order['order_payments']['code'],
            ]);
            foreach ($order['order_products'] as $product) {
                DB::table('order_products')->insert([
                    'order_id' => $order['order_id'],
                    'product_id' => $product['product_id'],
                    'unit_class_id' => $product['unit_class_id'],
                    'discount_card_id' => $product['discount_card_id'],
                    'currency_id' => $product['currency_id'],
                    'name' => $product['name'],
                    'amount' => $product['amount'],
                    'discount' => $product['discount'],
                    'price' => $product['price'],
                    'total' => $product['total'],
                    'deleted' => $product['deleted'],
                ]);
            }
            foreach ($order['order_totals'] as $total) {
                DB::table('order_totals')->insert([
                    'order_id' => $order['order_id'],
                    'code' => $total['code'],
                    'title' => $total['title'],
                    'value' => $total['value'],
                ]);
            }
        }

    }
}
