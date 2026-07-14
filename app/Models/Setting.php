<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'id',
        'full_name',
        'title',
        'email',
        'phone',
        'location',
        'about',
        'resume',
        'profile_image',
    ];
}
