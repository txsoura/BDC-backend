<?php

namespace Database\Factories;

use App\Enums\CompanyStatus;
use App\Enums\CompanyType;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'tax' => $this->faker->randomDigitNotNull(),
            'type' => new CompanyType($this->faker->randomElement(CompanyType::toArray())),
            'workspace' => $this->faker->unique()->userName(),
            'cellphone' => $this->faker->unique()->e164PhoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'street' => $this->faker->streetName,
            'postcode' => $this->faker->buildingNumber,
            'number' => $this->faker->buildingNumber,
            'complement' => $this->faker->secondaryAddress,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'country' => $this->faker->country,
            'district' => $this->faker->cityPrefix,
            'status' => new CompanyStatus($this->faker->randomElement(CompanyStatus::toArray())),
        ];
    }
}
