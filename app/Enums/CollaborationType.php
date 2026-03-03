<?php

namespace App\Enums;

enum CollaborationType: string
{
    case Sponsor = 'sponsor';
    case Volunteer = 'volunteer';
    case Logistics = 'logistics';
    case Media = 'media';
    case DirectAssistance = 'direct_assistance';
    case Other = 'other';

    public function label(): string
    {
        return match ($this) {
            self::Sponsor => 'Alianza',
            self::Volunteer => 'Voluntariado',
            self::Logistics => 'Ayuda logística',
            self::Media => 'Difusión',
            self::DirectAssistance => 'Ayuda directa',
            self::Other => 'Otro',
        };
    }
}
