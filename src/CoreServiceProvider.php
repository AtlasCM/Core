<?php namespace Atlas;

use Illuminate\Support\ServiceProvider;
use Atlas\Support\LoadsServiceProviders;
use Atlas\Constants\ConstantsServiceProvider as Constants;
use Atlas\Installer\InstallerServiceProvider as Installer;

class CoreServiceProvider extends ServiceProvider
{
    use LoadsServiceProviders;
    
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;
    
    /**
     * Additional Service Providers to be loaded before the Main Atlas Application boots.
     *
     * @var array
     */
    protected $providers = [
        Constants::class,
    ];
    
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot(CoreContract $core)
    {
        $this->loadServiceProviders('core', $this->providers);
        
        if (! $core->isInstalled()) {
            return $this->loadServiceProviders('install', [Installer::class]);
        }
        
        $core->boot();
    }
    
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/atlas.php', 'atlas'
        );
        
        $this->app->singleton(CoreContract::class, Core::class);
    }
    
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            CoreContract::class,
        ];
    }
}
