<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
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
                'category_id' => 1,
                'category_badge_id' => 1,
                'parent_id' => null,
                'status' => 1,
                'descriptions' => [
                    [
                        'category_description_id' => 1,
                        'description' => 'description',
                        'name' => 'name',
                        'language_id' => 1,
                        'company_id' => 1,
                        'h1_title' => 'h1Title',
                        'meta_title' => 'metaTitle',
                        'short_description' => 'shortDescription',
                        'meta_description' => 'metaDescription',
                        'meta_keywords' => 'metaKeywords',
                    ]
                ],
                'images' => [
                    [
                        'category_image_id' => 1,
                        'image' => 'test',
                        'image_type' => 1,
                    ]
                ],
                'menus' => [1,2]
            ],
            [
                'category_id' => 2,
                'category_badge_id' => 1,
                'parent_id' => 1,
                'status' => 1,
                'descriptions' => [
                    [
                        'category_description_id' => 2,
                        'description' => 'description',
                        'name' => 'name',
                        'language_id' => 1,
                        'company_id' => 1,
                        'h1_title' => 'h1Title',
                        'meta_title' => 'metaTitle',
                        'short_description' => 'shortDescription',
                        'meta_description' => 'metaDescription',
                        'meta_keywords' => 'metaKeywords',
                    ]
                ],
            ]
        ];
        foreach($data as $item) {
            DB::table('categories')->insert([
                'category_id' => $item['category_id'],
                'category_badge_id' => $item['category_badge_id'],
                'parent_id' => $item['parent_id'],
                'status' => $item['status'],
            ]);
            if (!empty($item["descriptions"]) && is_array($item["descriptions"])) {
                foreach ($item["descriptions"] as $description) {
                    DB::table('category_descriptions')->insert([
                        'category_id' => $item['category_id'],
                        'category_description_id' => $description['category_description_id'],
                        'description' => $description['description'],
                        'name' => $description['name'],
                        'language_id' => $description['language_id'],
                        'company_id' => $description['company_id'],
                        'h1_title' => $description['h1_title'],
                        'meta_title' => $description['meta_title'],
                        'short_description' => $description['short_description'],
                        'meta_description' => $description['meta_description'],
                        'meta_keywords' => $description['meta_keywords'],
                    ]);
                }
            }
            if (!empty($item["images"]) && is_array($item["images"])) {
                foreach ($item["images"] as $image) {
                    DB::table('category_images')->insert([
                        'category_id' => $item['category_id'],
                        'category_image_id' => $image['category_image_id'],
                        'image' => $image['image'],
                        'image_type' => $image['image_type'],
                    ]);
                }
            }
            if (!empty($item["menus"]) && is_array($item["menus"])) {
                foreach ($item["menus"] as $menuId) {
                    DB::table('categories_to_menus')->insert([
                        'category_id' => $item['category_id'],
                        'menu_id' => $menuId
                    ]);
                }
            }
        }
    }
}
