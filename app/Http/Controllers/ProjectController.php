<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $projects = Project::with('users')->get();

        return ProjectResource::collection($projects);
    }

    public function show(Project $project): ProjectResource
    {
        return new ProjectResource($project->load('users'));
    }

    public function store(StoreProjectRequest $request): ProjectResource
    {
        $validated = $request->validated();
        // ログイン機能作成したら追加
        // $organizationId = auth()->user()->organization_id;

        return DB::transaction(function () use ($validated) {
            $project = Project::create([
                'organization_id' => $validated['organization_id'],
                'name' => $validated['name'],
                'description' => $validated['description'] ?? null,
                'status' => $validated['status'],
            ]);

            $usersData = [];
            if (! empty($validated['users'])) {
                foreach ($validated['users'] as $userData) {
                    $usersData[$userData['id']] = [
                        'assigned_status' => $userData['assigned_status'],
                        'assigned_role' => $userData['assigned_role'],
                        'allocation_percent' => $userData['allocation_percent'],
                        'joined_at' => $userData['joined_at'],
                    ];
                }
            }

            $project->users()->sync($usersData);

            return new ProjectResource($project->load('users'));
        });
    }
}
