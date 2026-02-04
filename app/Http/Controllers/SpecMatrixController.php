<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\SpecApi;
use App\Models\SpecRole;
use Inertia\Inertia;

class SpecMatrixController extends Controller
{
    public function showMatrixPage(Project $project)
    {
        return Inertia::render('Matrix', [
            'project' => $project,
        ]);
    }

    public function getPermissionMatrix(Project $project)
    {
        $apis = SpecApi::where('project_id', $project->id)->get();

        $role = SpecRole::where('project_id', $project->id)->with('allowedApis')->get();

        return response()->json([
            'project' => $project,
            'apis' => $apis,
            'role' => $role,
        ]);

    }
}
