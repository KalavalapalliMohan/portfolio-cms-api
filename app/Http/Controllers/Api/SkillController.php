<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::where('status', true)->get();

        return response()->json([
            'success' => true,
            'message' => 'Skills fetched successfully.',
            'data' => $skills
        ], 200);
    }
}
