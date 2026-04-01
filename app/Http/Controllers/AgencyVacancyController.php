<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployerVacancyRequest;
use App\Models\Agency;
use App\Models\City;
use App\Models\Employer;
use App\Models\EmploymentType;
use App\Models\Expertise;
use App\Models\Format;
use App\Models\GroupIndustry;
use App\Models\Schedule;
use App\Models\Specialization;
use App\Models\Vacancy;
use App\Services\CityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;

class AgencyVacancyController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $vacancies = Vacancy::query()->where('author_id', Auth::id())->where('status', 0)->orderByDesc('id')->paginate(10);
        return view('agency.vacancies.index', compact('vacancies'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $industries = Cache::remember('group_industries', 3600, fn () => GroupIndustry::all());

        // Группируем специализации по industry_id
        $specializationsByIndustry = Specialization::all()->groupBy('industry_id')->map(function ($group) {
            return $group->toArray();
        })->toArray();

        $specializations = Cache::remember('specializations', 3600, fn () => Specialization::all());
        $employmentTypes = Cache::remember('employment_types', 3600, fn () => EmploymentType::all());
        $schedules = Cache::remember('schedules', 3600, fn () => Schedule::all());
        $expertises = Cache::remember('expertises', 3600, fn () => Expertise::all());
        $formats = Cache::remember('formats', 3600, fn () => Format::all());
        $cities = Cache::remember('cities_list', 3600, fn () => City::limit(10)->get());
        return view('agency.vacancies.create', compact(
            'cities',
            'industries',
            'specializations',
            'specializationsByIndustry',
            'employmentTypes',
            'schedules',
            'expertises',
            'formats'));
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
        return redirect()->route('agency.vacancies.index')->with('success', 'Вакансия успешно добавлена');
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
        $industries = Cache::remember('group_industries', 3600, fn () => GroupIndustry::all());
        $specializations = $vacancy->industry_id
            ? Cache::remember("specializations_{$vacancy->industry_id}", 3600, fn () => Specialization::where('industry_id', $vacancy->industry_id)->get())
            : collect();
        $employmentTypes = Cache::remember('employment_types', 3600, fn () => EmploymentType::all());
        $schedules = Cache::remember('schedules', 3600, fn () => Schedule::all());
        $expertises = Cache::remember('expertises', 3600, fn () => Expertise::all());
        $formats = Cache::remember('formats', 3600, fn () => Format::all());
       return view('agency.vacancies.edit', compact('vacancy', 'cities', 'industries','specializations', 'employmentTypes', 'schedules', 'expertises', 'formats'));
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
        return redirect()->route('agency.vacancies.index')->with('success', 'Вакансия успешно обновленa');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function archiveList()
    {
        $vacancies = Vacancy::query()->where('author_id', Auth::id())->where('status', 10)->orderByDesc('id')->paginate(20);
        return view('agency.vacancies.archive', compact('vacancies'));
    }
}
