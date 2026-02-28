<?php

namespace App\Services;

use App\Models\City;
use Illuminate\Support\Facades\Cache;

class CityService
{
    /**
     * Находит ID города по его точному или частичному имени.
     *
     * @param string|null $name
     * @return int|null
     */
    public function resolveId(?string $name): ?int
    {
        if (!$name || trim($name) === '') {
            return null;
        }
        $name = trim($name);
        return Cache::remember("city_id_for_{$name}", 3600, function () use ($name) {
            return City::where('name', 'like', $name)->value('id');
        });
    }

    /**
     * Проверяет, существует ли город с таким именем.
     *
     * @param string|null $name
     * @return bool
     */
    public function exists(?string $name): bool
    {
        return $this->resolveId($name) !== null;
    }

    /**
     * Ищет города по подстроке (для автодополнения).
     *
     * @param string $query
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function search(string $query, int $limit = 10)
    {
        return Cache::remember("city_search_{$query}_{$limit}", 3600, function () use ($query, $limit) {
            return City::where('name', 'like', "%{$query}%")
                ->limit($limit)
                ->get(['id', 'name']);
        });
    }
}
