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
        $settings = Setting::latest()->first();

        return $this->successResponse(
            new SettingResource($settings),
            'Settings fetched successfully.'
        );
    }

    public function store(StoreSettingRequest $request): JsonResponse
    {
        $data = $request->validated();

        if ($request->hasFile('profile_image')) {

            $imageName = time() . '.' . $request->file('profile_image')->extension();

            $request->file('profile_image')->storeAs(
                'settings',
                $imageName,
                'public'
            );

            $data['profile_image'] = $imageName;
        }

        $setting = Setting::create($data);

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
        $data = $request->validated();

        if ($request->hasFile('profile_image')) {

            $imageName = time() . '.' . $request->file('profile_image')->extension();

            $request->file('profile_image')->storeAs(
                'settings',
                $imageName,
                'public'
            );

            $data['profile_image'] = $imageName;
        }

        $setting->update($data);

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
