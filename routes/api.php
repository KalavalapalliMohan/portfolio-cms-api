<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Public\ProjectController;
use App\Http\Controllers\Api\Public\SkillController;
use App\Http\Controllers\Api\Public\SettingController;
use App\Http\Controllers\Api\Public\SocialLinkController;
use App\Http\Controllers\Api\AuthController;

Route::get('/settings', [SettingController::class, 'index']);
Route::get('/skills', [SkillController::class, 'index']);
Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/social-links', [SocialLinkController::class, 'index']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
});