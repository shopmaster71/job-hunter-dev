<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicantMessage extends Model
{
    protected $fillable = ['phone', 'email', 'applicant_id', 'theme', 'message', 'status'];
}
