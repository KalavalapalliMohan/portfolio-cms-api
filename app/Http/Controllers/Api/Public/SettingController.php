<?php

namespace App\Http\Controllers\Api\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Resources\SettingResource;
use App\Traits\ApiResponse;
class SettingController extends Controller
{
    use ApiResponse;
    public function index()
    {
        try {
            $setting = Setting::latest()->paginate(10);

            return $this->successResponse(
                SettingResource::collection($setting),
                'Settings fetched successfully.'
            );

        } catch (\Exception $e) {
            return $this->errorResponse(
                'Failed to fetch settings.',
                $e->getMessage(),
                500
            );
        }

    }
}
