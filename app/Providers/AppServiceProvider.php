<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Register singleton for GoogleAuthService
        $this->app->singleton(\App\Services\GoogleAuthService::class, function ($app) {
            return new \App\Services\GoogleAuthService();
        });

        // Register singleton for RemoteDataService
        $this->app->singleton(\App\Services\RemoteDataService::class, function ($app) {
            return new \App\Services\RemoteDataService();
        });

        // Register singleton for NotificationService
        $this->app->singleton(\App\Services\NotificationService::class, function ($app) {
            return new \App\Services\NotificationService();
        });

        // Register singleton for UserActivityStatsService
        $this->app->singleton(\App\Services\UserActivityStatsService::class, function ($app) {
            return new \App\Services\UserActivityStatsService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
