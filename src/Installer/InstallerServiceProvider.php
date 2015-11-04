<?php namespace Atlas\Installer;

use Validator;
use Illuminate\Routing\Router;
use Atlas\Support\ServiceProvider;
use Atlas\Installer\Http\Middleware\ModeSetMiddleware;
use Atlas\Installer\Http\Middleware\EnvConfiguredMiddleware;
use Atlas\Installer\Validation\Extensions\DatabaseValidator;
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
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'atlas.installer.mode' => ModeSetMiddleware::class,
        'atlas.installer.env.configured' => EnvConfiguredMiddleware::class,
    ];
    
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot(Router $router, InstallerContract $installer)
    {
        foreach ($this->routeMiddleware as $key => $middleware) {
            $router->middleware($key, $middleware);
        }
        
        include __DIR__ . '/Http/routes.php';
        
        Validator::extend('database', DatabaseValidator::class . '@validate');
        Validator::replacer('database', DatabaseValidator::class . '@replace');
        
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
