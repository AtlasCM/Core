<?php namespace Atlas\Views\Compilers;

use Blade;
use Atlas\Support\ServiceProvider;

class AtlasBladeDirectivesServiceProvider extends ServiceProvider
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
        Blade::directive('var', function($expression) {
            $comma = '/^\\(([\'|"]?)(\\w+?)(?1),\\s*(.*)\\)/';
            $assign = '/^\\((\\$\\w+?)\\s*=\\s*(.*)\\)/';
            
            if (preg_match($comma, $expression)) {
                return preg_replace($comma, '<?php $$2 = $3; ?>', $expression);
            } else {
                return (preg_replace($assign, '<?php $1 = $2; ?>', $expression));
            }
        });
    }
    
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        
    }
}
