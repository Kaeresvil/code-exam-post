<?php

namespace App\Providers;

use App\Services\Utils\ResponseService;
use Illuminate\Support\ServiceProvider;
use App\Services\Authentication\AuthService;
use App\Services\Utils\ResponseServiceInterface;
use App\Services\Authentication\AuthServiceInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
          $this->app->bind(ResponseServiceInterface::class, ResponseService::class);
          $this->app->bind(AuthServiceInterface::class, AuthService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
