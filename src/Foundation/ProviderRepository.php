<?php namespace Atlas\Foundation;

use Illuminate\Foundation\ProviderRepository as BaseProviderRepository;

class ProviderRepository extends BaseProviderRepository
{
    
    public function load(array $providers)
    {
        $manifest = $this->loadManifest();
        
        // First we will load the service manifest, which contains information on all
        // service providers registered with the application and which services it
        // provides. This is used to know which services are "deferred" loaders.
        if ($this->shouldRecompile($manifest, $providers)) {
            $manifest = $this->compileManifest($providers);
        }
        
        // Next, we will register events to load the providers for each of the events
        // that it has requested. This allows the service provider to defer itself
        // while still getting automatically loaded when a certain event occurs.
        foreach ($manifest['when'] as $provider => $events) {
            $this->registerLoadEvents($provider, $events);
        }
        
        // We will go ahead and register all of the eagerly loaded providers with the
        // application so their services can be registered with the application as
        // a provided service. Then we will set the deferred service list on it.
        foreach ($manifest['eager'] as $provider) {
            $this->app->register($this->createProvider($provider));
        }
        
        $this->app->addDeferredServices($manifest['deferred']);
    }
    
    /**
     * Write the service manifest file to disk.
     *
     * @param  array  $manifest
     * @return array
     */
    public function writeManifest($manifest)
    {
        $this->files->put(
            $this->manifestPath, json_encode($manifest, JSON_PRETTY_PRINT)
        );
        
        return array_merge(['when' => []], $manifest);
    }
    
}
