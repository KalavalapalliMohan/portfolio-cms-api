<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Education;
use App\Http\Resources\EducationResource;
use App\Http\Requests\StoreEducationRequest;
use App\Http\Requests\UpdateEducationRequest;
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponse;

class EducationController extends Controller
{
    use ApiResponse;
    public function index(): JsonResponse
    {
        $educations = Education::latest()->paginate(10);

        return $this->successResponse(
            EducationResource::collection($educations),
            'Educations fetched successfully.'
        );
    }

    public function store(StoreEducationRequest $request): JsonResponse
    {
        $education = Education::create($request->validated());

        return $this->successResponse(
            new EducationResource($education),
            'Education created successfully.',
            201
        );
    }


    public function show(Education $education): JsonResponse
    {
        return $this->successResponse(
            new EducationResource($education),
            'Education fetched successfully.'
        );
    }


    public function update(UpdateEducationRequest $request, Education $education): JsonResponse
    {
        $education->update($request->validated());

        return $this->successResponse(
            new EducationResource($education),
            'Education updated successfully.'
        );
    }

    public function destroy(Education $education): JsonResponse
    {
        $education->delete();

        return $this->successResponse(
            null,
            'Education deleted successfully.'
        );
    }
}
