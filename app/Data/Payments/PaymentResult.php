<?php

namespace App\Data\Payments;

use App\Enums\DonationStatus;

readonly class PaymentResult
{
    public function __construct(
        public DonationStatus $status,
        public ?string $reference = null,
        public ?string $transactionReference = null,
        public ?string $message = null,
        public array $payload = [],
    ) {
    }
}
