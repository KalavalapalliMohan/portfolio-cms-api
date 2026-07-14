<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Public\ProjectController;
use App\Http\Controllers\Api\Public\SkillController;
use App\Http\Controllers\Api\Public\SettingController;
use App\Http\Controllers\Api\Public\SocialLinkController;
use App\Http\Controllers\Api\AuthController;
// Admin Controllers
use App\Http\Controllers\Api\Admin\ProjectController as AdminProjectController;

Route::get('/settings', [SettingController::class, 'index']);// Public route to get settings
Route::get('/skills', [SkillController::class, 'index']);// Public route to get skills
Route::get('/projects', [ProjectController::class, 'index']);// Public route to get projects
Route::get('/social-links', [SocialLinkController::class, 'index']);// Public route to get social links

Route::post('/login', [AuthController::class, 'login']);// Public route to login

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);// Protected route to logout
    Route::get('/me', [AuthController::class, 'me']);// Protected route to get authenticated user details
});

// Admin routes
Route::middleware('auth:sanctum')
    ->prefix('admin')
    ->group(function () {

        Route::apiResource('projects', AdminProjectController::class);

    });