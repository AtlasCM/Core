<?php namespace Atlas;

use CupOfTea\Package\Package;

class Atlas
{
    use Package;
    
    /**
     * Package Info.
     *
     * @const string PACKAGE
     * @const string VERSION
     */
    const PACKAGE = 'Atlas/Core';
    const VERSION = '0.0.0';
    
    public function homepage()
    {
        return 'https://github.com/AtlasCM/Atlas';
    }
}
