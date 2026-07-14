<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExperienceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                    => $this->id,
            'company_name'          => $this->company_name,
            'designation'           => $this->designation,
            'location'              => $this->location,
            'start_date'            => $this->start_date,
            'end_date'              => $this->end_date,
            'currently_working'     => $this->currently_working,
            'description'           => $this->description,
        ];
    }
}
