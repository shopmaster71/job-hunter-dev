<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Industry extends Model
{
    protected $fillable = ['group_industries_id', 'title'];
    public function getGroupIndustries():BelongsTo
    {
        return $this->belongsTo(GroupIndustry::class, 'group_industries_id');
    }
}
