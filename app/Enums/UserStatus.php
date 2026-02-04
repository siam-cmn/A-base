<?php

namespace App\Enums;

enum UserStatus: int
{
    case ACTIVE = 1;
    case RELEASED = 2;
    case CANDIDATE = 3;

    public function label(): string
    {
        return match ($this) {
            self::ACTIVE => '参画中',
            self::RELEASED => '離任済',
            self::CANDIDATE => '参画予定',
        };
    }
}
