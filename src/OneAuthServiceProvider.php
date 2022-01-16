<?php

namespace Teampro\OneAuth;

use Illuminate\Support\ServiceProvider;

class OneAuthServiceProvider extends ServiceProvider {


    public function boot()
    {
        $this->loadRoutesFrom(__DIR__."/routes/web.php");
        $this->loadMigrationsFrom(__DIR__."/database/migrations");

        $this->publishes([
            __DIR__."/config/oneauth.php" => config_path('oneauth.php')
        ]);
    }

    public function register()
    {


    }


}
