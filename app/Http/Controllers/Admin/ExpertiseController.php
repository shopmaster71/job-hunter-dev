<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expertise;
use Illuminate\Http\Request;

class ExpertiseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expertise = Expertise::all();
        return view('admin.expertise.index', compact('expertise'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.expertise.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);
        Expertise::create($validated);
        return redirect()->route('expertise.index')->with('success', 'Опыт работы добавлен');
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
        $expertise = Expertise::findOrFail($id);
        return view('admin.expertise.edit', compact('expertise'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);
        $expertise = Expertise::findOrFail($id);
        $expertise->update($validated);
        return redirect()->route('expertise.index')->with('success', 'Опыт работы изменён');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $expertise = Expertise::findOrFail($id);
        $expertise->delete();
        return redirect()->route('expertise.index')->with('success', 'Опыт работы удалён');
    }
}
