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
use Illuminate\Support\Facades\Storage;
use Exception;

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

        try {

            $disk = Storage::disk('s3');


            // Profile Image Upload
            if ($request->hasFile('profile_image')) {

                $imageName = uniqid() . '.' .
                    $request->file('profile_image')->extension();


                $disk->putFileAs(
                    'settings',
                    $request->file('profile_image'),
                    $imageName,
                    'public'
                );


                $data['profile_image'] =
                    config('app.supabase_url')
                    . '/storage/v1/object/public/settings/'
                    . $imageName;
            }


            // Resume Upload
            if ($request->hasFile('resume')) {

                $resumeName = uniqid() . '_' .
                    $request->file('resume')->getClientOriginalName();


                $disk->putFileAs(
                    'resume',
                    $request->file('resume'),
                    $resumeName,
                    'public'
                );


                $data['resume'] =
                    config('app.supabase_url')
                    . '/storage/v1/object/public/resume/'
                    . $resumeName;
            }


            $setting = Setting::create($data);


            return $this->successResponse(
                new SettingResource($setting),
                'Setting created successfully.',
                201
            );


        } catch (Exception $e) {

            return $this->errorResponse(
                'File upload failed.',
                $e->getMessage(),
                500
            );
        }
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


        try {

            $disk = Storage::disk('s3');


            // Profile Image Update
            if ($request->hasFile('profile_image')) {


                $imageName = uniqid() . '.' .
                    $request->file('profile_image')->extension();


                $disk->putFileAs(
                    'settings',
                    $request->file('profile_image'),
                    $imageName,
                    'public'
                );


                $data['profile_image'] =
                    config('app.supabase_url')
                    . '/storage/v1/object/public/settings/'
                    . $imageName;
            }



            // Resume Update
            if ($request->hasFile('resume')) {


                $resumeName = uniqid() . '_' .
                    $request->file('resume')->getClientOriginalName();


                $disk->putFileAs(
                    'resume',
                    $request->file('resume'),
                    $resumeName,
                    'public'
                );


                $data['resume'] =
                    config('app.supabase_url')
                    . '/storage/v1/object/public/resume/'
                    . $resumeName;
            }



            $setting->update($data);

            $setting->refresh();



            return $this->successResponse(
                new SettingResource($setting),
                'Setting updated successfully.'
            );


        } catch (Exception $e) {


            return $this->errorResponse(
                'File upload failed.',
                $e->getMessage(),
                500
            );
        }
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