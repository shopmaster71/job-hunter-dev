<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class HrInformation extends Model
{
    protected $fillable = ['head_hunter_id', 'city_name', 'sector', 'advantage', 'about', 'experience', 'services'];
}
