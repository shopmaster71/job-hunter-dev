<?php

use App\Http\Controllers\AgencyController;
use App\Http\Controllers\AgencyMessageController;
use App\Http\Controllers\AgencyResponseController;
use App\Http\Controllers\AgencyVacancyController;
use App\Http\Controllers\AICoverLetterController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\EmployerResponseController;
use App\Http\Controllers\EmployerVacancyController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HrController;
use App\Http\Controllers\HrMessageController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPhotoController;
use App\Http\Controllers\VacancyController;
use App\Models\City;
use App\Services\CityService;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

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
Route::get('hr-search', [HrController::class, 'search'])->name('hr.search');
Route::get('employer-search', [EmployerController::class, 'search'])->name('employer.search');
Route::get('/vacancy', [VacancyController::class, 'vacancyList'])->name('vacancy.list');
Route::get('/vacancy/{slug}', [VacancyController::class, 'show'])->name('vacancy.show');
Route::get('/agency-profile/{slug}', [AgencyController::class, 'profile'])->name('agency.profile');
Route::post('/agency-message/{agency}', [AgencyMessageController::class, 'create'])->name('agency.message.create');
Route::get('/message-show/{message}', [AgencyMessageController::class, 'show'])->name('agency.message.show');
Route::get('/page/{slug}', [\App\Http\Controllers\PageController::class, 'show'])->name('page.show');
Route::get('/news-list', [NewsController::class, 'index'])->name('news.list');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');

Route::middleware('archive')->group(function () {
    Route::get('/vacancy-add-archive/{slug}', [VacancyController::class, 'addInArchive'])->name('vacancy.add.archive');
    Route::get('/vacancy-remove-archive/{slug}', [VacancyController::class, 'removeInArchive'])->name('vacancy.remove.archive');
});

Route::middleware('applicant')->group(function () {
    Route::get('/applicant', [ApplicantController::class, 'index'])->name('applicant.index')->middleware('geo');
    Route::post('/applicant-create', [ApplicantController::class, 'create'])->name('applicant.create');
    Route::post('/contact', [ApplicantController::class, 'contactCreate'])->name('applicant.contact.create');
    Route::resource('/experience', ExperienceController::class);
    Route::resource('/education', EducationController::class);
    Route::get('/edit/{applicant}', [ApplicantController::class, 'edit'])->name('applicant.edit')->middleware('geo');
    Route::put('/update/{applicant}', [ApplicantController::class, 'update'])->name('applicant.update');
    Route::get('/contact-edit/{applicant}', [ApplicantController::class, 'contactEdit'])->name('applicant.contact.edit');
    Route::put('/contact-update/{applicant}', [ApplicantController::class, 'contactUpdate'])->name('applicant.contact.update');
    Route::get('/message', [MessageController::class, 'index'])->name('message.index');
    Route::get('/message/{message}', [MessageController::class, 'show'])->name('message.show');
    Route::get('/response/{response}', [MessageController::class, 'responseShow'])->name('response.show');
    Route::get('/resume', [ResumeController::class, 'index'])->name('resume.index');
    Route::get('/resume-create', [ResumeController::class, 'create'])->name('resume.create');
    Route::post('/resume-store', [ResumeController::class, 'store'])->name('resume.store');
    Route::get('/resume-edit/{resume}', [ResumeController::class, 'edit'])->name('resume.edit');
    Route::put('/resume-update/{resume}', [ResumeController::class, 'update'])->name('resume.update');
    Route::get('/resume-show/{resume}', [ResumeController::class, 'show'])->name('resume.show');
    Route::get('/resume-download/{resume}', [ResumeController::class, 'download'])->name('resume.download');
    Route::get('/resume-add-archive/{resume}', [ResumeController::class, 'addInArchive'])->name('resume.archive');
    Route::get('/resume-remove-archive/{resume}', [ResumeController::class, 'removeInArchive'])->name('resume.list');
    Route::get('/favorites', [FavoriteController::class, 'list'])->name('favorite.list');
    Route::post('/ai/cover-letter', [AICoverLetterController::class, 'generate'])->name('ai.cover-letter.generate');
    Route::post('/response-store/{vacancy}', [VacancyController::class, 'store'])->name('response.store');
});

Route::middleware('hr')->group(function () {
    Route::get('/hr', [HrController::class, 'index'])->name('hr.index')->middleware('geo');
    Route::post('/create', [HrController::class, 'create'])->name('hr.create');
    Route::get('/hr-edit/{hr}', [HrController::class, 'edit'])->name('hr.edit')->middleware('geo');
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
    Route::get('/employer-edit/{employer}', [EmployerController::class, 'edit'])->name('employer.edit')->middleware('geo');
    Route::put('/employer-update/{employer}', [EmployerController::class, 'update'])->name('employer.update');
    Route::post('/employer-contact', [EmployerController::class, 'contactCreate'])->name('employer.contact.create');
    Route::get('/employer-contact-edit/{employer}', [EmployerController::class, 'contactEdit'])->name('employer.contact.edit');
    Route::put('/employer-contact-update/{employer}', [EmployerController::class, 'contactUpdate'])->name('employer.contact.update');
    Route::get('/employer-vacancies', [EmployerVacancyController::class, 'index'])->name('employer.vacancies.index');
    Route::get('/employer-vacancy-create', [EmployerVacancyController::class, 'create'])->name('employer.vacancy.create')->middleware('geo');
    Route::post('/employer-vacancy-store',[EmployerVacancyController :: class , "store"])->name('employer.vacancy.store');
    Route::get('/employer-vacancy-edit/{vacancy}',[EmployerVacancyController :: class , "edit"])->name('employer.vacancy.edit')->middleware('geo');
    Route::put('/employer-vacancy-update/{vacancy}', [EmployerVacancyController::class, 'update'])->name('employer.vacancy.update');
    Route::get('/employer-archive', [EmployerVacancyController::class, 'archiveList'])->name('employer.vacancy.archive');
    Route::get('/employer-responses', [EmployerResponseController::class, 'index'])->name('employer.responses.index');
    Route::get('/response-show/{response}', [EmployerResponseController::class, 'show'])->name('employer.response.show');
});

Route::middleware('agency')->group(function () {
    Route::get('/agency', [AgencyController::class, 'index'])->name('agency.index')->middleware('geo');
    Route::post('/agency-create', [AgencyController::class, 'create'])->name('agency.create');
    Route::get('/agency-edit/{agency}', [AgencyController::class, 'edit'])->name('agency.edit')->middleware('geo');
    Route::put('/agency-update/{agency}', [AgencyController::class, 'update'])->name('agency.update');
    Route::post('/agency-information', [AgencyController::class, 'createInformation'])->name('agency.information.create');
    Route::get('/agency-information-edit/{agency}', [AgencyController::class, 'informationEdit'])->name('agency.information.edit');
    Route::put('/agency-information-update/{agency}', [AgencyController::class, 'informationUpdate'])->name('agency.information.update');
    Route::get('/agency-vacancies', [AgencyVacancyController::class, 'index'])->name('agency.vacancies.index');
    Route::get('/agency-vacancy-create', [AgencyVacancyController::class, 'create'])->name('agency.vacancy.create')->middleware('geo');
    Route::post('/agency-vacancy-store',[AgencyVacancyController::class , "store"])->name('agency.vacancy.store');
    Route::get('/agency-vacancy-edit/{vacancy}',[AgencyVacancyController::class , "edit"])->name('agency.vacancy.edit')->middleware('geo');
    Route::put('/agency-vacancy-update/{vacancy}', [AgencyVacancyController::class, 'update'])->name('agency.vacancy.update');
    Route::get('/agency-archive', [AgencyVacancyController::class, 'archiveList'])->name('agency.vacancy.archive');
    Route::get('/messages', [AgencyMessageController::class, 'index'])->name('agency.message.index');
    Route::get('/agency-responses', [AgencyResponseController::class, 'index'])->name('agency.responses.index');
    Route::get('/agency-show/{response}', [AgencyResponseController::class, 'show'])->name('agency.response.show');
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
    Route::get('/favorite/toggle/{vacancy}', [FavoriteController::class, 'toggle'])->name('favorite.toggle');

});

require __DIR__.'/admin.php';


