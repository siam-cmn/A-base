<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserService
{
    public function saveUser(User $user, array $data): Project
    {
        return DB::transaction(function () use ($user, $data) {
            $user->fill($data)->save();

            if (isset($data['users'])) {
                $user->users()->sync($this->formatPivotData($data['users']));
            }

            return $user;
        });
    }

    public function deleteUser(User $user)
    {
        return DB::transaction(function () use ($user) {
            $project->users()->detach();
            $project->delete();
        });
    }

    private function formatPivotData(array $users): array
    {
        return collect($users)->keyBy('id')->map(function ($user) {
            return [
                'assigned_status' => $user['assigned_status'],
                'assigned_role' => $user['assigned_role'],
                'allocation_percent' => $user['allocation_percent'],
                'joined_at' => $user['joined_at'],
            ];
        })->toArray();
    }
}
