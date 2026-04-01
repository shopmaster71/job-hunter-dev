<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Specialization extends Model
{
    protected $fillable = ['industry_id', 'title'];

    public function getIndustry():HasOne
    {
        return $this->hasOne(Industry::class, 'id', 'industry_id');
    }
}
