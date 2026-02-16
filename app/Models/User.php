<?php

namespace App\Models;

use App\Enums\Authority;
use App\Enums\UserRole;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name', 'last_name', 'first_name_kana', 'last_name_kana',
        'email',
        'role',
        'authority',
        'avatar_url',
        'password',
        'organization_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class,
            'authority' => Authority::class,
        ];
    }

    public function Organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class)
            ->withPivot(['assigned_status', 'assigned_role', 'allocation_percent', 'joined_at', 'leave_at'])
            ->using(ProjectUser::class)
            ->withTimestamps();
    }

    public function getNameAttribute()
    {
        return "{$this->last_name} {$this->first_name}";
    }

    public function getNameKanaAttribute()
    {
        return "{$this->last_name} {$this->first_name}";
    }
}
