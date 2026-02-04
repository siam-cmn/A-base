<?php

namespace App\Enums;

enum ProjectStatus: int
{
    case DEFINING = 1;
    case DEVELOPING = 2;
    case OPERATING = 3;
    case ARCHIVED = 4;

    public function label(): string
    {
        return match ($this) {
            self::DEFINING => '要件定義',
            self::DEVELOPING => '開発中',
            self::OPERATING => '運用中',
            self::ARCHIVED => '終了'
        };
    }


}
