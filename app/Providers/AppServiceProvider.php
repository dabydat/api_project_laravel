<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\LeadRepository;
use App\Repositories\UserRepository;
use App\Repositories\Contracts\LeadRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(LeadRepositoryInterface::class, LeadRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
