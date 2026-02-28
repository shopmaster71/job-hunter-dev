<?php

namespace App\Providers;

use App\Models\Applicant;
use App\Models\ApplicantContact;
use App\Models\Employer;
use App\Models\HeadHunter;
use App\Models\Region;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Pagination\Paginator;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Stevebauman\Location\Facades\Location;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale('ru');

        /**
         * @noinspection PhpParamsInspection
         */
        Gate::define('update-vacancy-employer', function (User $user, Vacancy $vacancy) {
            return $user->id === $vacancy->author_id;
        });

        /**
         * @noinspection PhpParamsInspection
         */
        Gate::define('update-applicant', function (User $user, Applicant $applicant) {
            return $user->id === $applicant->user_id;
        });

        /**
         * @noinspection PhpParamsInspection
         */
        Gate::define('update-employer', function (User $user, Employer $employer) {
            return $user->id === $employer->user_id;
        });

        /**
         * @noinspection PhpParamsInspection
         */
        Gate::define('update-hr', function (User $user, HeadHunter $hr) {
            return $user->id === $hr->user_id;
        });

    }
}
