<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Agency extends Model
{
    use Sluggable;

    protected $fillable = ['user_id', 'slug', 'title', 'city_name', 'address', 'phone', 'email', 'address', 'vk', 'telegram'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    public function getInformation():HasOne
    {
        return $this->hasOne(AgencyInformation::class);
    }

    public function getVacancyList()
    {
        return $this->hasMany(Vacancy::class, 'author_id', 'user_id')->where('status', 0);
    }
}
