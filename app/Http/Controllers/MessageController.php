<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Mail\MessageApplicant;
use App\Models\Applicant;
use App\Models\ApplicantMessage;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $messages = ApplicantMessage::query()->where('applicant_id', auth()->user()->applicant->id)->orderByDesc('id')->paginate(64);
        $responses = Response::query()->where('applicant_id', auth()->user()->applicant->id)->orderByDesc('id')->paginate(64);
        return view('message.index', compact('messages', 'responses'));
    }

    /**
     * @param MessageRequest $request
     * @param string $applicant
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(MessageRequest $request, string $applicant)
    {
        $validated = $request->validated();
        $applicant = Applicant::query()->findOrFail($applicant);
        $validated['applicant_id'] = $applicant->id;
        ApplicantMessage::query()->create($validated);
        $data = [
            'name' => $applicant->name.' '.$applicant->surname,
            'email' => $validated['email'],
        ];
        try {
            Mail::to($applicant->getContact->email)->send(new MessageApplicant($data));
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
        $message = ApplicantMessage::query()->findOrFail($id);
        $message->update([
            'status' => 1
        ]);
        return view('message.show', compact('message'));
    }

    public function responseShow(string $id)
    {
        $response = Response::query()->findOrFail($id);
        return view('message.response', compact('response'));
    }
}
