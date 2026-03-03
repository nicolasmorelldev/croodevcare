<?php

namespace Database\Factories;

use App\Enums\CauseStatus;
use App\Models\Cause;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CauseFactory extends Factory
{
    protected $model = Cause::class;

    public function definition(): array
    {
        $title = fake()->sentence(3);

        return [
            'title' => $title,
            'slug' => Str::slug($title).'-'.fake()->unique()->numberBetween(10, 999),
            'beneficiary_name' => fake()->name(),
            'beneficiary_summary' => fake()->sentence(),
            'status' => CauseStatus::Active,
            'location' => fake()->city().', Argentina',
            'goal_amount' => fake()->numberBetween(1000000, 9000000),
            'raised_amount' => fake()->numberBetween(100000, 700000),
            'featured' => false,
            'hero_badge' => 'Causa activa',
            'hero_heading' => fake()->sentence(5),
            'hero_excerpt' => fake()->paragraph(),
            'short_story' => fake()->paragraph(),
            'full_story' => fake()->paragraphs(3, true),
            'impact_statement' => fake()->sentence(),
            'primary_cta_label' => 'Ayudar ahora',
            'secondary_cta_label' => 'Conocer la historia',
            'manager_name' => 'Equipo Croodev Care',
            'manager_role' => 'Administración de campaña',
            'manager_contact_email' => fake()->safeEmail(),
            'manager_contact_phone' => fake()->phoneNumber(),
            'donation_disclaimer' => fake()->sentence(),
            'hero_image_path' => 'demo/placeholders/cause-hero.svg',
            'hero_image_alt' => fake()->sentence(4),
            'published_at' => now(),
            'last_update_at' => now(),
        ];
    }
}
