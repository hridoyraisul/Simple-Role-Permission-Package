<?php
namespace RaisulHridoy\SimpleRolePermission;
use Illuminate\Support\ServiceProvider;

class SRPServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'srp');
        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views/vendor/srp'),
        ]);
        $this->publishes([
            __DIR__.'/config/srp.php' => config_path('srp.php'),
        ]);
        $this->publishes([
            __DIR__.'/database/migrations' => database_path('migrations'),
        ]);
        $this->publishes([
            __DIR__.'/database/seeders' => database_path('seeders'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
