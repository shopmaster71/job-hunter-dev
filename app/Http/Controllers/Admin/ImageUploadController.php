<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ImageUploadController extends Controller
{
    public function uploadImage(Request $request)
    {
        // Принудительно очищаем буфер вывода, если активен
        if (ob_get_level()) {
            ob_end_clean();
        }

        $validator = Validator::make($request->all(), [
            'upload' => 'required|image|max:5120',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        $file = $request->file('upload');
        $filename = 'news_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        $path = public_path('uploads/news');
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0755, true);
        }

        $file->move($path, $filename);

        return response()->json([
            'location' => '/uploads/news/' . $filename
        ])->setEncodingOptions(JSON_UNESCAPED_SLASHES);
    }
}
