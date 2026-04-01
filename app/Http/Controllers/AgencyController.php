<?php

namespace App\Http\Controllers;

use App\Http\Requests\AgencyInformationRequest;
use App\Http\Requests\AgencyRequest;
use App\Models\Agency;
use App\Models\AgencyInformation;
use App\Models\City;
use App\Models\Vacancy;
use App\Services\CityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;

class AgencyController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $agency = Agency::whereUserId(Auth::id())->first();
        $cities = Cache::remember('cities_list', 3600, fn () => City::limit(10)->get());
        return view('agency.index', compact('agency', 'cities'));
    }

    /**
     * @param AgencyRequest $request
     * @param CityService $cityService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(AgencyRequest $request, CityService $cityService)
    {
        $validated = $request->validated();
        if (!$cityService->exists($validated['city_name'])) {
            return back()->withErrors([
                'city_name' => 'Указанного города не существует. Выберите из списка.'
            ])->withInput();
        }
        $validated['user_id'] = Auth::id();
        //dd($validated);
        Agency::create($validated);
        return back()->with('success', 'Контактные данные агентства успешно добавлены');
    }

    /**
     * @param Agency $agency
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Agency $agency)
    {
        if(Gate::denies('update-agency', $agency)){
            abort(403);
        }
        $cities = City::limit(10)->get();
        return view('agency.edit', compact('agency', 'cities'));
    }

    /**
     * @param AgencyRequest $request
     * @param Agency $agency
     * @param CityService $cityService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AgencyRequest $request, Agency $agency, CityService $cityService)
    {
        if ($agency->user_id !== Auth::id()) {
            abort(403, 'Доступ запрещён');
        }
        $validated = $request->validated();
        if (!$cityService->exists($validated['city_name'])) {
            return back()->withErrors([
                'city_name' => 'Указанного города не существует. Выберите из списка.'
            ])->withInput();
        }
        $agency->update($validated);
        return redirect()->route('agency.index')->with('success', 'Контактные данные агентства обновлены');
    }

    /**
     * @param AgencyInformationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createInformation(AgencyInformationRequest $request)
    {
        $validated = $request->validated();
        if(isset( Auth::user()->agency->id)){
            $validated['agency_id'] = Auth::user()->agency->id;
        }else{
            return back()->with('error', 'Заполните контактные данные агентства!');
        }
        AgencyInformation::create($validated);
        return back()->with('success', 'Профессиональная информация добавлена');
    }

    /**
     * @param Agency $agency
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function informationEdit(Agency $agency)
    {
        return view('agency.edit-information', compact('agency'));
    }

    /**
     * @param AgencyInformationRequest $request
     * @param Agency $agency
     * @return \Illuminate\Http\RedirectResponse
     */
    public function informationUpdate(AgencyInformationRequest $request, Agency $agency)
    {
        $validated = $request->validated();
        $agency->getInformation()->update($validated);
        return redirect()->route('agency.index')->with('success', 'Профессиональная информация обновлена');
    }

    /**
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function profile(string $slug)
    {
        $agency = Agency::query()->where('slug', $slug)->firstOrFail();
        $vacancies = Vacancy::query()->where('author_id', $agency->user_id)->where('status', 0)->orderByDesc('id')->paginate(10);
        return view('agency.profile', compact('agency', 'vacancies'));
    }


}
