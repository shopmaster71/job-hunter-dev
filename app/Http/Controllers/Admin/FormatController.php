<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Format;
use Illuminate\Http\Request;

class FormatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $formats = Format::all();
        return view('admin.formats.index', compact('formats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.formats.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);
        Format::create($validated);
        return redirect()->route('formats.index')->with('success', 'Формат работы добавлен');
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
        $format = Format::findOrFail($id);
        return view('admin.formats.edit', compact('format'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);
        $format = Format::findOrFail($id);
        $format->update($validated);
        return redirect()->route('formats.index')->with('success', 'Формат работы изменен');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $format = Format::findOrFail($id);
        $format->delete();
        return redirect()->route('formats.index')->with('success', 'Формат работы удалён');
    }
}
