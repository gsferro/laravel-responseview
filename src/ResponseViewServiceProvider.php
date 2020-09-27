<?php

namespace Gsferro\ResponseView;

use Illuminate\Support\ServiceProvider;

class ResponseViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'responseview');
        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views/vendor/gsferro/responseview'),
        ]);
    }
}
