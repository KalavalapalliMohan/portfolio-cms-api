<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialLink;
use App\Http\Resources\SocialLinkResource;
use App\Http\Requests\StoreSocialLinkRequest;
use App\Http\Requests\UpdateSocialLinkRequest;
use Illuminate\Http\JsonResponse;

class SocialLinkController extends Controller
{
    public function index(): JsonResponse
    {
        $socialLinks = SocialLink::latest()->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Social links fetched successfully.',
            'data' => SocialLinkResource::collection($socialLinks),
        ]);
    }

    public function store(StoreSocialLinkRequest $request): JsonResponse
    {
        $socialLink = SocialLink::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Social link created successfully.',
            'data' => new SocialLinkResource($socialLink),
        ], 201);
    }


    public function show(SocialLink $socialLink): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Social link fetched successfully.',
            'data' => new SocialLinkResource($socialLink),
        ]);
    }


    public function update(UpdateSocialLinkRequest $request, SocialLink $socialLink): JsonResponse
    {
        $socialLink->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Social link updated successfully.',
            'data' => new SocialLinkResource($socialLink),
        ]);
    }


    public function destroy(SocialLink $socialLink): JsonResponse
    {
        $socialLink->delete();

        return response()->json([
            'success' => true,
            'message' => 'Social link deleted successfully.',
        ]);
    }
}
