<?php

namespace Database\Factories;

use App\Models\ContentBlock;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ContentBlockFactory extends Factory
{
    protected $model = ContentBlock::class;

    public function definition(): array
    {
        $title = fake()->sentence(3);

        return [
            'page' => 'home',
            'key' => Str::slug($title, '_'),
            'title' => $title,
            'summary' => fake()->sentence(),
            'content' => fake()->paragraph(),
            'sort_order' => fake()->numberBetween(1, 6),
        ];
    }
}
