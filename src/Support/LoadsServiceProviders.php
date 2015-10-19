<?php namespace Atlas\Support;

use Event;

use Atlas\CoreContract;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\ProviderRepository;

trait LoadsServiceProviders
{
    
    protected function loadServiceProviders($providers)
    {
        return;
        $providers = is_string($providers) ? [$providers] : $providers;
        
        Event::listen(last($providers), function($event) {
            app(CoreContract::class)->register();
        });
        
        $manifestPath = app(CoreContract::class)->getCachedServicesPath();
        (new ProviderRepository($this->app, new Filesystem, $manifestPath))
                    ->load($providers);
    }
    
}
