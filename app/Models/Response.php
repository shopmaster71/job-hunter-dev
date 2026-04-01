<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Response extends Model
{
    protected $fillable = ['applicant_id', 'vacancy_id', 'author_id', 'position', 'organization', 'resp', 'resume', 'status'];

    public function getApplicant():BelongsTo
    {
        return $this->belongsTo(Applicant::class, 'applicant_id', 'id');
    }
}
