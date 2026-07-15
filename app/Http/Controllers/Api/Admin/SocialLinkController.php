<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialLink;
use App\Http\Resources\SocialLinkResource;
use App\Http\Requests\StoreSocialLinkRequest;
use App\Http\Requests\UpdateSocialLinkRequest;
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponse;

class SocialLinkController extends Controller
{
    use ApiResponse;
    public function index(): JsonResponse
    {
        $socialLinks = SocialLink::latest()->paginate(10);

        return $this->successResponse(
            SocialLinkResource::collection($socialLinks),
            'Social links fetched successfully.'
        );
    }

    public function store(StoreSocialLinkRequest $request): JsonResponse
    {
        $socialLink = SocialLink::create($request->validated());

        return $this->successResponse(
            new SocialLinkResource($socialLink),
            'Social link created successfully.',
            201
        );
    }


    public function show(SocialLink $socialLink): JsonResponse
    {
        return $this->successResponse(
            new SocialLinkResource($socialLink),
            'Social link fetched successfully.'
        );
    }


    public function update(UpdateSocialLinkRequest $request, SocialLink $socialLink): JsonResponse
    {
        $socialLink->update($request->validated());

        return $this->successResponse(
            new SocialLinkResource($socialLink),
            'Social link updated successfully.'
        );
    }


    public function destroy(SocialLink $socialLink): JsonResponse
    {
        $socialLink->delete();

        return $this->successResponse(
            null,
            'Social link deleted successfully.'
        );
    }
}
