<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggle(Vacancy $vacancy)
    {
        $userId = auth()->id();
        $exists = Favorite::where('user_id', $userId)
            ->where('vacancy_id', $vacancy->id)
            ->exists();
        if ($exists) {
            Favorite::where('user_id', $userId)
                ->where('vacancy_id', $vacancy->id)
                ->delete();
            $message = 'Вакансия удалена из избранного';
        } else {
            Favorite::create([
                'user_id' => $userId,
                'vacancy_id' => $vacancy->id,
            ]);
            $message = 'Вакансия добавлена в избранные';
        }
        return back()->with('success', $message);
    }

    public function list(User $user)
    {
        $favorites = Favorite::query()->where('user_id', Auth::id())->with('vacancy')->paginate(24);
        //dd($vacancies);
        return view('applicant.favorite.list', compact('favorites'));
    }
}
