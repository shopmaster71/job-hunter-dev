<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::query()->orderByDesc('page_id')->get();
        return view('admin.question.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pages = Page::all();
        return view('admin.question.create', compact('pages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'page_id' => 'required|integer|exists:pages,id',
            'question' => 'required|string',
            'answer' => 'required|string'
        ]);
        Question::create($validated);
        return redirect()->route('questions.index')->with('success', 'Вопрос-ответ добавлен');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $question = Question::query()->findOrFail($id);
        $pages = Page::all();
        return view('admin.question.edit', compact('question', 'pages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'page_id' => 'required|integer|exists:pages,id',
            'question' => 'required|string',
            'answer' => 'required|string'
        ]);
        $question = Question::query()->findOrFail($id);
        $question->update($validated);
        return redirect()->route('questions.index')->with('success', 'Вопрос-ответ обновлён');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $question = Question::query()->findOrFail($id);
        $question->delete();
        return redirect()->route('questions.index')->with('success', 'Вопрос-ответ удалён');
    }
}
