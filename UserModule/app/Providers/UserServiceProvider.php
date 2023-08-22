<?php

namespace UserModule\app\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->publishConfig();
        $this->publishView();
        $this->loadMigration();

        Route::middleware('api')
            ->prefix('api')
            ->group(function () {
                $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');
            });
        Route::middleware('web')
            ->group(function () {
                $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
            });

    }

    public function loadMigration()
    {
        $this->publishes([
            __DIR__ . '/../../database/migrations' => database_path('migrations')
        ]);
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
    }

    public function publishView()
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views/users', 'dashboard.users');
    }

    protected function publishConfig()
    {
        $this->publishes([
            __DIR__ . '/../../config/user-config.php' => config_path('user-config.php')
        ]);
        $this->mergeConfigFrom(__DIR__ . '/../../config/user-config.php', 'user');
    }
}
