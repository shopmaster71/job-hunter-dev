<?php

namespace App\Http\Controllers;

use App\Http\Requests\AgencyMessageRequest;
use App\Mail\MessageAgency;
use App\Mail\MessageHr;
use App\Models\Agency;
use App\Models\AgencyMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AgencyMessageController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $messages = AgencyMessage::query()->where('agency_id', auth()->user()->agency->id)->orderByDesc('id')->paginate(24);
        return view('agency-message.index', compact('messages'));
    }

    /**
     * @param AgencyMessageRequest $request
     * @param string $agency
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(AgencyMessageRequest $request,  string $agency)
    {
        $validated = $request->validated();
        $agency = Agency::query()->findOrFail($agency);
        $validated['agency_id'] = $agency->id;
        AgencyMessage::query()->create($validated);
        $data = [
            'title' => $agency->title,
            'email' => $validated['email'],
            'theme' => $validated['theme'],
        ];
        try {
            Mail::to($agency->email)->send(new MessageAgency($data));
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
        $message = AgencyMessage::query()->findOrFail($id);
        $message->update([
            'status' => 1
        ]);
        return view('agency-message.show', compact('message'));
    }
}
