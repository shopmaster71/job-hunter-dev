<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show($slug)
    {
        $page = Page::query()->where('slug', $slug)->firstOrFail();
        return view("page.show", compact('page'));
    }
}
