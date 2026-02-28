<?php

namespace App\Http\Controllers;

use App\Http\Requests\HrMessageRequest;
use App\Mail\MessageApplicant;
use App\Mail\MessageHr;
use App\Models\HeadHunter;
use App\Models\HrMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Termwind\Components\Hr;

class HrMessageController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $messages = HrMessage::query()->where('head_hunter_id', auth()->user()->hr->id)->orderByDesc('id')->paginate(24);
        return view('hr-message.index', compact('messages'));
    }

    /**
     * @param HrMessageRequest $request
     * @param string $hr
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(HrMessageRequest $request, string $hr)
    {
        $validated = $request->validated();
        $hr = HeadHunter::query()->findOrFail($hr);
        $validated['head_hunter_id'] = $hr->id;
        HrMessage::query()->create($validated);
        $data = [
            'name' => $hr->name.' '.$hr->surname,
            'email' => $validated['email'],
            'theme' => $validated['theme'],
        ];
        try {
            Mail::to($hr->getUser->email)->send(new MessageHr($data));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
        return back()->with('success', 'Сообщение отправлено');
    }

    /**
     * @param string $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(string $id)
    {
        $message = HrMessage::query()->findOrFail($id);
        $message->update([
            'status' => 1
        ]);
        return view('hr-message.show', compact('message'));
    }
}
