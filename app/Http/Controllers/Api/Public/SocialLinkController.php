<?php

namespace App\Http\Controllers\Api\Public;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use App\Http\Resources\SocialLinkResource;
use App\Traits\ApiResponse;

class SocialLinkController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $socialLinks = SocialLink::orderBy('sort_order')
            ->get();

        return $this->successResponse(
            SocialLinkResource::collection($socialLinks),
            'Social links fetched successfully.'
        );
    }
}