<?php

namespace Database\Factories;

use App\Models\Construction;
use App\Models\Stage;
use Illuminate\Database\Eloquent\Factories\Factory;

class StageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Stage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'construction_id' => Construction::factory(),
            'budget' => $this->faker->randomFloat(2, 0, 100),
        ];
    }
}
