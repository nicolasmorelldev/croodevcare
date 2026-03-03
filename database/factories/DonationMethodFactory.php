<?php

namespace Database\Factories;

use App\Enums\DonationMethodType;
use App\Models\DonationMethod;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonationMethodFactory extends Factory
{
    protected $model = DonationMethod::class;

    public function definition(): array
    {
        return [
            'type' => fake()->randomElement(DonationMethodType::cases()),
            'title' => fake()->words(2, true),
            'description' => fake()->sentence(),
            'enabled' => true,
            'is_primary' => false,
            'sort_order' => fake()->numberBetween(1, 4),
            'configuration' => null,
        ];
    }
}
