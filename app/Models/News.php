<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class News extends Model
{
    use Sluggable;

    protected $fillable = ['title', 'slug', 'subheading', 'content', 'category_id', 'views', 'source', 'source_url', 'image', 'status'];

    /**
     * @return array[]
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    public function getCategory():BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function getTags():BelongsToMany
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'news_tag');
    }
    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d.m.Y');
    }
}
