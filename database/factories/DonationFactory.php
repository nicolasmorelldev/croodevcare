<?php

namespace Database\Factories;

use App\Enums\DonationStatus;
use App\Models\Cause;
use App\Models\Donation;
use App\Models\DonationMethod;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonationFactory extends Factory
{
    protected $model = Donation::class;

    public function definition(): array
    {
        return [
            'cause_id' => Cause::factory(),
            'donation_method_id' => DonationMethod::factory(),
            'gateway_type' => 'fake_gateway',
            'donor_name' => fake()->name(),
            'donor_email' => fake()->safeEmail(),
            'donor_phone' => fake()->phoneNumber(),
            'message' => fake()->sentence(),
            'amount' => fake()->numberBetween(2000, 50000),
            'currency' => 'ARS',
            'status' => fake()->randomElement(DonationStatus::cases()),
            'provider_reference' => fake()->uuid(),
            'transaction_reference' => fake()->uuid(),
            'payload' => null,
            'completed_at' => now(),
        ];
    }
}
