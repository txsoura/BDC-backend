<?php

namespace Database\Seeders;

use App\Models\Inspection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class InspectionSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment('local')) {
            Inspection::factory(1)->create();
        }
    }
}
