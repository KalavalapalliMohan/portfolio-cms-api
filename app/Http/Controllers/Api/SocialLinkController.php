<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialLink;
class SocialLinkController extends Controller
{
    public function index()
    {
        $socialLinks = SocialLink::where('status', true)->get();

        return response()->json([
            'success' => true,
            'message' => 'Social links fetched successfully.',
            'data' => $socialLinks
        ], 200);
    }
}
