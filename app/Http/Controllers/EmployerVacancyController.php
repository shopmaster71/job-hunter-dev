<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployerVacancyRequest;
use App\Models\City;
use App\Models\Employer;
use App\Models\Vacancy;
use App\Services\CityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;

class EmployerVacancyController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $vacancies = Vacancy::query()->where('author_id', Auth::id())->orderByDesc('id')->paginate(10);
        return view('employer.vacancies.index', compact('vacancies'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $employer = Employer::whereUserId(Auth::id())->first();
        $cities = Cache::remember('cities_list', 3600, fn () => City::limit(10)->get());
        return view('employer.vacancies.create', compact('employer', 'cities'));
    }

    /**
     * @param EmployerVacancyRequest $request
     * @param CityService $cityService
     * @param Employer $employer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(EmployerVacancyRequest $request, CityService $cityService)
    {
        $validated = $request->validated();
        if (!$cityService->exists($validated['city_name'])) {
            return back()->withErrors([
                'city_name' => 'Указанного города не существует. Выберите из списка.'
            ])->withInput();
        }
        $validated['author_id'] = Auth::id();
        Vacancy::query()->create($validated);
        return redirect()->route('employer.vacancies.index')->with('success', 'Вакансия успешно добавлена');
    }

    /**
     * @param Vacancy $vacancy
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Vacancy $vacancy)
    {
       if(Gate::denies('update-vacancy-employer', $vacancy)){
            abort(403);
        }
        $cities = Cache::remember('cities_list', 3600, fn () => City::limit(10)->get());
        return view('employer.vacancies.edit', compact('vacancy', 'cities'));
    }

    /**
     * @param EmployerVacancyRequest $request
     * @param CityService $cityService
     * @param Vacancy $vacancy
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EmployerVacancyRequest $request, CityService $cityService, Vacancy $vacancy)
    {
        $validated = $request->validated();
        if (!$cityService->exists($validated['city_name'])) {
            return back()->withErrors([
                'city_name' => 'Указанного города не существует. Выберите из списка.'
            ])->withInput();
        }
        $vacancy->update($validated);
        return redirect()->route('employer.vacancies.index')->with('success', 'Вакансия успешно обновленa');
    }
}
