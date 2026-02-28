<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Applicant extends Model
{
    use Sluggable;
    protected $fillable = ['user_id', 'slug', 'name', 'surname', 'patronymic', 'city_name', 'birth_date', 'gender', 'citizenship', 'education', 'driving_licence', 'married', 'children'];

    /**
     * @return array[]
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['name', 'surname'],
            ],
        ];
    }

    /**
     * Return applicants Photo
     * @return HasOne
     */
    public function getPhoto(): HasOne
    {
        return $this->hasOne(Photo::class, 'user_id', 'user_id');
    }

    protected function photoUrl(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                $default = '/assets/img/no-photo.webp';
                $photo = $this->getRelationValue('getPhoto');
                if ($photo && $photo->photo) {
                    return $photo->photo;
                }
                return $default;
            }
        );
    }

    /**
     * Return applicants Contact
     * @return HasOne
     */
    public function getContact():hasOne
    {
        return $this->hasOne(ApplicantContact::class);
    }

    /**
     * Return applicants Experiences
     * @return HasMany
     */
    public function getExperiences():HasMany
    {
        return $this->hasMany(Experience::class);
    }

    /**
     * Return applicants Educations
     * @return HasMany
     */
    public function getEducations():HasMany
    {
        return $this->hasMany(Education::class);
    }
}
