<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\Response;
use Illuminate\Http\Request;

class EmployerResponseController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $employer = Employer::query()->where('user_id', auth()->id())->first();
        $responses = Response::query()->where('author_id', $employer->user_id)->orderByDesc('id')->paginate(50);
        return view('employer.responses.index', compact('responses'));
    }

    /**
     * @param Response $response
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Response $response)
    {
        $response->update(['status' => 1]);
        return view('employer.responses.show', compact('response'));
    }
}
