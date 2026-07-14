<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'id',
        'company_name',
        'designation',
        'location',
        'start_date',
        'end_date',
        'currently_working',
        'description',
    ];
}
