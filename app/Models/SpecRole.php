<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SpecRole extends Model
{
    public function allowedApis(): BelongsToMany
    {
        return $this->belongsToMany(SpecApi::class, 'spec_permissions')
            ->withPivot('is_allowed')
            ->withTimestamps();
    }
}
