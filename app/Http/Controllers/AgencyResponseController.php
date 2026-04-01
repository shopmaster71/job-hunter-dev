<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\Response;
use Illuminate\Http\Request;

class AgencyResponseController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $agency = Agency::query()->where('user_id', auth()->id())->first();
        $responses = Response::query()->where('author_id', $agency->user_id)->orderByDesc('id')->paginate(50);
        return view('agency.responses.index', compact('responses'));
    }

    /**
     * @param Response $response
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Response $response)
    {
        $response->update(['status' => 1]);
        return view('agency.responses.show', compact('response'));
    }
}
