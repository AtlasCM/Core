<?php namespace Atlas;

use DB;
use Schema;
use AliasLoader;

use CupOfTea\Package\Package;

class Core implements CoreContract
{

    use Package;

    /**
     * Package Info
     *
     * @const string PACKAGE
     * @const string VERSION
     */
    const PACKAGE = 'Atlas/Core';
    const VERSION = '0.0.0';

    public function __construct()
    {
        $this->registerFacades();
    }

    public function isInstalled()
    {
        return Schema::hasTable('AtlasMeta') ? ((bool) DB::table('AtlasMeta')->where('meta_name', 'is_installed')->where('meta_value', true)->count()) : false;
    }

    protected function registerFacades()
    {
        AliasLoader::getInstance(config('atlas.aliases'))->register();
    }

}
