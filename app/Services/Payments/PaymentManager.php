<?php

namespace App\Services\Payments;

use App\Contracts\Payments\PaymentGatewayInterface;
use App\Models\DonationMethod;
use InvalidArgumentException;

class PaymentManager
{
    /**
     * @var array<int, class-string<PaymentGatewayInterface>>
     */
    protected array $gateways;

    /**
     * @param  array<int, class-string<PaymentGatewayInterface>>|null  $gateways
     */
    public function __construct(?array $gateways = null)
    {
        $this->gateways = $gateways ?? [
            FakePaymentGateway::class,
            ManualReviewPaymentGateway::class,
        ];
    }

    public function driver(DonationMethod $method): PaymentGatewayInterface
    {
        foreach ($this->gateways as $gateway) {
            $instance = app($gateway);

            if ($instance->supports($method->type)) {
                return $instance;
            }
        }

        throw new InvalidArgumentException("Payment gateway [{$method->type->value}] is not configured.");
    }
}
