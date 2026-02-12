<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'last_name' => $this->last_name,
            'first_name' => $this->first_name,
            'last_name_kana' => $this->last_name_kana,
            'first_name_kana' => $this->first_name_kana,
            'assignment' => $this->whenPivotLoaded('project_user', function () {
                return [
                    'assigned_status' => [
                        'value' => $this->pivot->assigned_status->value,
                        'label' => $this->pivot->assigned_status->label(),
                    ],
                    'assigned_role' => [
                        'value' => $this->pivot->assigned_role->value,
                        'label' => $this->pivot->assigned_role->label(),
                    ],
                    'allocation_percent' => $this->pivot->allocation_percent,
                    'joined_at' => $this->pivot->joined_at->format('Y/m/d H:i'),
                ];
            }),
        ];
    }
}
