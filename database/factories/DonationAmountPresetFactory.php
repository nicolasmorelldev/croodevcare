<?php

namespace Database\Factories;

use App\Models\Cause;
use App\Models\DonationAmountPreset;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonationAmountPresetFactory extends Factory
{
    protected $model = DonationAmountPreset::class;

    public function definition(): array
    {
        $amount = fake()->randomElement([2000, 5000, 10000, 20000]);

        return [
            'cause_id' => Cause::factory(),
            'amount' => $amount,
            'label' => '$'.number_format($amount, 0, ',', '.'),
            'impact_copy' => fake()->sentence(),
            'is_active' => true,
            'sort_order' => fake()->numberBetween(1, 4),
        ];
    }
}
