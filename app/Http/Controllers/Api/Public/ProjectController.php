<?php

namespace App\Http\Controllers\Api\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Http\Resources\ProjectResource;
use App\Traits\ApiResponse;

class ProjectController extends Controller
{
    use ApiResponse;
    public function index(Request $request)
    {
        try {
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
        } catch (\Exception $e) {
            return $this->errorResponse(
                'Failed to fetch projects.',
                $e->getMessage(),
                500
            );
        }
    }
}
