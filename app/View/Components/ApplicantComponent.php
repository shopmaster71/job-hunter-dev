<?php

namespace App\View\Components;

use App\Models\Applicant;
use App\Models\ApplicantContact;
use App\Models\ApplicantMessage;
use App\Models\Photo;
use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ApplicantComponent extends Component
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
        $applicant = Applicant::query()->where('user_id', auth()->id())->first();
        if($applicant){
            $messagesCount = ApplicantMessage::query()->where('applicant_id', $applicant->id)->whereNot('status', 1)->count();
        }else{
            $messagesCount = 0;
        }

        return view('components.applicant-component', compact('applicant', 'messagesCount'));
    }
}
