<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

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

    public function store(StoreProjectRequest $request, ProjectService $service): ProjectResource
    {
        $data = array_merge($request->validated(), [
            // ログイン機能作成したら差し替え
            // $organizationId = auth()->user()->organization_id;
            'organization_id' => 1, // 仮
        ]);

        $project = $service->saveProject(new Project, $data);

        return new ProjectResource($project->load('users'));
    }

    public function update(UpdateProjectRequest $request, Project $project, ProjectService $service): ProjectResource
    {
        $data = $request->validated();

        $project = $service->saveProject($project, $data);

        return new ProjectResource($project->load('users'));
    }
}
