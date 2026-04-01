<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgencyMessage extends Model
{
    protected $fillable = ['agency_id', 'phone', 'email', 'theme', 'message', 'status'];
}
