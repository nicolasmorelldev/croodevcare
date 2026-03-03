<?php

namespace Database\Factories;

use App\Models\Cause;
use App\Models\Faq;
use Illuminate\Database\Eloquent\Factories\Factory;

class FaqFactory extends Factory
{
    protected $model = Faq::class;

    public function definition(): array
    {
        return [
            'cause_id' => Cause::factory(),
            'question' => fake()->sentence().'?',
            'answer' => fake()->paragraph(),
            'is_active' => true,
            'sort_order' => fake()->numberBetween(1, 6),
        ];
    }
}
