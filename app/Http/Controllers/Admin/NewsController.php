<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Models\Category;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::query()->orderByDesc('id')->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::query()->pluck('title', 'id')->all();
        $tags = Tag::query()->pluck('title', 'id')->all();
        return view('admin.news.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewsRequest $request)
    {
        $validated = $request->validated();
        if (isset($validated['image']) && $validated['image']->isValid()) {
            $image = $validated['image'];
            $uploadPath = public_path('uploads/news');
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            $filename = time() . '_' . uniqid() . '.webp';
            $path = $uploadPath . '/' . $filename;
            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);
            $img->cover(531, 354);
            $img->toWebp(80);
            $img->save($path);
            $validated['image'] = 'uploads/news/' . $filename;
        }
        $news = News::create($validated);
        if (!empty($validated['tags'])) {
            $news->getTags()->attach($validated['tags']);
        }
        return redirect()->route('news.index')->with('success', 'Новость успешно создана');
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
        $news = News::query()->findOrFail($id);
        $news->load('tags');
        $categories = Category::query()->pluck('title', 'id')->all();
        $tags = Tag::query()->pluck('title', 'id')->all();
        return view('admin.news.edit', compact('news', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NewsRequest $request, string $id)
    {
        $news = News::findOrFail($id);
        $validated = $request->validated();

        if (isset($validated['image']) && $validated['image']->isValid()) {
            $image = $validated['image'];
            $uploadPath = public_path('uploads/news');

            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $filename = time() . '_' . uniqid() . '.webp';
            $path = $uploadPath . '/' . $filename;

            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);
            $img->cover(531, 354);
            $img->toWebp(80);
            $img->save($path);

            if ($news->image && file_exists(public_path($news->image))) {
                unlink(public_path($news->image));
            }

            $validated['image'] = 'uploads/news/' . $filename;
        } else {
            $validated['image'] = $news->image;
        }
        $news->update($validated);
        $news->getTags()->sync($validated['tags'] ?? []);
        return redirect()->route('news.index')->with('success', 'Новость успешно обновлена');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $news = News::findOrFail($id);
        if ($news->image && file_exists(public_path($news->image))) {
            unlink(public_path($news->image));
        }
        $news->getTags()->sync([]);
        $news->delete();
        return redirect()->route('news.index')->with('success', 'Новость успешно удалена');
    }
}
