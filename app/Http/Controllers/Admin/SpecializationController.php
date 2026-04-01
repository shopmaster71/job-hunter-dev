<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GroupIndustry;
use App\Models\Specialization;
use Illuminate\Http\Request;

class SpecializationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $specializations = Specialization::query()->orderByDesc('industry_id')->paginate(50);
        return view('admin.specializations.index', compact('specializations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $industries = GroupIndustry::all();
        return view('admin.specializations.create', compact('industries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'industry_id' => 'required|integer',
            'title' => 'required|string|max:255',
        ]);
       // dd($validated);
        Specialization::create($validated);
        return redirect()->route('specializations.index')->with('success', 'Специализация успешно добавлена');
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
        $specialization = Specialization::query()->findOrFail($id);
        $industries = GroupIndustry::all();
        return view('admin.specializations.edit', compact('specialization', 'industries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'industry_id' => 'required|integer',
            'title' => 'required|string|max:255',
        ]);
        $specialization = Specialization::query()->findOrFail($id);
        $specialization->update($validated);
        return redirect()->route('specializations.index')->with('success', 'Специализация успешно измененa');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $specialization = Specialization::query()->findOrFail($id);
        $specialization->delete();
        return redirect()->route('specializations.index')->with('success', 'Специализация успешно удалена');
    }
}
