<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Http\Resources\ProjectResource;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponse;
use OpenApi\Attributes as OA;

class ProjectController extends Controller
{
    use ApiResponse;



        #[OA\Get(
            path: '/api/projects',
            operationId: 'getProjects',
            tags: ['Projects'],
            summary: 'Get all projects'
        )]
        #[OA\Response(
            response: 200,
            description: 'Projects fetched successfully'
        )]
    public function index(Request $request): JsonResponse
    {
        $projects = Project::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            })
            ->latest()
            ->paginate($request->get('per_page', 10))
            ->withQueryString();

        return $this->successResponse(
            ProjectResource::collection($projects),
            'Projects fetched successfully.'
        );
    }

    public function store(StoreProjectRequest $request): JsonResponse
    {
        $project = Project::create($request->validated());

        return $this->successResponse(
            new ProjectResource($project),
            'Project created successfully.',
            201
        );
    }


    public function show(Project $project): JsonResponse
    {
        return $this->successResponse(
            new ProjectResource($project),
            'Project fetched successfully.'
        );
    }


    public function update(UpdateProjectRequest $request, Project $project): JsonResponse
    {
        $project->update($request->validated());

        return $this->successResponse(
            new ProjectResource($project),
            'Project updated successfully.'
        );
    }


    public function destroy(Project $project): JsonResponse
    {
        $project->delete();

        return $this->successResponse(
            null,
            'Project deleted successfully.'
        );
    }
}
