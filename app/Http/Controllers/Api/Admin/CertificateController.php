<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Certificate;
use App\Http\Resources\CertificateResource;
use App\Http\Requests\StoreCertificateRequest;
use App\Http\Requests\UpdateCertificateRequest;
use Illuminate\Http\JsonResponse;

class CertificateController extends Controller
{
    public function index(): JsonResponse
    {
        $certificates = Certificate::latest()->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Certificates fetched successfully.',
            'data' => CertificateResource::collection($certificates),
        ]);
    }

    public function store(StoreCertificateRequest $request): JsonResponse
    {
        $certificate = Certificate::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Certificate created successfully.',
            'data' => new CertificateResource($certificate),
        ], 201);
    }


    public function show(Certificate $certificate): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Certificate fetched successfully.',
            'data' => new CertificateResource($certificate),
        ]);
    }


    public function update(UpdateCertificateRequest $request, Certificate $certificate): JsonResponse
    {
        $certificate->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Certificate updated successfully.',
            'data' => new CertificateResource($certificate),
        ]);
    }


    public function destroy(Certificate $certificate): JsonResponse
    {
        $certificate->delete();

        return response()->json([
            'success' => true,
            'message' => 'Certificate deleted successfully.',
        ]);
    }
}
