<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;
use Validator;

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
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url') . "/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });

        /*Validations*/
        Validator::extend('individual_registration', '\App\Utils\ValidateIndividualRegistration@validate');
        Validator::extend('legal_entity_number_registration', '\App\Utils\ValidateLegalEntityNumberRegistration@validate');
    }
}
