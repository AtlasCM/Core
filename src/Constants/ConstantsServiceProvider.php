<?php namespace Atlas\Constants;

use Atlas\Support\ServiceProvider;

class ConstantsServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;
    
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerFacades([
            'Constants' => 'Atlas\Facades\Constants',
        ]);
    }
}
