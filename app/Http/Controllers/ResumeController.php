<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResumeRequest;
use App\Models\Applicant;
use App\Models\Resume;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResumeController extends Controller
{
    public function index()
    {
        $applicantId = Auth::user()->applicant->id;

        $activeResumes = Resume::query()
            ->where('applicant_id', $applicantId)
            ->where('status', 0)
            ->orderByDesc('id')
            ->get();

        $archivedResumes = Resume::query()
            ->where('applicant_id', $applicantId)
            ->where('status', 10)
            ->orderByDesc('id')
            ->get();
        return view('applicant.resume.index', compact('activeResumes', 'archivedResumes'));
    }

    public function create()
    {
        return view('applicant.resume.create');
    }

    public function store(ResumeRequest $request)
    {
        $validated = $request->validated();
        if(isset( Auth::user()->applicant->id)){
            $validated['applicant_id'] = Auth::user()->applicant->id;
        }else{
            return back()->with('error', 'Заполните личную информацию');
        }
        Resume::create($validated);
        return redirect()->route('resume.index')->with('success', 'Ваше резюме успешно создано!');
    }

    public function edit(Resume $resume)
    {
        return view('applicant.resume.edit', compact('resume'));
    }

    public function update(Resume $resume, ResumeRequest $request)
    {
        $validated = $request->validated();
        $resume->update($validated);
        return redirect()->route('resume.index')->with('success', 'Ваше резюме успешно обновлено!');
    }

    public function show(Resume $resume)
    {
        $pdf = Pdf::loadView('applicant.resume.template', compact('resume'));
        return $pdf->stream();
    }

    public function download(Resume $resume)
    {
        $pdf = Pdf::loadView('applicant.resume.template', compact('resume'));
        return $pdf->download("resume.pdf");
    }

    public function addInArchive(Resume $resume)
    {
        $resume->update(['status' => 10]);
        return redirect()->route('resume.index')->with('success', 'Резюме перенесено в архив!');
    }

    public function removeInArchive(Resume $resume)
    {
        $resume->update(['status' => 0]);
        return redirect()->route('resume.index')->with('success', 'Резюме извлечено из архива!');
    }
}
