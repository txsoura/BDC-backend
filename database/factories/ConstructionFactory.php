<?php

namespace Database\Factories;

use App\Enums\ConstructionStatus;
use App\Models\Construction;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConstructionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Construction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $status = new ConstructionStatus($this->faker->randomElement(ConstructionStatus::toArray()));

        return [
            'name' => $this->faker->name(),
            'start_date' => now(),
            'end_date' => now(),
            'status' => $status,
            'budget' => $this->faker->randomFloat(2, 0, 100),
            'project' => $this->faker->imageUrl(),
            'canceled_at' => $status == ConstructionStatus::CANCELED ? now() : null,
            'started_at' => $status == ConstructionStatus::STARTED ? now() : null,
            'finalized_at' => $status == ConstructionStatus::FINALIZED ? now() : null,
            'abandoned_at' => $status == ConstructionStatus::ABANDONED ? now() : null,
        ];
    }
}
