<?php

namespace App\View\Components;

use App\Models\Employer;
use App\Models\Response;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EmployerComponent extends Component
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
        $employer = Employer::query()->where('user_id', auth()->id())->first();
        if($employer){
            $responses = Response::query()->where('author_id', $employer->user_id)->where('status', 0)->count();
        }else{
            $responses = 0;
        }
        return view('components.employer-component', compact('employer', 'responses'));
    }
}
