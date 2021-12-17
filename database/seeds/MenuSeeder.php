<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
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
                'menu_id' => 1,
                'name' => 'test',
                'companies' => [1],
            ],
            [
                'menu_id' => 2,
                'name' => 'delete',
                'companies' => [1],
            ]
        ];
        foreach($data as $item) {
            DB::table('menus')->insert([
                'menu_id' => $item['menu_id'],
                'name' => $item['name'],
            ]);
            if (!empty($item["companies"]) && is_array($item["companies"])) {
                foreach ($item["companies"] as $company) {
                    DB::table('menus_to_companies')->insert([
                        'menu_id' => $item['menu_id'],
                        'company_id' => $company,
                    ]);
                }
            }
        }
    }
}
