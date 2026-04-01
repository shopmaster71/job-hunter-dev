<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = City::query()->orderByDesc('id')->paginate();
        return view('admin.city.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.city.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:App\Models\City,name',
            'region_code' => 'required|unique:App\Models\City,region_code',
            'region' => 'required|string|max:255'
        ]);
        City::create($validated);
        return redirect()->route('cities.index')->with('success', 'Город/регион добавлен.');
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
        $city = City::query()->findOrFail($id);
        return view('admin.city.edit', compact('city'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|unique:App\Models\City,name',
            'region_code' => 'required|string',
            'region' => 'required|string|max:255'
        ]);
        $city = City::query()->findOrFail($id);
        $city->update($validated);
        return redirect()->route('cities.index')->with('success', 'Город/регион обновлён.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $city = City::query()->findOrFail($id);
        $city->delete();
        return redirect()->route('cities.index')->with('success', 'Город/регион удалён.');
    }
}
