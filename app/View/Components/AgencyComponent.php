<?php

namespace App\View\Components;

use App\Models\Agency;
use App\Models\AgencyMessage;
use App\Models\Response;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AgencyComponent extends Component
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
        $agency = Agency::query()->where('user_id', auth()->id())->first();
        $responses = Response::query()->where('author_id', $agency->user_id)->where('status', 0)->count();
        if($agency){
            $messagesCount = AgencyMessage::query()->where('agency_id', $agency->id)->whereNot('status', 1)->count();
        }else{
            $messagesCount = 0;
        }
        return view('components.agency-component', compact('agency', 'messagesCount', 'responses'));
    }
}
