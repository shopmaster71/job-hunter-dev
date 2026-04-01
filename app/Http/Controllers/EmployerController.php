<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployerContactRequest;
use App\Http\Requests\EmployerRequest;
use App\Models\City;
use App\Models\Employer;
use App\Models\EmployerContact;
use App\Models\GroupIndustry;
use App\Models\Industry;
use App\Models\Vacancy;
use App\Services\CityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;


class EmployerController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $employer = Employer::whereUserId(Auth::id())->first();
        if($employer){
            $contacts = EmployerContact::query()->where('employer_id', $employer->id)->first();
        }else{
            $contacts = null;
        }
        $industries = GroupIndustry::all();
        $cities = Cache::remember('cities_list', 3600, fn () => City::limit(10)->get());
        return view('employer.index', compact('cities', 'employer', 'contacts', 'industries'));
    }

    /**
     * @param EmployerRequest $request
     * @param CityService $cityService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(EmployerRequest $request, CityService $cityService)
    {
        $validated = $request->validated();
        if (!$cityService->exists($validated['city_name'])) {
            return back()->withErrors([
                'city_name' => 'Указанного города не существует. Выберите из списка.'
            ])->withInput();
        }
        $validated['user_id'] = Auth::id();
        $uploadPath = public_path('uploads/galleries');
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }
        $imagePaths = [];
        if ($request->hasFile('gallery')) {
            $files = $request->file('gallery');
            if (count($files) > 3) {
                return back()->withErrors(['gallery' => 'Можно загрузить не более 3 изображений.'])->withInput();
            }
            foreach ($files as $image) {
                if ($image->isValid()) {
                    $filename = time() . '_' . uniqid() . '.webp';
                    $path = $uploadPath . '/' . $filename;
                    $manager = new ImageManager(new Driver());
                    $img = $manager->read($image);
                    $img->cover(360, 270);
                    $img->toWebp(80);
                    $img->save($path);
                    $imagePaths[] = 'uploads/galleries/' . $filename;
                }
            }
        }
        $validated['gallery'] = !empty($imagePaths) ? json_encode($imagePaths) : null;
        Employer::create($validated);
        return back()->with('success', 'Данные работодателя сохранены');
    }

    /**
     * @param Employer $employer
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Employer $employer)
    {
        if(Gate::denies('update-employer', $employer)){
            abort(403);
        }
        $cities = City::limit(10)->get();
        $industries = GroupIndustry::all();
        return view('employer.edit', compact('employer', 'cities', 'industries'));
    }

    /**
     * @param EmployerRequest $request
     * @param Employer $employer
     * @param CityService $cityService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EmployerRequest $request, Employer $employer, CityService $cityService)
    {
        if ($employer->user_id !== Auth::id()) {
            abort(403, 'Доступ запрещён');
        }
        $validated = $request->validated();
        if (!$cityService->exists($validated['city_name'])) {
            return back()->withErrors([
                'city_name' => 'Указанного города не существует. Выберите из списка.'
            ])->withInput();
        }
        $uploadPath = public_path('uploads/galleries');
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }
        $imagePaths = [];
        $oldGalleryJson = $employer->gallery;
        $clearGallery = $request->input('clear_gallery');
        if ($request->hasFile('gallery') && !$clearGallery) {
            $files = $request->file('gallery');
            if (count($files) > 3) {
                return back()->withErrors(['gallery' => 'Можно загрузить не более 3 изображений.'])->withInput();
            }
            foreach ($files as $image) {
                if ($image->isValid()) {
                    $filename = time() . '_' . uniqid() . '.webp';
                    $path = $uploadPath . '/' . $filename;
                    $manager = new ImageManager(new Driver());
                    $img = $manager->read($image);
                    $img->cover(360, 270);
                    $img->toWebp(80);
                    $img->save($path);
                    $imagePaths[] = 'uploads/galleries/' . $filename;
                }
            }
        }
        if (!$clearGallery && empty($imagePaths)) {
            if ($oldGalleryJson && is_array(json_decode($oldGalleryJson, true))) {
                $imagePaths = json_decode($oldGalleryJson, true);
            }
        }
        $validated['gallery'] = !empty($imagePaths) ? json_encode($imagePaths) : null;
        $employer->update($validated);
        $this->cleanupUnusedImages($oldGalleryJson, $imagePaths);
        return redirect()->route('employer.index')->with('success', 'Данные организации обновлены');
    }

    /**
     * Удаляет изображения из файловой системы, которые есть в старом списке, но отсутствуют в новом.
     *
     * @param string|null $oldGalleryJson Старый JSON-список путей
     * @param array $currentPaths Текущий массив путей
     */
    private function cleanupUnusedImages(?string $oldGalleryJson, array $currentPaths): void
    {
        if (!$oldGalleryJson) {
            return;
        }
        $oldPaths = json_decode($oldGalleryJson, true);
        if (!is_array($oldPaths)) {
            return;
        }
        $currentSet = array_flip($currentPaths);
        foreach ($oldPaths as $path) {
            $fullPath = public_path($path);
            if (!isset($currentSet[$path]) && file_exists($fullPath)) {
                @unlink($fullPath);
            }
        }
    }

    /**
     * @param EmployerContactRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function contactCreate(EmployerContactRequest $request)
    {
        $validated = $request->validated();
        if(isset( Auth::user()->employer->id)){
            $validated['employer_id'] = Auth::user()->employer->id;
        }else{
            return back()->with('error', 'Заполните информацию об организации!');
        }
        EmployerContact::create($validated);
        return back()->with('success', 'Контактная информация добавлена');
    }

    /**
     * @param Employer $employer
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function contactEdit(Employer $employer)
    {
        return view('employer.edit-contact', compact('employer'));
    }

    /**
     * @param EmployerContactRequest $request
     * @param Employer $employer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function contactUpdate(EmployerContactRequest $request, Employer $employer)
    {
        $validated = $request->validated();
        $employer->getContact()->update($validated);
        return redirect()->route('employer.index')->with('success', 'Контактная информация обновлена');
    }

    /**
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function profile(string $slug)
    {
        $employer = Employer::query()->where('slug', $slug)->firstOrFail();
        $vacancies = Vacancy::query()->where('author_id', $employer->user_id)->where('status', 0)->orderByDesc('id')->paginate(10);
        return view('employer.profile', compact('employer', 'vacancies'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function search(Request $request)
    {
        $employers = Employer::query()->orderByDesc('id')->paginate(36);
        return view('employer.search', compact('employers'));
    }
}
