<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HrMessage extends Model
{
    protected $fillable = ['head_hunter_id', 'phone', 'email', 'theme', 'message', 'status'];
}
