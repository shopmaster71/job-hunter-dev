<?php

namespace App\Http\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    /**
     * Применение фильтров к запросу
     *
     * @param Builder $query
     * @param array $filters
     * @return Builder
     */
    public function scopeFilter(Builder $query, array $filters): Builder
    {
        foreach ($filters as $key => $value) {
            if (method_exists($this, 'filter' . ucfirst($key))) {
                $this->{'filter' . ucfirst($key)}($query, $value);
            }
        }

        return $query;
    }
}
