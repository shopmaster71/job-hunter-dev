<?php

namespace App\View\Components;

use App\Models\HeadHunter;
use App\Models\HrMessage;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HrComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $hr = HeadHunter::query()->where('user_id', auth()->id())->first();
        if($hr){
            $messagesCount = HrMessage::query()->where('head_hunter_id', $hr->id)->whereNot('status', 1)->count();
        }else{
            $messagesCount = 0;
        }
        return view('components.hr-component', compact('hr', 'messagesCount'));
    }
}
