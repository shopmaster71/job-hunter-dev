<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $fillable = ['institution', 'city', 'applicant_id', 'specialization', 'faculty', 'period_start', 'period_end', 'present'];
}
