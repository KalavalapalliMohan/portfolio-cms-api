<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;
use App\Http\Resources\SkillResource;
class SkillController extends Controller
{
    public function index()
    {
        try {
            $skills = Skill::where('status', true)->get();

            return response()->json([
                'success' => true,
                'message' => 'Skills fetched successfully.',
                'data' => SkillResource::collection($skills)
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch skills.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
