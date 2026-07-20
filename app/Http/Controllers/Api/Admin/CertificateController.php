<?php

namespace App\Http\Controllers\Api\Admin;

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
    public function index(): JsonResponse
    {
        $certificates = Certificate::latest()->paginate(10);

        return $this->successResponse(
            CertificateResource::collection($certificates),
            'Certificates fetched successfully.'
        );
    }

    public function store(StoreCertificateRequest $request): JsonResponse
    {
        $data = $request->validated();
        if ($request->hasFile('certificate_image')) {
            $imageName = time()
                . '_' . $request->certificate_image->getClientOriginalName();
            $request->certificate_image->storeAs(
                'certificates',
                $imageName,
                'public'
            );
            $data['certificate_image'] = $imageName;
        }
        $certificate = Certificate::create($data);

        return $this->successResponse(
            new CertificateResource($certificate),
            'Certificate created successfully.',
            201
        );

    }


    public function show(Certificate $certificate): JsonResponse
    {
        return $this->successResponse(
            new CertificateResource($certificate),
            'Certificate fetched successfully.'
        );
    }


    public function update(
        UpdateCertificateRequest $request,
        Certificate $certificate
    ): JsonResponse {
        $data = $request->validated();
        if ($request->hasFile('certificate_image')) {
            $imageName = time()
                . '_' . $request->certificate_image->getClientOriginalName();
            $request->certificate_image->storeAs(
                'certificates',
                $imageName,
                'public'
            );
            $data['certificate_image'] = $imageName;
        }
        $certificate->update($data);
        return $this->successResponse(
            new CertificateResource($certificate),
            'Certificate updated successfully.'
        );
    }


    public function destroy(Certificate $certificate): JsonResponse
    {
        $certificate->delete();

        return $this->successResponse(
            null,
            'Certificate deleted successfully.'
        );
    }
}
