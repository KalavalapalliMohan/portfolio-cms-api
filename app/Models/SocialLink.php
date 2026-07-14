<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    protected $fillable = [
        'id',
        'platform',
        'url',
        'icon',
        'sort_order',
    ];
}
