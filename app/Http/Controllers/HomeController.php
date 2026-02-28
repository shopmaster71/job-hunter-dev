<?php

namespace App\Http\Controllers;



use App\Models\HeadHunter;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $hrs = HeadHunter::all();
        return view('home', compact('hrs'));
    }
}
