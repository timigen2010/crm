<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $data = [
            [
                'product_type_id' => 1,
                'type_code' => 'self_prod'
            ],
            [
                'product_type_id' => 2,
                'type_code' => 'prod'
            ],
            [
                'product_type_id' => 3,
                'type_code' => 'complect'
            ],
            [
                'product_type_id' => 4,
                'type_code' => 'material'
            ]
        ];
        foreach($data as $item) {
            DB::table('product_types')->insert([
                'product_type_id' => $item['product_type_id'],
                'type_code' => $item['type_code']
            ]);
        }

        $data = [
            [
                'product_id' => 1,
                'product_type_id' => 1,
                'name' => 'test',
                'status' => true,
                'cost_price' => 100.10,
                'price' => 110.10,
                'currency_id' => 2,
                'unit_class_id' => 1,
                'weight_class_id' => 1,
                'minimum' => 1,
                'weight' => 1,
                'sale_able' => true,
                'cooking_time' => 50,
                'deleted' => false,
                'main_category_id' => 1,
                'created_at' => (new \DateTime())->format('Y-m-d h:i:s'),
                'updated_at' => (new \DateTime())->format('Y-m-d h:i:s'),
                'date_available' => (new \DateTime('+5 days'))->format('Y-m-d h:i:s'),
                'descriptions' => [
                    [
                        'product_description_id' => 1,
                        'language_id' => 1,
                        'company_id' => 1,
                        'description' => 'description',
                        'seo_description' => 'seo_description',
                        'meta_title' => 'meta_title',
                        'meta_description' => 'metaDescription',
                        'meta_keywords' => 'metaKeywords',
                    ]
                ],
                'menus' => [1, 2]
            ],
            [
                'product_id' => 2,
                'product_type_id' => 2,
                'name' => 'delete',
                'status' => true,
                'cost_price' => 100.10,
                'price' => 110.10,
                'currency_id' => 2,
                'unit_class_id' => 1,
                'weight_class_id' => 1,
                'minimum' => 1,
                'weight' => 1,
                'sale_able' => true,
                'cooking_time' => 50,
                'deleted' => false,
                'main_category_id' => 1,
                'created_at' => (new \DateTime())->format('Y-m-d h:i:s'),
                'updated_at' => (new \DateTime())->format('Y-m-d h:i:s'),
                'date_available' => (new \DateTime('+5 days'))->format('Y-m-d h:i:s'),
                'descriptions' => [
                    [
                        'product_description_id' => 2,
                        'language_id' => 1,
                        'company_id' => 1,
                        'description' => 'description',
                        'seo_description' => 'seo_description',
                        'meta_title' => 'meta_title',
                        'meta_description' => 'metaDescription',
                        'meta_keywords' => 'metaKeywords',
                    ]
                ],
                'menus' => [1, 2]
            ]
        ];
        foreach($data as $item) {
            DB::table('products')->insert([
                'product_id' => $item['product_id'],
                'product_type_id' => $item['product_type_id'],
                'name' => $item['name'],
                'status' => $item['status'],
                'cost_price' => $item['cost_price'],
                'price' => $item['price'],
                'currency_id' => $item['currency_id'],
                'unit_class_id' => $item['unit_class_id'],
                'weight_class_id' => $item['weight_class_id'],
                'minimum' => $item['minimum'],
                'weight' => $item['weight'],
                'sale_able' => $item['sale_able'],
                'cooking_time' => $item['cooking_time'],
                'deleted' => $item['deleted'],
                'main_category_id' => $item['main_category_id'],
                'created_at' => $item['created_at'],
                'updated_at' => $item['updated_at'],
                'date_available' => $item['date_available'],
            ]);
            if (!empty($item["descriptions"]) && is_array($item["descriptions"])) {
                foreach ($item["descriptions"] as $description) {
                    DB::table('product_descriptions')->insert([
                        'product_id' => $item['product_id'],
                        'product_description_id' => $description['product_description_id'],
                        'language_id' => $description['language_id'],
                        'company_id' => $description['company_id'],
                        'description' => $description['description'],
                        'seo_description' => $description['seo_description'],
                        'meta_title' => $description['meta_title'],
                        'meta_description' => $description['meta_description'],
                        'meta_keywords' => $description['meta_keywords'],
                    ]);
                }
            }
            if (!empty($item["menus"])) {
                foreach ($item["menus"] as $menuId) {
                    DB::table('products_to_menus')->insert([
                        'product_id' => $item['product_id'],
                        'menu_id' => $menuId,
                    ]);
                }
            }
        }
    }
}
