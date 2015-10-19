<?php namespace Atlas\Core\Installer;

use Illuminate\Support\ServiceProvider;

use Atlas\Core\Installer\Installer;
use Atlas\Core\Installer\Contracts\Installer as InstallerContract;

class CoreServiceProvider extends ServiceProvider
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
    }
    
	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->mergeConfigFrom(
            __DIR__ . '/../config/atlas/installer.php', 'atlas.installer'
        );
	}
    
}