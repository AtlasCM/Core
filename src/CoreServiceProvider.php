<?php namespace Atlas;

use Illuminate\Support\ServiceProvider;

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
    public function boot(CoreContract $core)
    {
        if (!$core->isInstalled()) {


            return;
        }

//        $this->publishes([
//            __DIR__.'/../config/assets.php' => config_path('assets.php'),
//        ], 'config');
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
		return [CoreContract::class];
	}

}
