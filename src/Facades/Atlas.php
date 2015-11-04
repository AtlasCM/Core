<?php namespace Atlas\Facades;

use Atlas\Atlas as AtlasProvider;
use Illuminate\Support\Facades\Facade;

class Atlas extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return AtlasProvider::class;
    }
}
