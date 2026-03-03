<?php

namespace App\Contracts\Payments;

use App\Data\Payments\PaymentResult;
use App\Enums\DonationMethodType;
use App\Models\Donation;
use App\Models\DonationMethod;

interface PaymentGatewayInterface
{
    public function supports(DonationMethodType $methodType): bool;

    public function process(Donation $donation, DonationMethod $method, array $payload = []): PaymentResult;
}
