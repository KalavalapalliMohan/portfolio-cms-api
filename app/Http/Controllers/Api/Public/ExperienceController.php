<?php

namespace App\Http\Controllers\Api\Public;

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
    public function index(Request $request): JsonResponse
    {
        $experiences = Experience::latest()->paginate(10);

        return $this->successResponse(
            ExperienceResource::collection($experiences),
            'Experiences fetched successfully.'
        );
    }
}
