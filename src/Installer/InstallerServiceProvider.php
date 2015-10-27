<?php namespace Atlas\Installer;

use Atlas\Support\ServiceProvider;
use Atlas\Installer\Contracts\Installer as InstallerContract;

class InstallerServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;
    
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__ . '/routes.php';
        
        $this->loadViewsFrom(__DIR__ . '/../../resources/views/installer', 'atlas.installer');
    }
    
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/atlas/installer.php', 'atlas.installer'
        );
        
        $this->app->singleton(InstallerContract::class, Installer::class);
    }
}
