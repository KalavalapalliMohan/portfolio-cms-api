<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'title',
        'organization',
        'issue_date',
        'certificate_url',
        'certificate_image',
    ];

    public function getCertificateImageUrlAttribute()
    {
        if (!$this->certificate_image) {
            return null;
        }

        return asset('storage/certificates/' . $this->certificate_image);
    }
}