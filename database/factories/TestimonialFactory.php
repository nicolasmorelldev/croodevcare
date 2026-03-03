<?php

namespace Database\Factories;

use App\Models\Cause;
use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestimonialFactory extends Factory
{
    protected $model = Testimonial::class;

    public function definition(): array
    {
        return [
            'cause_id' => Cause::factory(),
            'author' => fake()->name(),
            'role' => fake()->jobTitle(),
            'message' => fake()->paragraph(),
            'is_featured' => true,
            'sort_order' => fake()->numberBetween(1, 4),
        ];
    }
}
