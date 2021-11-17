<?php

namespace Database\Factories;

use App\Enums\CompanyUserRole;
use App\Models\Company;
use App\Models\CompanyUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CompanyUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'role' => new CompanyUserRole($this->faker->randomElement(CompanyUserRole::toArray())),
            'user_id' => User::factory(),
            'company_id' => Company::factory(),
        ];
    }
}
