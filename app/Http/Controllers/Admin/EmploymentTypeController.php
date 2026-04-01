<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmploymentType;
use Illuminate\Http\Request;

class EmploymentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employmentTypes = EmploymentType::all();
        return view('admin.employment-type.index', compact('employmentTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.employment-type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);
        EmploymentType::create($validated);
        return redirect()->route('employment-types.index')->with('success','Тип занятости успешно добавлен!');
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
        $employmentType = EmploymentType::findOrFail($id);
        return view('admin.employment-type.edit', compact('employmentType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);
        $employmentType = EmploymentType::findOrFail($id);
        $employmentType->update($validated);
        return redirect()->route('employment-types.index')->with('success','Тип занятости успешно изменён!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employmentType = EmploymentType::findOrFail($id);
        $employmentType->delete();
        return redirect()->route('employment-types.index')->with('success','Тип занятости успешно удалён!');
    }
}
