<?php
namespace RaisulHridoy\SimpleRolePermission;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use RaisulHridoy\SimpleRolePermission\Models\Role;
use RaisulHridoy\SimpleRolePermission\Utilities\Utility;

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
        $this->mergeConfigFrom(
            __DIR__.'/config/srp.php', 'srp'
        );
        $this->publishes([
            __DIR__.'/config/srp.php' => config_path('srp.php'),
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
        Blade::directive('cando', function($role_name_or_slug,$permission_name_or_group) {
            $permission = Utility::rolePermissionCheck($role_name_or_slug,$permission_name_or_group);
            return "<?php if($permission){return true;}else{return false;}  ?>";
        });
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
