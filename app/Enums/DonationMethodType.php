<?php

namespace App\Enums;

enum DonationMethodType: string
{
    case FakeGateway = 'fake_gateway';
    case BankTransfer = 'bank_transfer';
    case Contact = 'contact';
    case Stripe = 'stripe';
    case MercadoPago = 'mercado_pago';

    public function label(): string
    {
        return match ($this) {
            self::FakeGateway => 'Pago demo',
            self::BankTransfer => 'Transferencia / Alias',
            self::Contact => 'Contacto / alianza',
            self::Stripe => 'Stripe',
            self::MercadoPago => 'Mercado Pago',
        };
    }
}
