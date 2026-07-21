<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Message;

class DashboardController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'total_projects' => Project::count(),
                'total_skills' => Skill::count(),
                'total_experiences' => Experience::count(),
                'total_messages' => Message::count(),

                'recent_projects' => Project::latest()
                    ->take(5)
                    ->get(),
            ]
        ]);
    }
}