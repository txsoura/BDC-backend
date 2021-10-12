<?php

namespace Database\Factories;

use App\Enums\ProductType;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'type' => new ProductType($this->faker->randomElement(ProductType::toArray())),
            'notify_when_stock_below' => $this->faker->randomNumber(2),
            'available' => $this->faker->randomFloat(2, 0, 100),
        ];
    }
}
