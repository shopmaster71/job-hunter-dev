<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GroupIndustry;
use App\Models\Industry;
use Illuminate\Http\Request;

class IndustryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $industries = Industry::query()->orderByDesc('group_industries_id')->paginate();
        return view('admin.industries.index', compact('industries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $groups = GroupIndustry::all();
        return view('admin.industries.create', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'group_industries_id' => 'required|integer',
            'title' => 'required|string|max:255',
        ]);
        Industry::create($validated);
        return redirect()->route('industries.index')->with(['success'=>'Отрасль добавлена']);
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
        $groups = GroupIndustry::all();
        $industry = Industry::query()->findOrFail($id);
        return view('admin.industries.edit', compact('groups', 'industry'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'group_industries_id' => 'required|integer',
            'title' => 'required|string|max:255',
        ]);
        $industry = Industry::query()->findOrFail($id);
        $industry->update($validated);
        return redirect()->route('industries.index')->with(['success'=>'Отрасль обновлена']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $industry = Industry::query()->findOrFail($id);
        $industry->delete();
        return redirect()->route('industries.index')->with(['success'=>'Отрасль удалена']);
    }
}
