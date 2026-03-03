<?php

namespace App\Enums;

enum InquiryStatus: string
{
    case New = 'new';
    case Reviewed = 'reviewed';
    case Archived = 'archived';

    public function label(): string
    {
        return match ($this) {
            self::New => 'Nuevo',
            self::Reviewed => 'Revisado',
            self::Archived => 'Archivado',
        };
    }
}
