<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $fillable = [
        'id',
        'institution',
        'degree',
        'field_of_study',
        'grade',
        'start_year',
        'end_year',
        'description',
    ];
}
