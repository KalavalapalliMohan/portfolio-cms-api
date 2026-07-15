<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Resources\SettingResource;
use App\Http\Requests\StoreSettingRequest;
use App\Http\Requests\UpdateSettingRequest;
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponse;

class SettingController extends Controller
{
    use ApiResponse;
    public function index(): JsonResponse
    {
        $settings = Setting::latest()->paginate(10);

        return $this->successResponse(
            SettingResource::collection($settings),
            'Settings fetched successfully.'
        );
    }

    public function store(StoreSettingRequest $request): JsonResponse
    {
        $setting = Setting::create($request->validated());

        return $this->successResponse(
            new SettingResource($setting),
            'Setting created successfully.',
            201
        );
    }


    public function show(Setting $setting): JsonResponse
    {
        return $this->successResponse(
            new SettingResource($setting),
            'Setting fetched successfully.'
        );
    }


    public function update(UpdateSettingRequest $request, Setting $setting): JsonResponse
    {
        $setting->update($request->validated());

        return $this->successResponse(
            new SettingResource($setting),
            'Setting updated successfully.'
        );
    }


    public function destroy(Setting $setting): JsonResponse
    {
        $setting->delete();

        return $this->successResponse(
            null,
            'Setting deleted successfully.'
        );
    }
}
