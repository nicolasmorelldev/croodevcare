<?php

namespace App\Services\Payments;

use App\Contracts\Payments\PaymentGatewayInterface;
use App\Data\Payments\PaymentResult;
use App\Enums\DonationMethodType;
use App\Enums\DonationStatus;
use App\Models\Donation;
use App\Models\DonationMethod;
use Illuminate\Support\Str;

class FakePaymentGateway implements PaymentGatewayInterface
{
    public function supports(DonationMethodType $methodType): bool
    {
        return $methodType === DonationMethodType::FakeGateway;
    }

    public function process(Donation $donation, DonationMethod $method, array $payload = []): PaymentResult
    {
        $approved = (bool) config('payments.fake_auto_approve', true);

        return new PaymentResult(
            status: $approved ? DonationStatus::Approved : DonationStatus::Pending,
            reference: 'fake_'.Str::lower(Str::random(12)),
            transactionReference: 'txn_'.Str::lower(Str::random(18)),
            message: $approved
                ? 'Aporte demo aprobado correctamente.'
                : 'Aporte demo registrado como pendiente.',
            payload: [
                'gateway' => $method->type->value,
                'submitted_at' => now()->toIso8601String(),
                'mode' => 'demo',
                ...$payload,
            ],
        );
    }
}
