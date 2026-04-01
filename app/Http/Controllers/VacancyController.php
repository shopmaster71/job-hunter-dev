<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResponseRequest;
use App\Mail\MessageAgency;
use App\Mail\ResponseToVakancy;
use App\Models\Agency;
use App\Models\Employer;
use App\Models\Response;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class VacancyController extends Controller
{
    /**
     * @param string $lug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(string $slug)
    {
        $vacancy = Vacancy::query()->with([
            'getAuthor',
            'getIndustry',
            'getSpecialization',
            'getEmploymentType',
            'getSchedule',
            'getExpertise',
            'getFormat'
        ])
            ->where('slug', $slug)
            ->where('status', 0)
            ->first();
        $user = User::query()->where('id', $vacancy->author_id)->first();
        if($user->role == 2){
            $author = Employer::query()->where('user_id', $user->id)->first();
        }else{
            $author = Agency::query()->where('user_id', $user->id)->first();
        }
        //$author = $vacancy->author;
        $similar = Vacancy::query()
            ->where('id', '!=', $vacancy->id)
            ->where('position', 'like', "%{$vacancy->position}%")
            ->limit(3)
            ->get();
        return view('vacancy.show', compact('vacancy','author', 'similar'));
    }

    /**
     * @param string $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addInArchive(string $slug)
    {
        $vacancy = Vacancy::where('slug', $slug)->first();
        $vacancy->update(['status' => 10]);
        return redirect()->back()->with('success', 'Вакансия успешно архивирована');
    }

    /**
     * @param string $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeInArchive(string $slug)
    {
        $vacancy = Vacancy::where('slug', $slug)->first();
        $vacancy->update(['status' => 0]);
        return redirect()->back()->with('success', 'Вакансия успешно извлечена из архива');
    }

    /**
     * @param ResponseRequest $request
     * @param Vacancy $vacancy
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ResponseRequest $request, Vacancy $vacancy)
    {
        $validated = $request->validated();
        $uploadPath = 'uploads/resumes/';
        $resumePath = '';
        if ($request->hasFile('resume')) {
            $file = $request->file('resume');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path($uploadPath), $filename);
            $resumePath = '/' . $uploadPath . $filename;
        }
        $validated['applicant_id'] = Auth::user()->applicant->id;
        $validated['vacancy_id'] = $vacancy->id;
        $validated['author_id'] = $vacancy->author_id;
        $validated['position'] = $vacancy->position;
        $validated['organization'] = $vacancy->organization;
        $validated['resume'] = $resumePath;
        $response = Response::create($validated);
        try {
            Mail::to($vacancy->getAuthor->email)->send(new ResponseToVakancy([
                'resume' => $response->resume,
                'applicant_name' => $response->getApplicant->name,
                'applicant_surname' => $response->getApplicant->surname,
                'position' => $response->position
            ]));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
        return redirect()->back()->with('success', 'Отклик на вакансию отправлен');
    }

    public function vacancyList()
    {
        $city = session('user_city');
        //dd($city);
        $vacancies = Vacancy::query()
            ->where('status', 0)
            ->where('city_name', '=', $city)
            ->paginate(10);
        return view('vacancy.list', compact('vacancies'));
    }
}
