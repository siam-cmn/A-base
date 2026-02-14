<?php

namespace App\Enums;

enum Authority: int
{
    case OWNER = 1;
    case ADMIN = 2;
    case MEMBER = 3;

    // 日本語表示用ラベルが必要なら追加
    public function label(): string
    {
        return match ($this) {
            self::OWNER => 'オーナー',
            self::ADMIN => '管理者',
            self::MEMBER => '一般',
        };
    }
}
