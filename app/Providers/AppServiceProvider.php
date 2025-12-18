<?php

namespace App\Providers;

use App\Repositories\CustomerRepositoryInterface;
use App\Repositories\Eloquent\CustomerRepository;
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

        $this->app->bind(
        CustomerRepositoryInterface::class,
        CustomerRepository::class
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
