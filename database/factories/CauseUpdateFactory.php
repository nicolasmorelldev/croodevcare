<?php

namespace Database\Factories;

use App\Enums\CauseUpdateType;
use App\Models\Cause;
use App\Models\CauseUpdate;
use Illuminate\Database\Eloquent\Factories\Factory;

class CauseUpdateFactory extends Factory
{
    protected $model = CauseUpdate::class;

    public function definition(): array
    {
        return [
            'cause_id' => Cause::factory(),
            'title' => fake()->sentence(),
            'type' => fake()->randomElement(CauseUpdateType::cases()),
            'excerpt' => fake()->sentence(),
            'content' => fake()->paragraphs(2, true),
            'image_path' => 'demo/causes/sleider-calderon/update-1.jpg',
            'published_at' => fake()->dateTimeBetween('-1 month'),
        ];
    }
}
