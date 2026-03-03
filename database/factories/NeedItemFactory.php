<?php

namespace Database\Factories;

use App\Enums\NeedCategory;
use App\Enums\NeedStatus;
use App\Models\Cause;
use App\Models\NeedItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class NeedItemFactory extends Factory
{
    protected $model = NeedItem::class;

    public function definition(): array
    {
        $estimated = fake()->numberBetween(200000, 3000000);

        return [
            'cause_id' => Cause::factory(),
            'category' => fake()->randomElement(NeedCategory::cases()),
            'title' => fake()->sentence(3),
            'description' => fake()->sentence(),
            'estimated_amount' => $estimated,
            'covered_amount' => fake()->numberBetween(0, $estimated),
            'status' => fake()->randomElement(NeedStatus::cases()),
            'urgent' => fake()->boolean(),
            'sort_order' => fake()->numberBetween(1, 6),
        ];
    }
}
