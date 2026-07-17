<?php

namespace App\Http\Controllers\Api\Public;

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
    public function index(Request $request): JsonResponse
    {
        $educations = Education::latest()->paginate(10);

        return $this->successResponse(
            EducationResource::collection($educations),
            'Educations fetched successfully.'
        );
    }
}