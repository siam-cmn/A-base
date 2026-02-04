<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SpecApi extends Model
{
    /**
     * @return BelongsToMany
     */
    public function SpecScenario(): BelongsToMany
    {
        return $this->belongsToMany(SpecScenario::class)
            ->withPivot(['is_executable', 'condition_note'])
            ->withTimestamps();
    }
}
