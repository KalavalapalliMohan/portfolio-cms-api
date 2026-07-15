<?php

namespace App\Http\Controllers\Api\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialLink;
use App\Http\Resources\SocialLinkResource;
use App\Traits\ApiResponse;

class SocialLinkController extends Controller
{
    use ApiResponse;
    public function index()
    {
        $socialLinks = SocialLink::latest()->paginate(10);

        return $this->successResponse(
            SocialLinkResource::collection($socialLinks),
            'Social links fetched successfully.'
        );
    }
}
