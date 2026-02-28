<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Vacancy extends Model
{
    use Sluggable;

    protected $fillable = ['author_id', 'slug', 'position', 'employment_type', 'schedule', 'salary_min', 'salary_max', 'contractual', 'experience', 'format', 'organization', 'city_name', 'address', 'charge', 'requirement', 'conditions', 'additional', 'status'];

    /**
     * @return array[]
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['position', 'employment_type'],
            ],
        ];
    }

    protected function publishedAtFormatted(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                return Carbon::parse($attributes['created_at'])->translatedFormat('j F Y');
            }
        );
    }
}
