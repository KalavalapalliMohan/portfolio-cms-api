<?php

namespace App\Http\Controllers\Api\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Resources\SettingResource;
class SettingController extends Controller
{
    public function index()
    {
        try {
            $setting = Setting::get();

            return response()->json([
                'success' => true,
                'message' => 'Settings fetched successfully.',
                'data' => SettingResource::collection($setting),
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch settings.',
                'error' => $e->getMessage(),
            ], 500);
        }

    }
}
