<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Education;
use App\Http\Resources\EducationResource;
use App\Http\Requests\StoreEducationRequest;
use App\Http\Requests\UpdateEducationRequest;
use Illuminate\Http\JsonResponse;

class EducationController extends Controller
{
    public function index(): JsonResponse
    {
        $educations = Education::latest()->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Educations fetched successfully.',
            'data' => EducationResource::collection($educations),
        ]);
    }

    public function store(StoreEducationRequest $request): JsonResponse
    {
        $education = Education::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Education created successfully.',
            'data' => new EducationResource($education),
        ], 201);
    }


    public function show(Education $education): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Education fetched successfully.',
            'data' => new EducationResource($education),
        ]);
    }


    public function update(UpdateEducationRequest $request, Education $education): JsonResponse
    {
        $education->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Education updated successfully.',
            'data' => new EducationResource($education),
        ]);
    }


    public function destroy(Education $education): JsonResponse
    {
        $education->delete();

        return response()->json([
            'success' => true,
            'message' => 'Education deleted successfully.',
        ]);
    }
}
