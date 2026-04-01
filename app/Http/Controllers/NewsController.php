<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
         $news = News::query()->orderByDesc('id')->paginate(7);
         $popularNews = News::orderBy('views', 'desc')->limit(4)->get();
         $freshNews = News::orderBy('created_at', 'desc')->limit(3)->get();
         return view('news.index', compact('news', 'popularNews', 'freshNews'));
    }

    public function show($slug)
    {
        $oneNew = News::query()->where('slug', $slug)->firstOrFail();
        $relatedNews = News::query()
            ->where('id', '!=', $oneNew->id)
            ->where('category_id', $oneNew->category_id)
            ->limit(3)->get();
        $oneNew->increment("views");
        return view('news.show', compact('oneNew', 'relatedNews'));
    }
}
