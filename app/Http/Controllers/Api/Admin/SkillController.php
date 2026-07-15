<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;
use App\Http\Resources\SkillResource;
use App\Http\Requests\StoreSkillRequest;
use App\Http\Requests\UpdateSkillRequest;
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponse;

class SkillController extends Controller
{
    use ApiResponse;
    public function index(Request $request): JsonResponse
    {
        $skills = Skill::query()
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->where('category', $request->category);
            })
            ->latest()
            ->paginate($request->get('per_page', 10))
            ->withQueryString();

        return $this->successResponse(
            SkillResource::collection($skills),
            'Skills fetched successfully.'
        );
    }

    public function store(StoreSkillRequest $request): JsonResponse
    {
        $skill = Skill::create($request->validated());

        return $this->successResponse(
            new SkillResource($skill),
            'Skill created successfully.',
            201
        );
    }


    public function show(Skill $skill): JsonResponse
    {
        return $this->successResponse(
            new SkillResource($skill),
            'Skill fetched successfully.'
        );
    }


    public function update(UpdateSkillRequest $request, Skill $skill): JsonResponse
    {
        $skill->update($request->validated());

        return $this->successResponse(
            new SkillResource($skill),
            'Skill updated successfully.'
        );
    }


    public function destroy(Skill $skill): JsonResponse
    {
        $skill->delete();

        return $this->successResponse(
            null,
            'Skill deleted successfully.'
        );
    }
}
