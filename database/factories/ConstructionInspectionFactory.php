<?php

namespace Database\Factories;

use App\Models\Construction;
use App\Models\ConstructionInspection;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConstructionInspectionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ConstructionInspection::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'construction_id' => Construction::factory(),
            'seem' => $this->faker->text,
            'report' => $this->faker->imageUrl(),
        ];
    }
}
