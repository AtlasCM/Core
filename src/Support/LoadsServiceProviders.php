<?php namespace Atlas\Support;

trait LoadsServiceProviders
{

    protected function loadServiceProviders($providers)
    {
        $providers = is_string($providers) ? [$providers] : $providers;

        $manifestPath = app()->getCachedServicesPath();
        (new ProviderRepository($this, new Filesystem, $manifestPath))
                    ->load($providers);
    }

}
