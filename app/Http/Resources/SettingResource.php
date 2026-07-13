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
            'resume'        => $this->resume,
            'profile_image' => $this->profile_image,
        ];
    }
}
