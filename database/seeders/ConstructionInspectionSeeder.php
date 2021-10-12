<?php

namespace Database\Seeders;

use App\Models\ConstructionInspection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class ConstructionInspectionSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment('local')) {
            ConstructionInspection::factory(1)->create();
        }
    }
}
