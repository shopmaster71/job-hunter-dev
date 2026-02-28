<?php

use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\EmployerVacancyController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HrController;
use App\Http\Controllers\HrMessageController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPhotoController;
use App\Models\City;
use App\Services\CityService;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

Route::get('/clear-all', function () {
    /*if (!app()->isLocal()) {
        abort(403, 'Доступ запрещён.');
    }*/

    Artisan::call('cache:clear');    // Очистить application cache
    Artisan::call('config:clear');   // Очистить config
    Artisan::call('route:clear');    // Очистить маршруты
    Artisan::call('view:clear');     // Очистить скомпилированные шаблоны

    return 'Весь кэш очищен!';
})->name('clear.all');

Route::get('/cities/search', function (CityService $cityService) {
    $query = request('q');
    if (!$query || strlen($query) < 2) {
        return response()->json([]);
    }
    $cities = $cityService->search($query, 10);
    return response()->json($cities);
})->name('cities.search');


Route::post('/region/update', [RegionController::class, 'update'])->name('region.update');
Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('geo');
Route::get('/profile/{slug}', [ApplicantController::class, 'profile'])->name('applicant.profile');
Route::post('/message/{applicant}', [MessageController::class, 'create'])->name('message.create');
Route::get('/headhunter/{slug}', [HrController::class, 'headhunter'])->name('hr.headhunter');
Route::post('/hr-message/{hr}', [HrMessageController::class, 'create'])->name('hr.message.create');
Route::get('/employer-profile/{slug}', [EmployerController::class, 'profile'])->name('employer.profile');

Route::middleware('applicant')->group(function () {
    Route::get('/applicant', [ApplicantController::class, 'index'])->name('applicant.index');
    Route::post('/applicant-create', [ApplicantController::class, 'create'])->name('applicant.create');
    Route::post('/contact', [ApplicantController::class, 'contactCreate'])->name('applicant.contact.create');
    Route::resource('/experience', ExperienceController::class);
    Route::resource('/education', EducationController::class);
    Route::get('/edit/{applicant}', [ApplicantController::class, 'edit'])->name('applicant.edit');
    Route::put('/update/{applicant}', [ApplicantController::class, 'update'])->name('applicant.update');
    Route::get('/contact-edit/{applicant}', [ApplicantController::class, 'contactEdit'])->name('applicant.contact.edit');
    Route::put('/contact-update/{applicant}', [ApplicantController::class, 'contactUpdate'])->name('applicant.contact.update');
    Route::get('/message', [MessageController::class, 'index'])->name('message.index');
    Route::get('/message/{message}', [MessageController::class, 'show'])->name('message.show');
});

Route::middleware('hr')->group(function () {
    Route::get('/hr', [HrController::class, 'index'])->name('hr.index')->middleware('geo');
    Route::post('/create', [HrController::class, 'create'])->name('hr.create');
    Route::get('/hr-edit/{hr}', [HrController::class, 'edit'])->name('hr.edit');
    Route::put('/hr-update/{hr}', [HrController::class, 'update'])->name('hr.update');
    Route::post('/hr-information', [HrController::class, 'informationCreate'])->name('hr.information.create');
    Route::get('/information-edit/{hr}', [HrController::class, 'informationEdit'])->name('hr.information.edit');
    Route::put('/information-update/{hr}', [HrController::class, 'informationUpdate'])->name('hr.information.update');
    Route::get('/messages', [HrMessageController::class, 'index'])->name('hr.message.index');
    Route::get('/hr-message/{message}', [HrMessageController::class, 'show'])->name('hr.message.show');
});

Route::middleware('employer')->group(function () {
    Route::get('/employer', [EmployerController::class, 'index'])->name('employer.index')->middleware('geo');
    Route::post('/employer-create', [EmployerController::class, 'create'])->name('employer.create');
    Route::get('/employer-edit/{employer}', [EmployerController::class, 'edit'])->name('employer.edit');
    Route::put('/employer-update/{employer}', [EmployerController::class, 'update'])->name('employer.update');
    Route::post('/employer-contact', [EmployerController::class, 'contactCreate'])->name('employer.contact.create');
    Route::get('/employer-contact-edit/{employer}', [EmployerController::class, 'contactEdit'])->name('employer.contact.edit');
    Route::put('/employer-contact-update/{employer}', [EmployerController::class, 'contactUpdate'])->name('employer.contact.update');
    Route::get('/employer-vacancies', [EmployerVacancyController::class, 'index'])->name('employer.vacancies.index');
    Route::get('/employer-vacancy-create', [EmployerVacancyController::class, 'create'])->name('employer.vacancy.create');
    Route::post('/employer-vacancy-store',[EmployerVacancyController :: class , "store"])->name('employer.vacancy.store');
    Route::get('/employer-vacancy-edit/{vacancy}',[EmployerVacancyController :: class , "edit"])->name('employer.vacancy.edit');
    Route::put('/employer-vacancy-update/{vacancy}', [EmployerVacancyController::class, 'update'])->name('employer.vacancy.update');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/login', [UserController::class, 'loginPost'])->name('login');
    Route::get('/register', [UserController::class, 'register'])->name('register');
    Route::post('/register', [UserController::class, 'registerPost'])->name('register');
    Route::get('/forgot', [UserController::class, 'forgot'])->name('forgot');
    Route::post('/forgot', [UserController::class, 'forgotPost'])->name('forgot');
    Route::get('/reset-password/{token}', [UserController::class, 'reset'])->name('password.reset');
    Route::post('/reset-password', [UserController::class, 'resetPost'])->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [UserController::class, 'verifiedEmail'])->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', [UserController::class, 'verifiedEmailRequest'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
    Route::post('email/verification-notification', [UserController::class, 'verifiedEmailPost'])
        ->middleware('throttle:6,1')
        ->name('verification.send');
    Route::get('/logout', [UserController::class, 'destroy'])->name('logout');
    Route::post('/media', [UserPhotoController::class, 'media'])->name('media');
});


