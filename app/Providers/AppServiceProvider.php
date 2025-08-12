<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Registration;
use App\Observers\RegistrationObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Registration::observe(RegistrationObserver::class);
    }
}
