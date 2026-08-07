<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
class DashboardController extends Controller
{
    public function index()
    {
        $totalMonths = 0;

        $experiences = Cache::remember('experiences', 60 * 60, function () {
            return Experience::all();
        });

        foreach ($experiences as $experience) {
            $start = Carbon::parse($experience->start_date);

            $end = $experience->currently_working
                ? now()
                : Carbon::parse($experience->end_date);

            $totalMonths += $start->diffInMonths($end);
        }

        $years = floor($totalMonths / 12);
        $months = $totalMonths % 12;

        return response()->json([
            'success' => true,
            'data' => [
                'total_projects' => Project::count(),
                'total_skills' => Skill::count(),
                'total_experience' => "{$years} Years {$months} Months",
                'total_messages' => Message::count(),

                'recent_projects' => Project::latest()
                    ->take(5)
                    ->get(),
            ]
        ]);
    }
}