<?php namespace Atlas;

use DB;
use Schema;

use CupOfTea\Package\Package;

use Illuminate\Foundation\AliasLoader;

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
        'Atlas\Core' => [
            'Constants' => 'Atlas\Constants\Facades\Constants',
        ],
    ];
    
    public function __construct()
    {
        //$this->register();
    }
    
    public function boot()
    {
        $providers = $this->getServiceProviders();
        
        $this->loadServiceProviders($providers);
    }
    
    /**
     * Get the Cached services path
     * 
     * @return string Cached services path
     */
    public function getCachedServicesPath()
    {
        return app()->basePath() . '/bootstrap/cache/atlas_services.json';
    }
    
    /**
     * @inheritdoc
     */
    public function isInstalled()
    {
        return env('ATLAS_INSTALLED', false) && (Schema::hasTable(Constants) ? ((bool) DB::table('AtlasMeta')->where('meta_name', 'is_installed')->where('meta_value', true)->count()) : false);
    }
    
    /**
     * Register Atlas' Facades
     *
     * @return void
     */
    public function registerFacades($provider, $facades)
    {
        $this->facades[$provider] = $facades;
    }
    
    public function register()
    {
        $facades = collect($this->facades);
        while ($facade = $facades->shift() && $facades->count()) {
            
        }
        
        AliasLoader::getInstance($facades)->register();
        $this->facades = [];
    }
    
    protected function getServiceProviders()
    {
        // Get all installed ServiceProviders
    }
    
}
