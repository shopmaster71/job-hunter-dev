<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserPhotoController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function media(Request $request)
    {
        if (!$request->hasFile('image')) {
            return response()->json(['error' => 'Файл не отправлен'], 400);
        }
        $file = $request->file('image');
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Пользователь не авторизован'], 401);
        }
        $oldPhoto = Photo::where('user_id', $user->id)->first();
        if ($oldPhoto) {
            $oldPath = public_path($oldPhoto->photo);
            if (file_exists($oldPath)) {
                File::delete($oldPath);
            }
            $oldPhoto->delete();
        }
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $path = 'uploads/photos/' . $filename;
        $file->move(public_path('uploads/photos'), $filename);
        $photo = Photo::create([
            'user_id' => $user->id,
            'photo' => '/' . $path,
        ]);
        return response()->json([
            'url' => '/' . $path,
            'photo_id' => $photo->id,
            'message' => 'Фото успешно обновлено'
        ]);
    }
}
