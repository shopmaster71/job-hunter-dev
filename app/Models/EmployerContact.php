<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployerContact extends Model
{
    protected $fillable = ['employer_id', 'phone', 'email'];
}
