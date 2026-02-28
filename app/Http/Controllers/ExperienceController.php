<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExperienceRequest;
use App\Models\Applicant;
use App\Models\ApplicantContact;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $experiences = Experience::query()->where('applicant_id', Auth::user()->applicant()->first()->id)->get();
        return view('experience.index', compact('experiences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('experience.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExperienceRequest $request)
    {
        $validated = $request->validated();
        $validated['applicant_id'] = Auth::user()->applicant()->first()->id;
        Experience::query()->create($validated);
        return redirect()->route('experience.index')->with('success', 'Место работы добавлено');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $experience = Experience::query()->findOrFail($id);
        return view('experience.update', compact('experience'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExperienceRequest $request, string $id)
    {
        $validated = $request->validated();
        $validated['present'] = $validated['present']??false;
        $experience = Experience::query()->findOrFail($id);
        $experience->update($validated);
        return redirect()->route('experience.index')->with('success', 'Место работы обновлено');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
