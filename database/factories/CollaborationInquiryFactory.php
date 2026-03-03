<?php

namespace Database\Factories;

use App\Enums\CollaborationType;
use App\Enums\InquiryStatus;
use App\Models\Cause;
use App\Models\CollaborationInquiry;
use Illuminate\Database\Eloquent\Factories\Factory;

class CollaborationInquiryFactory extends Factory
{
    protected $model = CollaborationInquiry::class;

    public function definition(): array
    {
        return [
            'cause_id' => Cause::factory(),
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'collaboration_type' => fake()->randomElement(CollaborationType::cases()),
            'message' => fake()->paragraph(),
            'status' => InquiryStatus::New,
        ];
    }
}
