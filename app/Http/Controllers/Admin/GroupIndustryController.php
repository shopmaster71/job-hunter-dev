<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GroupIndustry;
use Illuminate\Http\Request;

class GroupIndustryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groupIndustries = GroupIndustry::all();
        return view('admin.group_industries.index', compact('groupIndustries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.group_industries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);
        GroupIndustry::create($validated);
        return redirect()->route('industry-groups.index')->with('success','Группа отраслей успешно добавлена!');
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
        $groupIndustry = GroupIndustry::query()->findorfail($id);
        return view('admin.group_industries.edit', compact('groupIndustry'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);
        $groupIndustry = GroupIndustry::query()->findorfail($id);
        $groupIndustry ->update($validated);
        return redirect()->route('industry-groups.index')->with('success','Группа отраслей успешно изменена!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $groupIndustry = GroupIndustry::query()->findorfail($id);
        $groupIndustry ->delete();
        return redirect()->route('industry-groups.index')->with('success','Группа отраслей успешно удалена!');
    }
}
