<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class Vacancy extends Model
{
    use Sluggable;

    protected $fillable = ['author_id', 'slug', 'position', 'employment_type_id', 'industry_id', 'specialization_id', 'schedule_id', 'salary_min', 'salary_max', 'contractual', 'expertise_id', 'format_id', 'organization', 'city_name', 'address', 'charge', 'requirement', 'conditions', 'additional', 'status'];

  //Фильтр по городу
    public function filterCity($query, $city)
    {
        if ($city) {
            $query->where('city_name', 'like', "%{$city}%");
        }
    }

    // Фильтр по диапазону зарплаты
    public function filterSalary($query, $salary)
    {
        if (is_array($salary)) {
            if (!empty($salary['min'])) {
                $query->where('salary_min', '>=', $salary['min']);
            }
            if (!empty($salary['to'])) {
                $query->where('salary_max', '<=', $salary['max']);
            }
        }
    }

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

    /**
     * @return Attribute
     */
    protected function publishedAtFormatted(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                return Carbon::parse($attributes['created_at'])->translatedFormat('j F Y');
            }
        );
    }

    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites', 'vacancy_id', 'user_id');
    }

// Атрибут: в избранном ли текущего пользователя?
    public function getIsFavoritedAttribute()
    {
        if (!auth()->check()) {
            return false;
        }

        return $this->favorites->contains(auth()->id());
    }

    /**
     * @return BelongsTo
     */
    public function getAuthor():BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * @return BelongsTo
     */
    public function getIndustry()
    {
        return $this->belongsTo(GroupIndustry::class);
    }

    /**
     * @return BelongsTo
     */
    public function getSpecialization()
    {
        return $this->belongsTo(Specialization::class);
    }

    /**
     * @return BelongsTo
     */
    public function getEmploymentType()
    {
        return $this->belongsTo(EmploymentType::class, 'employment_type_id');
    }

    /**
     * @return BelongsTo
     */
    public function getSchedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id');
    }

    /**
     * @return BelongsTo
     */
    public function getExpertise()
    {
        return $this->belongsTo(Expertise::class, 'expertise_id');
    }

    /**
     * @return BelongsTo
     */
    public function getFormat()
    {
        return $this->belongsTo(Format::class, 'format_id');
    }

    /**
     * @var string[]
     */
    protected $casts = [
        'additional' => 'array',
    ];
}
