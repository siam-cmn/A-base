<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SpecScenario extends Model
{
    /**
     * @return BelongsToMany
     */
    public function apis(): BelongsToMany
    {
        return $this->belongsToMany(SpecApi::class, 'spec_status_controls')
            ->withPivot(['is_executable', 'condition_note'])
            ->withTimestamps();
    }
}
