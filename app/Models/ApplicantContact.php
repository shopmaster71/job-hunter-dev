<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicantContact extends Model
{
    protected $fillable = ['phone', 'email', 'applicant_id', 'vk', 'vk_check', 'telegram', 'telegram_check'];
}
