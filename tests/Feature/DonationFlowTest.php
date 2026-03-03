<?php

namespace Tests\Feature;

use App\Enums\DonationStatus;
use App\Models\Cause;
use App\Models\Donation;
use App\Models\DonationMethod;
use Database\Seeders\DemoContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DonationFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_donation_creates_an_approved_demo_record(): void
    {
        $this->seed(DemoContentSeeder::class);

        $cause = Cause::query()->firstOrFail();
        $method = DonationMethod::query()->where('is_primary', true)->firstOrFail();
        $initialRaised = $cause->raised_amount;

        $response = $this->post(route('donations.store'), [
            'cause_id' => $cause->id,
            'donation_method_id' => $method->id,
            'amount' => 5000,
            'donor_name' => 'Test Donor',
            'donor_email' => 'donor@example.com',
            'message' => 'Aporte de prueba',
        ]);

        $response->assertSessionHas('status');

        $donation = Donation::query()->where('donor_email', 'donor@example.com')->latest()->first();

        $this->assertNotNull($donation);
        $this->assertSame(DonationStatus::Approved, $donation->status);
        $this->assertSame($initialRaised + 5000, $cause->fresh()->raised_amount);
    }
}
