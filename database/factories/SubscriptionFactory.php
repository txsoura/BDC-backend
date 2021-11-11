<?php

namespace Database\Factories;

use App\Enums\Currency;
use App\Enums\SubscriptionBillingMethod;
use App\Enums\SubscriptionStatus;
use App\Models\Company;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subscription::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name(),
            'status' => new SubscriptionStatus($this->faker->randomElement(SubscriptionStatus::toArray())),
            'billing_method' => new SubscriptionBillingMethod($this->faker->randomElement(SubscriptionBillingMethod::toArray())),
            'valid_until' => now(),
            'amount' => $this->faker->randomFloat(2, 0, 100),
            'company_id' => Company::factory(),
            'currency' => new Currency($this->faker->randomElement(Currency::toArray())),
        ];
    }
}
