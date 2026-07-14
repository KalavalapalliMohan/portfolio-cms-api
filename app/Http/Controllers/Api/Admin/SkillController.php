<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;
use App\Http\Resources\SkillResource;
use App\Http\Requests\StoreSkillRequest;
use App\Http\Requests\UpdateSkillRequest;
use Illuminate\Http\JsonResponse;

class SkillController extends Controller
{
    public function index(): JsonResponse
    {
        $skills = Skill::latest()->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Skills fetched successfully.',
            'data' => SkillResource::collection($skills),
        ]);
    }

    public function store(StoreSkillRequest $request): JsonResponse
    {
        $skill = Skill::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Skill created successfully.',
            'data' => new SkillResource($skill),
        ], 201);
    }


    public function show(Skill $skill): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Skill fetched successfully.',
            'data' => new SkillResource($skill),
        ]);
    }


    public function update(UpdateSkillRequest $request, Skill $skill): JsonResponse
    {
        $skill->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Skill updated successfully.',
            'data' => new SkillResource($skill),
        ]);
    }


    public function destroy(Skill $skill): JsonResponse
    {
        $skill->delete();

        return response()->json([
            'success' => true,
            'message' => 'Skill deleted successfully.',
        ]);
    }
}
