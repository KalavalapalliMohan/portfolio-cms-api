<?php

namespace App\Http\Controllers\Api\Public;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Certificate;
use App\Http\Resources\CertificateResource;
use App\Http\Requests\StoreCertificateRequest;
use App\Http\Requests\UpdateCertificateRequest;
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponse;

class CertificateController extends Controller
{
    use ApiResponse;
    public function index(Request $request): JsonResponse
    {
        $certificates = Certificate::latest()->paginate(10);

        return $this->successResponse(
            CertificateResource::collection($certificates),
            'Certificates fetched successfully.'
        );
    }
}
