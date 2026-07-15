<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UploadImageRequest;
use App\Traits\ApiResponse;

class UploadController extends Controller
{
    use ApiResponse;

    public function store(UploadImageRequest $request)
    {
        $path = $request->file('image')->store('projects', 'public');

        return $this->successResponse([
            'image' => $path,
        ], 'Image uploaded successfully.');
    }
}