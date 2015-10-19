<?php namespace Atlas;

use DB;
use Schema;
use AliasLoader;

use CupOfTea\Package\Package;

use Atlas\Support\LoadsServiceProviders;

class Core implements CoreContract
{
    
    use Package, LoadsServiceProviders;
    
    /**
     * Package Info
     *
     * @const string PACKAGE
     * @const string VERSION
     */
    const PACKAGE = 'Atlas/Core';
    const VERSION = '0.0.0';
    
    protected $facades = [
        'Constants' => 'Atlas\Constants\Facades\Constants',
    ];
    
    public function __construct()
    {
        $this->registerFacades($this->facades);
    }
    
    public function boot()
    {
        $providers = $this->getServiceProviders();
        
        $this->loadServiceProviders($providers);
    }
    
    /**
     * @inheritdoc
     */
    public function isInstalled()
    {
        return Schema::hasTable('AtlasMeta') ? ((bool) DB::table('AtlasMeta')->where('meta_name', 'is_installed')->where('meta_value', true)->count()) : false;
    }
    
    /**
     * Register Atlas' Facades
     *
     * @return void
     */
    protected function registerFacades($facades)
    {
        AliasLoader::getInstance()->register($facades);
    }
    
    protected function loadServiceProviders()
    {
        // Get all installed ServiceProviders
        
        $manifestPath = $this->app->getCachedServicesPath();
        (new ProviderRepository($this, new Filesystem, $manifestPath))
                    ->load($providers);
    }
    
}
