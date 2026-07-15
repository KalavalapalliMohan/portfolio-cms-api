<?php

namespace App\Http\Controllers\Api\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;
use App\Http\Resources\SkillResource;
use App\Traits\ApiResponse;

class SkillController extends Controller
{
    use ApiResponse;
    public function index(Request $request)
    {
        try {
            $skills = Skill::query()
                ->when($request->filled('category'), function ($query) use ($request) {
                    $query->where('category', $request->category);
                })
                ->where('status', true)
                ->latest()
                ->paginate($request->get('per_page', 10))
                ->withQueryString();

            return $this->successResponse(
                SkillResource::collection($skills),
                'Skills fetched successfully.'
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                'Failed to fetch skills.',
                $e->getMessage(),
                500
            );
        }
    }
}
