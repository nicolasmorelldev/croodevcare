<?php

namespace App\Enums;

enum NeedCategory: string
{
    case MedicalStudies = 'medical_studies';
    case Medications = 'medications';
    case Transport = 'transport';
    case Food = 'food';
    case Rent = 'rent';
    case HomeAdaptation = 'home_adaptation';
    case Other = 'other';

    public function label(): string
    {
        return match ($this) {
            self::MedicalStudies => 'Estudios médicos',
            self::Medications => 'Medicamentos',
            self::Transport => 'Traslados',
            self::Food => 'Alimentos',
            self::Rent => 'Alquiler',
            self::HomeAdaptation => 'Adaptación del hogar',
            self::Other => 'Otros',
        };
    }
}
