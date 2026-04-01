<?php

namespace App\View\Components;

use App\Models\ApplicantMessage;
use App\Models\Response;
use App\Models\Resume;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class CountsApplicant extends Component
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
        $responses = Response::query()->where('applicant_id', Auth::user()->applicant?->id)->count();
        $messagesCount = ApplicantMessage::query()->where('applicant_id', Auth::user()->applicant?->id)->count();
        $resume = Resume::query()->where('applicant_id', Auth::user()->applicant?->id)->count();
        return view('components.counts-applicant', compact('responses', 'messagesCount', 'resume'));
    }
}
