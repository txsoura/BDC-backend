<?php

namespace Database\Factories;

use App\Enums\StockFlow;
use App\Enums\StockStatus;
use App\Models\Construction;
use App\Models\Product;
use App\Models\Provider;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Stock::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $status = new StockStatus($this->faker->randomElement(StockStatus::toArray()));

        return [
            'quantity' => $this->faker->randomFloat(2, 0, 100),
            'price' => $this->faker->randomFloat(2, 0, 100),
            'construction_id' => Construction::factory(),
            'provider_id' => Provider::factory(),
            'product_id' => Product::factory(),
            'flow' => new StockFlow($this->faker->randomElement(StockFlow::toArray())),
            'status' => $status,
            'outgoing_receiver' => $this->faker->text,
            'receipt' => $this->faker->imageUrl(),
            'canceled_at' => $status == StockStatus::CANCELED ? now() : null,
            'arrived_at' => $status == StockStatus::ARRIVED ? now() : null,
        ];
    }
}