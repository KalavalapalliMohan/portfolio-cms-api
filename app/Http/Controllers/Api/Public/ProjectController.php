<?php

namespace App\Http\Controllers\Api\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Http\Resources\ProjectResource;
class ProjectController extends Controller
{
    public function index()
    {
        try {
            $projects = Project::where('status', true)->get();

            return response()->json([
                'success' => true,
                'message' => 'Projects fetched successfully.',
                'data' => ProjectResource::collection($projects),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch projects.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
