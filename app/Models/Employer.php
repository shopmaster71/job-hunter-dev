<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employer extends Model
{
    use Sluggable;

    protected $fillable = ['user_id', 'slug', 'title', 'industry_id', 'city_name', 'address', 'about', 'gallery'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    public function getIndustry(): HasOne
    {
        return $this->hasOne(Industry::class, 'id', 'industry_id');
    }

    public function getContact():HasOne
    {
        return $this->hasOne(EmployerContact::class);
    }

    public function getVacancyList()
    {
        return $this->hasMany(Vacancy::class, 'author_id', 'user_id')->where('status', 0);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
