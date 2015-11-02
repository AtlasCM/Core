<?php namespace Atlas\Installer;

use Validator;
use Illuminate\Support\Arr;
use Illuminate\Routing\Router;
use Atlas\Support\ServiceProvider;
use Atlas\Installer\Http\Middleware\EnvConfiguredMiddleware;
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
        'atlas.installer.env.configured' => EnvConfiguredMiddleware::class,
    ];
    
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        Validator::extend('required_unless', function($attribute, $value, $parameters, $validator) {
            $validator->requireParameterCount(2, $parameters, 'required_unless');
            
            $data = Arr::get($validator->getData(), $parameters[0]);
            
            $values = array_slice($parameters, 1);
            
            if (! in_array($data, $values)) {
                if (is_null($value)) {
                    return false;
                } elseif (is_string($value) && trim($value) === '') {
                    return false;
                } elseif ((is_array($value) || $value instanceof Countable) && count($value) < 1) {
                    return false;
                } elseif ($value instanceof File) {
                    return (string) $value->getPath() != '';
                }
                
                return true;
            }
            
            return true;
        });
        
        Validator::replacer('foo', function($message, $attribute, $rule, $parameters) {
            // TODO: This method is private so cant be used.
            $other = $this->getAttribute(array_shift($parameters));
            
            return str_replace([':other', ':values'], [$other, implode(', ', $parameters)], $message);
        });
        
        foreach ($this->routeMiddleware as $key => $middleware) {
            $router->middleware($key, $middleware);
        }
        
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
