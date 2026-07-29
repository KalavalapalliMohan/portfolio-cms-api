<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'full_name'     => $this->full_name,
            'title'         => $this->title,
            'email'         => $this->email,
            'phone'         => $this->phone,
            'location'      => $this->location,
            'about'         => $this->about,

            'resume' => $this->resume,

            'resume_url' => $this->resume
                ? env('SUPABASE_URL')
                    . '/storage/v1/object/public/'
                    . $this->resume
                : null,


            'profile_image' => $this->profile_image,

            'profile_image_url' => $this->profile_image
                ? env('SUPABASE_URL')
                    . '/storage/v1/object/public/settings/'
                    . $this->profile_image
                : null,
        ];
    }
}