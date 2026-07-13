<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();

        return response()->json([
            'success' => true,
            'message' => 'Settings fetched successfully.',
            'data' => $setting
        ], 200);
    }
}
