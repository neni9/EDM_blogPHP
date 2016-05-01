<?php

namespace App\Providers;

use App\Score\Score;
use Illuminate\Support\ServiceProvider;

class ScoreServiceProvider extends ServiceProvider
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
        $this->app->singleton(Score::class, function ($app) {
            return new Score($app['App\Post']);
        });
    }
}
