<?php

namespace App\Services\Payments;

use App\Contracts\Payments\PaymentGatewayInterface;
use App\Data\Payments\PaymentResult;
use App\Enums\DonationMethodType;
use App\Enums\DonationStatus;
use App\Models\Donation;
use App\Models\DonationMethod;

class ManualReviewPaymentGateway implements PaymentGatewayInterface
{
    public function supports(DonationMethodType $methodType): bool
    {
        return in_array($methodType, [
            DonationMethodType::BankTransfer,
            DonationMethodType::Contact,
            DonationMethodType::Stripe,
            DonationMethodType::MercadoPago,
        ], true);
    }

    public function process(Donation $donation, DonationMethod $method, array $payload = []): PaymentResult
    {
        return new PaymentResult(
            status: DonationStatus::Pending,
            message: 'Aporte registrado. Este método requiere integración real o validación manual.',
            payload: [
                'gateway' => $method->type->value,
                'submitted_at' => now()->toIso8601String(),
                'mode' => 'manual_review',
                ...$payload,
            ],
        );
    }
}
