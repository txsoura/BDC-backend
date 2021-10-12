<?php

namespace Database\Factories;

use App\Enums\ConstructionUserRole;
use App\Models\Construction;
use App\Models\ConstructionUser;
use App\Models\User;
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
            'user_id' => User::factory(),
            'construction_id' => Construction::factory(),
        ];
    }
}
