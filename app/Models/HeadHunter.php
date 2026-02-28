<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class HeadHunter extends Model
{
    use Sluggable;
    protected $fillable = ['user_id', 'slug', 'name', 'surname'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['name', 'surname'],
            ],
        ];
    }

    /**
     * @return HasOne
     */
    public function getInformation():HasOne
    {
        return $this->hasOne(HrInformation::class, 'head_hunter_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function getPhoto(): HasOne
    {
        return $this->hasOne(Photo::class, 'user_id', 'user_id');
    }

    /**
     * @return BelongsTo
     */
    public function getUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
