<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class CitySelector extends Component
{
    public $cities;
    public $currentCity;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->cities = DB::table('cities')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
        $this->currentCity = session('user_city', 'Москва');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.city-selector');
    }
}
