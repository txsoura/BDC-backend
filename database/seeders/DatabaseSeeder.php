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
            ConstructionSeeder::class,
            ConstructionUserSeeder::class,
            ConstructionStageSeeder::class,
            ConstructionInspectionSeeder::class,
            ProviderSeeder::class,
            ProductSeeder::class,
            StockSeeder::class,
        ]);
    }
}
