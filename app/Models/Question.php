<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Question extends Model
{
    protected $fillable = ['page_id', 'question', 'answer'];

    public function getPage():HasOne
    {
        return $this->hasOne(Page::class, 'id', 'page_id');
    }
}
