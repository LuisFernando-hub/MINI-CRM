<?php

namespace App\Providers;

use App\Repositories\Eloquent\TicketRepository;
use App\Repositories\TicketRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
       $this->app->bind(
        TicketRepositoryInterface::class,
        TicketRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
