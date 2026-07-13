<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialLink;
class SocialLinkController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => SocialLink::all()
        ]);
    }
}
