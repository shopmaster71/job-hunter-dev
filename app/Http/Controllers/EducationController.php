<?php

namespace App\Http\Controllers;

use App\Http\Requests\EducationRequest;
use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $educations = Education::query()->where('applicant_id', Auth::user()->applicant()->first()->id)->get();
        return view('education.index', compact('educations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('education.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EducationRequest $request)
    {
        $validated = $request->validated();
        $validated['applicant_id'] = Auth::user()->applicant()->first()->id;
        Education::query()->create($validated);
        return redirect()->route('education.index')->with('success', 'Учебное заведение добавлено');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $education = Education::query()->findOrFail($id);
        return view('education.update', compact('education'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EducationRequest $request, string $id)
    {
        $validated = $request->validated();
        $validated['present'] = $validated['present']??false;
        Education::query()->findOrFail($id)->update($validated);
        return redirect()->route('education.index')->with('success', 'Учебное заведение обновлено');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
