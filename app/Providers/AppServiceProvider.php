<?php

namespace App\Providers;

use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Repositories\Customer\Eloquent\CustomerRepository;
use App\Repositories\Ticket\Eloquent\TicketRepository;
use App\Repositories\Ticket\TicketRepositoryInterface;
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
