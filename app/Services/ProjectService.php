<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Support\Facades\DB;

class ProjectService
{
    public function saveProject(Project $project, array $data): Project
    {
        return DB::transaction(function () use ($project, $data) {
            $project->fill($data)->save();

            if (isset($data['users'])) {
                $project->users()->sync($this->formatPivotData($data['users']));
            }

            return $project;
        });
    }

    public function deleteProject(Project $project)
    {
        return DB::transaction(function () use ($project) {
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
