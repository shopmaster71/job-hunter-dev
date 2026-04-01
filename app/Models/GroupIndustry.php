<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GroupIndustry extends Model
{
    protected $fillable = ['title'];

    public function industries():HasMany
    {
        return $this->hasMany(Industry::class, 'group_industries_id','id');
    }
}
