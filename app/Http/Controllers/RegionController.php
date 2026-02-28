<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RegionController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'city' => 'required|string|max:255',
            'region_name' => 'nullable|string|max:255',
            'region_code' => 'nullable|string|max:10',
        ]);


        Session::put([
            'user_city' => $request->city,
            'user_region_name' => $request->region_name ?? $request->city,
            'user_region_code' => $request->region_code ?? '',
        ]);

        return redirect()->back()->with('success', 'Город изменён');
    }
}
