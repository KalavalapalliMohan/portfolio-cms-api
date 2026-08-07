<?php

namespace App\Http\Controllers\Api\Public;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;

use App\Models\Setting;
use App\Models\Skill;
use App\Models\Project;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Certificate;
use App\Models\SocialLink;

use App\Http\Resources\SettingResource;
use App\Http\Resources\SkillResource;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\ExperienceResource;
use App\Http\Resources\EducationResource;
use App\Http\Resources\CertificateResource;
use App\Http\Resources\SocialLinkResource;
use Illuminate\Support\Facades\Cache;
class PortfolioController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $portfolio = Cache::remember('portfolio_data', 60 * 60, function () {

            return [
                'settings' => new SettingResource(
                    Setting::latest()->first()
                ),

                'skills' => SkillResource::collection(
                    Skill::orderBy('sort_order')->get()
                ),

                'projects' => ProjectResource::collection(
                    Project::latest()->get()
                ),

                'experiences' => ExperienceResource::collection(
                    Experience::latest()->get()
                ),

                'educations' => EducationResource::collection(
                    Education::latest()->get()
                ),

                'certificates' => CertificateResource::collection(
                    Certificate::latest()->get()
                ),

                'social_links' => SocialLinkResource::collection(
                    SocialLink::orderBy('sort_order')->get()
                ),
            ];
        });

        return $this->successResponse(
            $portfolio,
            'Portfolio fetched successfully.'
        );
    }
}