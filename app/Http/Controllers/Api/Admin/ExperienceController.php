<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Experience;
use App\Http\Resources\ExperienceResource;
use App\Http\Requests\StoreExperienceRequest;
use App\Http\Requests\UpdateExperienceRequest;
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponse;

class ExperienceController extends Controller
{
    use ApiResponse;
    public function index(): JsonResponse
    {
        $experiences = Experience::latest()->paginate(10);

        return $this->successResponse(
            ExperienceResource::collection($experiences),
            'Experiences fetched successfully.'
        );
    }

    public function store(StoreExperienceRequest $request): JsonResponse
    {
        $experience = Experience::create($request->validated());

        return $this->successResponse(
            new ExperienceResource($experience),
            'Experience created successfully.',
            201
        );
    }


    public function show(Experience $experience): JsonResponse
    {
        return $this->successResponse(
            new ExperienceResource($experience),
            'Experience fetched successfully.'
        );
    }


    public function update(UpdateExperienceRequest $request, Experience $experience): JsonResponse
    {
        $experience->update($request->validated());

        return $this->successResponse(
            new ExperienceResource($experience),
            'Experience updated successfully.'
        );
    }


    public function destroy(Experience $experience): JsonResponse
    {
        $experience->delete();
        return $this->successResponse(
            null,
            'Experience deleted successfully.'
        );
    }
}
