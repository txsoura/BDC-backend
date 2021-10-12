<?php

namespace Database\Seeders;

use App\Models\ConstructionUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class ConstructionUserSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment('local')) {
            ConstructionUser::factory(1)->create();
        }
    }
}
