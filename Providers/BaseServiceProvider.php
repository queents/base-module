<?php

namespace Modules\Base\Providers;

use Illuminate\Support\Facades\URL;
use Modules\Base\Services\Core\VILT;
use Illuminate\Support\Facades\Crypt;
use Modules\Base\Console\InstallVilt;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\ServiceProvider;
use Modules\Base\Services\Components\Base\Menu;

class BaseServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Base';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'base';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        VILT::registerMenu(Menu::make('Profile')->label('global.profile')->icon('bx bxs-user')->key('profile')->route('profile.show'));
        $this->registerConfig();
        $this->loadViewsFrom(module_path($this->moduleName, 'Resources/views'), 'base');
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
        URL::forceScheme('https');

        if (!empty(Cookie::get('lang'))) {
            $local = explode('|', Crypt::decrypt(Cookie::get('lang'), false))[1];
        } else {
            $local = "en";
        }

        app()->setLocale($local);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'),
            $this->moduleNameLower
        );
    }
}
