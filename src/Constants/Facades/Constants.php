<?php namespace Atlas\Constants\Facades;

use Atlas\Constants\Accessor;
use Illuminate\Support\Facades\Facade;

class Constants extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Accessor::class;
    }
}
