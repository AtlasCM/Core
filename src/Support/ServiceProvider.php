<?php namespace Atlas\Support;

use AliasLoader;

use Atlas\CoreContract;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

abstract class ServiceProvider extends BaseServiceProvider
{
    
    protected function registerFacades($facades)
    {
        $this->app->make(CoreContract::class)->registerFacades(get_class($this), $facades);
    }
    
}
