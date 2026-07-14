<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Http\Resources\ProjectResource;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Http\JsonResponse;

class ProjectController extends Controller
{
    public function index(): JsonResponse
    {
        $projects = Project::latest()->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Projects fetched successfully.',
            'data' => ProjectResource::collection($projects),
        ]);
    }

    public function store(StoreProjectRequest $request): JsonResponse
    {
        $project = Project::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Project created successfully.',
            'data' => new ProjectResource($project),
        ], 201);
    }


    public function show(Project $project): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Project fetched successfully.',
            'data' => new ProjectResource($project),
        ]);
    }


    public function update(UpdateProjectRequest $request, Project $project): JsonResponse
    {
        $project->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Project updated successfully.',
            'data' => new ProjectResource($project),
        ]);
    }


    public function destroy(Project $project): JsonResponse
    {
        $project->delete();

        return response()->json([
            'success' => true,
            'message' => 'Project deleted successfully.',
        ]);
    }
}
