<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(LanguageSeeder::class);
         $this->call(UserPermissionSeeder::class);
         $this->call(UserGroupSeeder::class);
         $this->call(UserSeeder::class);
         $this->call(OAuthClientSeeder::class);
         $this->call(AccessTokenSeeder::class);
         $this->call(CustomerGroupSeeder::class);
         $this->call(CustomerSeeder::class);
         $this->call(CallActivitySeeder::class);
         $this->call(CompanyPhonelineSeeder::class);
         $this->call(CategoryBadgeSeeder::class);
         $this->call(CompanySeeder::class);
         $this->call(MenuSeeder::class);
         $this->call(CategorySeeder::class);
         $this->call(UnitClassSeeder::class);
         $this->call(WeightClassSeeder::class);
         $this->call(CurrencySeeder::class);
         $this->call(ProductSeeder::class);
         $this->call(DiscountCardSeeder::class);
         $this->call(OrderSeeder::class);
         $this->call(DialStatusSeeder::class);
    }
}
