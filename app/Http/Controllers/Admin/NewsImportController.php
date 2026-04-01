<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class NewsImportController extends Controller
{
    public function fetch()
    {
        $sources = [
            'https://habr.com/ru/rss/hubs/career/',
            'https://vc.ru/rss/tag/работа',
        ];

        $categories = Category::all();
        $tags = Tag::all();
        $items = [];

        foreach ($sources as $url) {
            $response = Http::withUserAgent('JobHunter Bot')->get($url);
            if (!$response->successful()) continue;
            $rss = @simplexml_load_string($response->body(), 'SimpleXMLElement', LIBXML_NOCDATA);
            if (!$rss) continue;
            foreach ($rss->channel->item as $item) {
                $image = $this->extractImageFromRssItem($item, $url);
                $items[] = [
                    'title' => (string)$item->title,
                    'link' => (string)$item->link,
                    'description' => strip_tags((string)$item->description),
                    'content' => Str::limit(strip_tags((string)$item->description), 500),
                    'source' => parse_url($url, PHP_URL_HOST),
                    'image' => $image,
                ];
            }
        }

        return view('admin.news.fetch', compact('items', 'categories', 'tags'));
    }

    /**
     * Извлечение изображения из RSS-элемента
     */
    private function extractImageFromRssItem($item, string $sourceUrl): ?string
    {
        $image = null;

        if (isset($item->children('media', true)->thumbnail)) {
            $image = (string)$item->children('media', true)->thumbnail->attributes()->url;
        }

        if (!$image && isset($item->enclosure)) {
            $enclosure = $item->enclosure;
            $type = (string)$enclosure->attributes()->type;
            $url = (string)$enclosure->attributes()->url;
            if (str_starts_with($type, 'image/')) {
                $image = $url;
            }
        }

        if (!$image) {
            $description = (string)$item->description;
            if (preg_match('/<img[^>]+src=["\']([^"\']+)["\']/i', $description, $matches)) {
                $image = $matches[1];
            }
        }

        if ($image && !filter_var($image, FILTER_VALIDATE_URL)) {
            $base = preg_replace('#/[^/]*$#', '/', $sourceUrl);
            $image = rtrim($base, '/') . '/' . ltrim($image, '/');
        }
        return $image;
    }

    public function import(Request $request)
    {
        $validated = $request->validate([
            'selected' => 'required|array',
            'selected.*.title' => 'required|string',
            'selected.*.link' => 'required|url',
            'selected.*.content' => 'required|string',
            'selected.*.source' => 'required|string',
            'selected.*.category_id' => 'nullable|exists:categories,id',
            'selected.*.tags' => 'array|exists:tags,id',
        ]);

        $imported = 0;
        foreach ($request->selected as $data) {
            if (!isset($data['import']) || News::where('source_url', $data['link'])->exists()) {
                continue;
            }

            $imagePath = null;
            $imageUrl = $data['image'] ?? null;

            if ($imageUrl) {
                try {
                    $fileContent = @file_get_contents($imageUrl);
                    if ($fileContent) {
                        $filename = 'news_' . time() . '_' . uniqid() . '.' . pathinfo($imageUrl, PATHINFO_EXTENSION);

                        $uploadPath = public_path('uploads/news');
                        if (!is_dir($uploadPath)) {
                            mkdir($uploadPath, 0755, true);
                        }

                        $filePath = $uploadPath . '/' . $filename;
                        file_put_contents($filePath, $fileContent);

                        $imagePath = '/uploads/news/' . $filename;
                    }
                } catch (\Exception $e) {
                    \Log::warning('Не удалось скачать изображение: ' . $imageUrl, ['exception' => $e]);
                }
            }

            $news = News::create([
                'title' => $data['title'],
                'content' => $data['content'],
                'source' => $data['source'],
                'source_url' => $data['link'],
                'image' => $imagePath,
                'category_id' => $data['category_id'],

            ]);

           if (!empty($data['tags'])) {
                $news->getTags()->attach($data['tags']);
            }

            $imported++;
        }

        return redirect()->route('news.index')->with([
            'success' => "Импортировано $imported новостей"
        ]);
    }


    public function uploadImage(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|max:5120' // до 5 МБ
        ]);

        $file = $request->file('upload');
        $filename = 'news_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        $path = public_path('uploads/news');
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }

        $file->move($path, $filename);

        return response()->json([
            'url' => '/uploads/news/' . $filename
        ]);
    }
}
