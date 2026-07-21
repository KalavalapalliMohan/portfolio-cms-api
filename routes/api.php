<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Public\ProjectController;
use App\Http\Controllers\Api\Public\SkillController;
use App\Http\Controllers\Api\Public\SettingController;
use App\Http\Controllers\Api\Public\SocialLinkController;
use App\Http\Controllers\Api\Public\ExperienceController;
use App\Http\Controllers\Api\Public\EducationController;
use App\Http\Controllers\Api\Public\CertificateController;
use App\Http\Controllers\Api\Public\ContactController;

use App\Http\Controllers\Api\AuthController;
// Admin Controllers
use App\Http\Controllers\Api\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Api\Admin\SkillController as AdminSkillController;
use App\Http\Controllers\Api\Admin\ExperienceController as AdminExperienceController;
use App\Http\Controllers\Api\Admin\EducationController as AdminEducationController;
use App\Http\Controllers\Api\Admin\CertificateController as AdminCertificateController;
use App\Http\Controllers\Api\Admin\SocialLinkController as AdminSocialLinkController;
use App\Http\Controllers\Api\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Api\Admin\UploadController;
use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\Api\Admin\MessageController;

Route::get('/settings', [SettingController::class, 'index']);// Public route to get settings
Route::get('/skills', [SkillController::class, 'index']);// Public route to get skills
Route::get('/projects', [ProjectController::class, 'index']);// Public route to get projects
Route::get('/experiences', [ExperienceController::class, 'index']);// Public route to get experiences
Route::get('/educations', [EducationController::class, 'index']);// Public route to get educations
Route::get('/certificates', [CertificateController::class, 'index']);// Public route to get certificates
Route::get('/social-links', [SocialLinkController::class, 'index']);// Public route to get social links
Route::post('/contact', [ContactController::class, 'store']);//

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
        Route::apiResource('skills', AdminSkillController::class);
        Route::apiResource('experiences', AdminExperienceController::class);
        Route::apiResource('educations', AdminEducationController::class);
        Route::apiResource('certificates', AdminCertificateController::class);
        Route::apiResource('social-links', AdminSocialLinkController::class);
        Route::apiResource('settings', AdminSettingController::class);
        Route::get('/dashboard', [DashboardController::class, 'index']);
        Route::post('/upload', [UploadController::class, 'store']);

        Route::get('/messages', [MessageController::class, 'index']);

        Route::get('/messages/{id}', [MessageController::class, 'show']);

        Route::delete('/messages/{id}', [MessageController::class, 'destroy']);


    });
