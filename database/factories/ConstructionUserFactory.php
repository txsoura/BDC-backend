<?php

namespace Database\Factories;

use App\Enums\ConstructionUserRole;
use App\Models\CompanyUser;
use App\Models\Construction;
use App\Models\ConstructionUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConstructionUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ConstructionUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'role' => new ConstructionUserRole($this->faker->randomElement(ConstructionUserRole::toArray())),
            'construction_id' => Construction::factory(),
            'company_user_id' => CompanyUser::factory(),
        ];
    }
}
