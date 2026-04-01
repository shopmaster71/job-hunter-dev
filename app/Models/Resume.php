<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Resume extends Model
{
    protected $fillable = ['applicant_id', 'position', 'salary', 'status'];

    public function getApplicant():BelongsTo
    {
        return $this->belongsTo(Applicant::class, 'applicant_id', 'id');
    }
}
