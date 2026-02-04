<?php

namespace App\Enums;

enum UserRole: int
{
    case PM = 1;
    case PL = 2;
    case FRONTEND = 3;
    case BACKEND = 4;
    case FULLSTACK = 5;
    case INFRASTRUCTURE = 6;
    case DESIGNER = 7;
    case QA = 8;

    public function label(): string
    {
        return match ($this) {
            self::PM => 'プロジェクトマネージャー',
            self::PL => 'プロジェクトリーダー',
            self::FRONTEND => 'フロントエンドエンジニア',
            self::BACKEND => 'バックエンドエンジニア',
            self::FULLSTACK => 'フルスタックエンジニア',
            self::INFRASTRUCTURE => 'インフラ',
            self::DESIGNER => 'デザイナー',
            self::QA => 'テスター'
        };
    }
}
