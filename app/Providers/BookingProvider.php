<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BookingProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
       $this->app->bind('Booking', function(){
            return new \App\Classes\Booking;
        });
    }
}
