<?php


use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ImageUploadController;
use App\Http\Controllers\Admin\NewsImportController;

use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin', 'middleware' => AdminMiddleware::class], function (){
    Route::get('/clear-all', function () {
        Artisan::call('cache:clear');    // Очистить application cache
        Artisan::call('config:clear');   // Очистить config
        Artisan::call('route:clear');    // Очистить маршруты
        Artisan::call('view:clear');     // Очистить скомпилированные шаблоны
        return 'Весь кэш очищен!';
    })->name('clear.all');

    Route::get('/', HomeController::class)->name('admin.home');
    Route::resource('/categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('/tags', \App\Http\Controllers\Admin\TagController::class);
    Route::resource('/news', \App\Http\Controllers\Admin\NewsController::class);
    Route::resource('/pages', \App\Http\Controllers\Admin\PageController::class);
    Route::resource('/questions', \App\Http\Controllers\Admin\QuestionController::class);
    Route::resource('/industry-groups', \App\Http\Controllers\Admin\GroupIndustryController::class);
    Route::resource('/industries', \App\Http\Controllers\Admin\IndustryController::class);
    Route::resource('/specializations', \App\Http\Controllers\Admin\SpecializationController::class);
    Route::resource('/expertise', \App\Http\Controllers\Admin\ExpertiseController::class);
    Route::resource('/schedules', \App\Http\Controllers\Admin\ScheduleController::class);
    Route::resource('/formats', \App\Http\Controllers\Admin\FormatController::class);
    Route::resource('/employment-types', \App\Http\Controllers\Admin\EmploymentTypeController::class);
    Route::resource('/cities', \App\Http\Controllers\Admin\CityController::class);
    Route::get('/news-fetch', [NewsImportController::class, 'fetch'])->name('news.fetch');
    Route::post('/news-import', [NewsImportController::class, 'import'])->name('news.import');
    Route::post('/news/upload-image', [ImageUploadController::class, 'uploadImage'])->name('news.upload-image');
});
