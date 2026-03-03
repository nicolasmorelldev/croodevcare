<?php

namespace App\Services\Donations;

use App\Enums\DonationStatus;
use App\Models\Cause;
use App\Models\Donation;
use App\Models\DonationMethod;
use App\Services\Payments\PaymentManager;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class DonationService
{
    public function __construct(
        protected PaymentManager $paymentManager,
    ) {
    }

    public function createAndProcess(Cause $cause, array $validated): Donation
    {
        return DB::transaction(function () use ($cause, $validated): Donation {
            $gateway = Arr::get($validated, 'gateway', config('payments.default'));
            $donationMethod = isset($validated['donation_method_id'])
                ? DonationMethod::query()->findOrFail($validated['donation_method_id'])
                : DonationMethod::query()->where('type', $gateway)->firstOrFail();

            $donation = Donation::query()->create([
                'cause_id' => $cause->id,
                'donation_method_id' => $donationMethod?->id,
                'gateway_type' => $gateway,
                'donor_name' => $validated['donor_name'],
                'donor_email' => $validated['donor_email'],
                'donor_phone' => $validated['donor_phone'] ?? null,
                'amount' => (int) $validated['amount'],
                'message' => $validated['message'] ?? null,
                'currency' => config('croodev.site.currency', 'ARS'),
                'status' => DonationStatus::Pending,
            ]);

            $paymentResult = $this->paymentManager
                ->driver($donationMethod)
                ->process($donation, $donationMethod, [
                    'cause_slug' => $cause->slug,
                    'donor_email' => $donation->donor_email,
                ]);

            $donation->forceFill([
                'status' => $paymentResult->status,
                'provider_reference' => $paymentResult->reference,
                'transaction_reference' => $paymentResult->transactionReference,
                'payload' => $paymentResult->payload,
                'completed_at' => $paymentResult->status === DonationStatus::Approved ? now() : null,
            ])->save();

            if ($paymentResult->status === DonationStatus::Approved) {
                $cause->increment('raised_amount', $donation->amount);
            }

            return $donation->refresh();
        });
    }
}
