<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialLink;
use App\Http\Resources\SocialLinkResource;
class SocialLinkController extends Controller
{
    public function index()
    {
        try {
            $socialLinks = SocialLink::get();

            return response()->json([
                'success' => true,
                'message' => 'Social links fetched successfully.',
                'data' => SocialLinkResource::collection($socialLinks)
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch social links.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
