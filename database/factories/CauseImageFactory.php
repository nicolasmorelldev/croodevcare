<?php

namespace Database\Factories;

use App\Models\Cause;
use App\Models\CauseImage;
use Illuminate\Database\Eloquent\Factories\Factory;

class CauseImageFactory extends Factory
{
    protected $model = CauseImage::class;

    public function definition(): array
    {
        return [
            'cause_id' => Cause::factory(),
            'path' => 'demo/causes/valentina-rojas/gallery-1.jpg',
            'alt' => fake()->sentence(5),
            'caption' => fake()->sentence(),
            'featured' => false,
            'sort_order' => fake()->numberBetween(1, 6),
        ];
    }
}
