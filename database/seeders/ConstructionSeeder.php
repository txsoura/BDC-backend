<?php

namespace Database\Seeders;

use App\Models\Construction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class ConstructionSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment('local')) {
            Construction::factory(1)->create();
        }
    }
}
