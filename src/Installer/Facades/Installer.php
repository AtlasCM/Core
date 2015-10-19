<?php namespace Atlas\Installer\Facades;

use Atlas\Installer\Contracts\Installer as InstallerContract;

use Illuminate\Support\Facades\Facade;

class Installer extends Facade {
    
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return InstallerContract::class; }
    
}
