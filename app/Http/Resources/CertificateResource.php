<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CertificateResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                    => $this->id,
            'title'                 => $this->title,
            'organization'          => $this->organization,
            'issue_date'            => $this->issue_date,
            'certificate_url'       => $this->certificate_url,
            'certificate_image'     => $this->certificate_image,
            'certificate_image_url' => $this->certificate_image_url,
        ];
    }
}