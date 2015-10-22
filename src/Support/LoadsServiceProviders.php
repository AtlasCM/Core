<?php namespace Atlas\Support;

use Event;
use Atlas\CoreContract;
use Atlas\Foundation\ProviderRepository;
use Illuminate\Filesystem\Filesystem;

trait LoadsServiceProviders
{
    protected function loadServiceProviders($tag, $providers)
    {
        $core = app(CoreContract::class);
        $providers = is_string($providers) ? [$providers] : $providers;
        
        Event::listen(last($providers), function ($event) use ($core) {
            $core->register();
        });
        
        $manifestPath = $core->getCachedServicesPath($tag);
        (new ProviderRepository(app(), new Filesystem, $manifestPath))
                    ->load($providers);
    }
} 
