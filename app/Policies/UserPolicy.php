<?php

namespace App\Policies;

use App\Enums\Authority;
use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function create(User $user): bool
    {
        // オーナーまたは管理者のみ作成可能
        return in_array($user->authority, [
            Authority::OWNER,
            Authority::ADMIN,
        ]);
    }
}
