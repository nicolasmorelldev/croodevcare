<?php

namespace App\Support;

class Money
{
    public static function ars(int|float $amount): string
    {
        return '$'.number_format((float) $amount, 0, ',', '.');
    }
}
