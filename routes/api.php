<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\SkillController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\SocialLinkController;

Route::get('/settings', [SettingController::class, 'index']);
Route::get('/skills', [SkillController::class, 'index']);
Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/social-links', [SocialLinkController::class, 'index']);