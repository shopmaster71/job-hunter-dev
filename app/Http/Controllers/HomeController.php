<?php

namespace App\Http\Controllers;



use App\Models\Employer;
use App\Models\HeadHunter;
use App\Models\News;
use App\Models\Vacancy;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $hrs = HeadHunter::all();
        $employers = Employer::query()->orderByDesc('id')->get();
        $vacancies = Vacancy::query()->where('status', 0)->orderByDesc('id')->limit('10')->get();
        $news = News::query()->where('status', 0)->orderByDesc('id')->limit('5')->get();
        return view('home', compact('hrs', 'employers', 'vacancies', 'news'));
    }
}
