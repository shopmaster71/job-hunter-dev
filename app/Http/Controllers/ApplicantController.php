<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicantContactRequest;
use App\Http\Requests\ApplicantRequest;
use App\Models\Applicant;
use App\Models\ApplicantContact;
use App\Models\City;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Photo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use App\Services\CityService;

class ApplicantController extends Controller
{
    /**
     * Show applicant`s information form
     * @return View
     */
    public function index():View
    {
        $user = auth()->user();
        $level = 20;
        $photo = Photo::query()->where('user_id', $user->id)->first();
        $applicant = Applicant::query()->where('user_id', $user->id)->first();
        if ($applicant) {
            $contact = ApplicantContact::query()->where('applicant_id', $applicant->id)->first();
            $experiences = Experience::query()->where('applicant_id', $applicant->id)->get();
            $educations = Education::query()->where('applicant_id', $applicant->id)->get();
            $level += 15;
            if($contact){
                $level += 15;
            }
            if($experiences){
                $level +=  count($experiences) * 10;
            }
            if($educations){
                $level += count($educations) * 10;
            }
            if($photo){
                $level += 10;
            }

        }else{
            $applicant = null;
            $contact = null;
            $experiences = [];
            $educations = [];
        }
        if($level > 100){
            $level = 100;
        }
        $cities = Cache::remember('cities_list', 3600, fn () => City::limit(10)->get());

        return view('applicant.index', compact('user', 'applicant', 'contact', 'level', 'experiences', 'educations', 'cities'));
    }

    /**
     * Create applicant
     * @param ApplicantRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(ApplicantRequest $request, CityService $cityService)
    {
        $validated = $request->validated();
        if (!$cityService->exists($validated['city_name'])) {
            return back()->withErrors([
                'city_name' => 'Указанного города не существует. Выберите из списка.'
            ])->withInput();
        }
        $validated['user_id'] = Auth::id();
        Applicant::create($validated);
        return back()->with('success', 'Личные данные соискателя добавлены');
    }



    /**
     * @param Applicant $applicant
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Applicant $applicant)
    {
        if(Gate::denies('update-applicant', $applicant)){
            abort(403);
        }
        $cities = City::limit(10)->get();
        return view('applicant.edit', compact('applicant', 'cities'));
    }

    /**
     * @param ApplicantRequest $request
     * @param Applicant $applicant
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ApplicantRequest $request, Applicant $applicant, CityService $cityService)
    {
        $validated = $request->validated();

        if (!$cityService->exists($validated['city_name'])) {
            return back()->withErrors([
                'city_name' => 'Указанного города не существует. Выберите из списка.'
            ])->withInput();
        }
        $validated['driving_licence'] = $validated['driving_licence'] ?? false;
        $validated['married'] = $validated['married'] ?? false;
        $validated['children'] = $validated['children'] ?? false;
        $applicant->update($validated);
        return redirect()->route('applicant.index')->with('success', 'Личная информация обновлена');
    }

    /**
     * @param ApplicantContactRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function contactCreate(ApplicantContactRequest $request)
    {
        $validated = $request->validated();
        if(isset( Auth::user()->applicant->id)){
            $validated['applicant_id'] = Auth::user()->applicant->id;
        }else{
            return back()->with('error', 'Заполните личную информацию');
        }

        ApplicantContact::create($validated);
        return back()->with('success', 'Контакты соискателя добавлены');
    }

    /**
     * @param Applicant $applicant
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function contactEdit(Applicant $applicant)
    {
        return view('applicant.edit-contact', compact('applicant'));
    }

    /**
     * @param ApplicantContactRequest $request
     * @param Applicant $applicant
     * @return \Illuminate\Http\RedirectResponse
     */
    public function contactUpdate(ApplicantContactRequest $request, Applicant $applicant)
    {
        $validated = $request->validated();
        $validated['vk_check'] = $validated['vk_check'] ?? false;
        $validated['telegram_check'] = $validated['telegram_check'] ?? false;
        $applicant->getContact()->update($validated);
        return redirect()->route('applicant.index')->with('success', 'Контактная информация обновлена');
    }

    /**
     * @param string $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function profile(string $slug)
    {
        $applicant = Applicant::query()->where('slug', $slug)->with('getPhoto')->firstOrFail();
        $birth = Carbon::parse($applicant->birth_date)->age;
        return view('applicant.profile', compact('applicant', 'birth'));
    }
}
