<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Experience;
use App\Http\Resources\ExperienceResource;
use App\Http\Requests\StoreExperienceRequest;
use App\Http\Requests\UpdateExperienceRequest;
use Illuminate\Http\JsonResponse;

class ExperienceController extends Controller
{
    public function index(): JsonResponse
    {
        $experiences = Experience::latest()->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Experiences fetched successfully.',
            'data' => ExperienceResource::collection($experiences),
        ]);
    }

    public function store(StoreExperienceRequest $request): JsonResponse
    {
        $experience = Experience::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Experience created successfully.',
            'data' => new ExperienceResource($experience),
        ], 201);
    }


    public function show(Experience $experience): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Experience fetched successfully.',
            'data' => new ExperienceResource($experience),
        ]);
    }


    public function update(UpdateExperienceRequest $request, Experience $experience): JsonResponse
    {
        $experience->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Experience updated successfully.',
            'data' => new ExperienceResource($experience),
        ]);
    }


    public function destroy(Experience $experience): JsonResponse
    {
        $experience->delete();

        return response()->json([
            'success' => true,
            'message' => 'Experience deleted successfully.',
        ]);
    }
}
