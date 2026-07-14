<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Resources\SettingResource;
use App\Http\Requests\StoreSettingRequest;
use App\Http\Requests\UpdateSettingRequest;
use Illuminate\Http\JsonResponse;

class SettingController extends Controller
{
    public function index(): JsonResponse
    {
        $settings = Setting::latest()->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Settings fetched successfully.',
            'data' => SettingResource::collection($settings),
        ]);
    }

    public function store(StoreSettingRequest $request): JsonResponse
    {
        $setting = Setting::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Setting created successfully.',
            'data' => new SettingResource($setting),
        ], 201);
    }


    public function show(Setting $setting): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Setting fetched successfully.',
            'data' => new SettingResource($setting),
        ]);
    }


    public function update(UpdateSettingRequest $request, Setting $setting): JsonResponse
    {
        $setting->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Setting updated successfully.',
            'data' => new SettingResource($setting),
        ]);
    }


    public function destroy(Setting $setting): JsonResponse
    {
        $setting->delete();

        return response()->json([
            'success' => true,
            'message' => 'Setting deleted successfully.',
        ]);
    }
}
