<?php

namespace App\Http\Controllers;

use App\Http\Requests\HrInformationRequest;
use App\Http\Requests\HrRequest;
use App\Models\City;
use App\Models\HeadHunter;
use App\Models\HrInformation;
use App\Models\Photo;
use App\Models\User;
use App\Services\CityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;


class HrController extends Controller
{
    /**
     * Show applicant`s information form
     * @return View
     */
    public function index():View
    {
        $user = auth()->user();
        $level = 15;
        $photo = Photo::query()->where('user_id', $user->id)->first();
        if($photo){
            $level += 20;
        }
        $hr = HeadHunter::query()->where('user_id', $user->id)->first();
        if ($hr) {
            $level += 30;
            $hrInformation = HrInformation::query()->where('head_hunter_id', $hr->id)->first();
            if ($hrInformation) {
                $level += 35;
            }
        }else{
            $hrInformation = null;
        }
        if($level > 100){
            $level = 100;
        }
        $cities = City::limit(10)->get();
        return view('hr.index', compact('user', 'hr', 'level', 'photo', 'hrInformation', 'cities'));
    }

    /**
     * @param HrRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(HrRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();
        HeadHunter::query()->create($validated);
        return back()->with('success', 'Личные данные HR-менеджера добавлены');
    }

    /**
     * @param HeadHunter $hr
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(HeadHunter $hr)
    {
        if(Gate::denies('update-hr', $hr)){
            abort(403);
        }
        return view('hr.edit', compact('hr'));
    }

    /**
     * @param HrRequest $request
     * @param HeadHunter $hr
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(HrRequest $request, HeadHunter $hr)
    {
        $validated = $request->validated();
        $hr->update($validated);
        return redirect()->route('hr.index')->with('success', 'Личные данные HR-менеджера обновлены');
    }

    /**
     * @param HrInformationRequest $request
     * @param CityService $cityService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function informationCreate(HrInformationRequest $request, CityService $cityService)
    {
        $validated = $request->validated();
        if (!$cityService->exists($validated['city_name'])) {
            return back()->withErrors([
                'city_name' => 'Указанного города не существует. Выберите из списка.'
            ])->withInput();
        }
        if(isset(Auth::user()->hr->id)){
            $validated['head_hunter_id'] = Auth::user()->hr->id;
        }else{
            return back()->with('error', 'Заполните личную информацию');
        }
        HrInformation::query()->create($validated);
        return back()->with('success', 'Профессиональная информация добавлена');
    }

    /**
     * @param HeadHunter $hr
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function informationEdit(HeadHunter $hr)
    {
        $cities = City::limit(10)->get();
        return view('hr.edit-information', compact('hr', 'cities'));
    }

    /**
     * @param HrInformationRequest $request
     * @param HeadHunter $hr
     * @param CityService $cityService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function informationUpdate(HrInformationRequest $request, HeadHunter $hr, CityService $cityService)
    {
        $validated = $request->validated();
        if (!$cityService->exists($validated['city_name'])) {
            return back()->withErrors([
                'city_name' => 'Указанного города не существует. Выберите из списка.'
            ])->withInput();
        }
        $hr->getInformation->update($validated);
        return redirect()->route('hr.index')->with('success', 'Профессиональная информация обновлена');
    }

    /**
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function headhunter(string $slug)
    {
        $hr = HeadHunter::query()->where('slug', $slug)->firstOrFail();
        return view('hr.profile', compact('hr'));
    }
}
