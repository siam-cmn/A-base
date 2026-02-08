<?php

namespace App\Models;

use App\Enums\UserRole;
use App\Enums\UserStatus;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProjectUser extends Pivot
{
    protected $table = 'project_user';

    protected $casts = [
        'assigned_status' => UserStatus::class,
        'assigned_role' => UserRole::class,
        'joined_at' => 'date',
        'leave_at' => 'date',
        'allocation_percent' => 'integer',
    ];

    /**
     * @var bool
     */
    public $incrementing = true;
}
