<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employer extends Model
{
    use Sluggable;

    protected $fillable = ['user_id', 'slug', 'title', 'sector', 'city_name', 'address', 'about', 'gallery'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    public function getContact():HasOne
    {
        return $this->hasOne(EmployerContact::class);
    }
}
