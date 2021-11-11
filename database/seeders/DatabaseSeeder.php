<?php

namespace Database\Seeders;

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
        $this->call([
            UserSeeder::class,
            CompanySeeder::class,
            CompanyUserSeeder::class,
            SubscriptionSeeder::class,
            ConstructionSeeder::class,
            ConstructionUserSeeder::class,
            StageSeeder::class,
            InspectionSeeder::class,
            ProviderSeeder::class,
            ProductSeeder::class,
            StockSeeder::class,
        ]);
    }
}
