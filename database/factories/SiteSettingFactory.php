<?php

namespace Database\Factories;

use App\Enums\SettingType;
use App\Models\SiteSetting;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SiteSettingFactory extends Factory
{
    protected $model = SiteSetting::class;

    public function definition(): array
    {
        $label = fake()->words(2, true);

        return [
            'group' => fake()->randomElement(['site', 'contact', 'social']),
            'key' => Str::slug($label, '_'),
            'label' => Str::title($label),
            'type' => SettingType::Text,
            'value' => fake()->sentence(),
            'sort_order' => fake()->numberBetween(1, 12),
        ];
    }
}
