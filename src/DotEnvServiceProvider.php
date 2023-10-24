<?php

namespace Farshadth\DotEnv;

use Illuminate\Support\ServiceProvider;

class DotEnvServiceProvider extends ServiceProvider
{
    /**
     * register provider
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind('DotEnv', function ($app) {
            return new DotEnv($app);
        });
    }

    /**
     * boot provider
     *
     * @return void
     */
    public function boot(): void
    {

    }
}