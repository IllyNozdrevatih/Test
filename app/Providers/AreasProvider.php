<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;

class AreasProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('auth.register','App\Http\ViewComposers\AreasComposer');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
