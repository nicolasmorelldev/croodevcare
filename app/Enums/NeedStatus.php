<?php

namespace App\Enums;

enum NeedStatus: string
{
    case Pending = 'pending';
    case PartiallyCovered = 'partially_covered';
    case Completed = 'completed';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Pendiente',
            self::PartiallyCovered => 'Cubierto parcialmente',
            self::Completed => 'Completado',
        };
    }
}
