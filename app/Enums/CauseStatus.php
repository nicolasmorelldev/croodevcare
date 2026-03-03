<?php

namespace App\Enums;

enum CauseStatus: string
{
    case Draft = 'draft';
    case Active = 'active';
    case Completed = 'completed';
    case Archived = 'archived';

    public function label(): string
    {
        return match ($this) {
            self::Draft => 'Borrador',
            self::Active => 'Activa',
            self::Completed => 'Completada',
            self::Archived => 'Archivada',
        };
    }
}
