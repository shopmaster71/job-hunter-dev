<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = ['position', 'city', 'applicant_id', 'organization', 'period_start', 'period_end', 'present', 'description'];
}
