<?php

namespace GMJ\LaravelBlock2Video;

use GMJ\LaravelBlock2Video\View\Components\Frontend;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class LaravelBlock2VideoServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadRoutesFrom(__DIR__ . "/routes/web.php", 'LaravelBlock2Video');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'LaravelBlock2Video');
        $this->loadViewsFrom(__DIR__ . '/resources/views/config', 'LaravelBlock2Video.config');

        Blade::component("LaravelBlock2Video", Frontend::class);

        $this->publishes([
            __DIR__ . '/config/laravel_block2_video_config.php' => config_path('gmj/laravel_block2_video_config.php'),
            __DIR__ . '/database/seeders' => database_path('seeders'),
        ], 'GMJ\LaravelBlock2Video');
    }


    public function register()
    {
    }
}
