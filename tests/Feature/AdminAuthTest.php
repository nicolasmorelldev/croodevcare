<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\DemoContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_log_in_and_reach_dashboard(): void
    {
        $this->seed(DemoContentSeeder::class);

        $response = $this->post(route('admin.login.store'), [
            'email' => 'admin@sleidercalderon.test',
            'password' => 'SleiderDemo!2026',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs(User::query()->where('email', 'admin@sleidercalderon.test')->first());
    }
}
