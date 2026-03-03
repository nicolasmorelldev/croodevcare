<?php

namespace App\Enums;

enum CauseUpdateType: string
{
    case Medical = 'medical';
    case Progress = 'progress';
    case Milestone = 'milestone';
    case Logistics = 'logistics';
    case Community = 'community';

    public function label(): string
    {
        return match ($this) {
            self::Medical => 'Actualización médica',
            self::Progress => 'Avance',
            self::Milestone => 'Hito',
            self::Logistics => 'Logística',
            self::Community => 'Comunidad',
        };
    }
}
