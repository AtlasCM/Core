<?php namespace Atlas;

use DB;
use Schema;

use CupOfTea\Package\Package;

use Illuminate\Foundation\AliasLoader;

use Atlas\Support\LoadsServiceProviders;
use Atlas\Exceptions\ServiceProviderConflictException;

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
    
    protected $facades = [];
    
    public function boot()
    {
        $providers = $this->getServiceProviders();
        
        $this->loadServiceProviders('plugins', $providers['plugins']);
        $this->loadServiceProviders('themes', $providers['themes']);
    }
    
    /**
     * Get the Cached services path
     *
     * @return string Cached services path
     */
    public function getCachedServicesPath($tag)
    {
        return app()->basePath() . '/bootstrap/cache/atlas_'. $tag . '_services.json';
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
        $all_facades = $facades = collect($this->facades);
        $all_facades = $all_facades->values()->collapse()->all();
        $provider = [];
        
        while (($provider['name'] = $facades->keys()->shift()) && ($provider['facades'] = $facades->shift()) && $facades->count()) {
            $facades->each(function($provider_facades, $provider_name) use ($provider) {
                foreach ($provider['facades'] as $facade => $concrete) {
                    if (collect($provider_facades)->has($facade)) {
                        throw new ServiceProviderConflictException($provider['name'], $provider_name, $facade);
                    }
                }
            });
        }
        
        AliasLoader::getInstance($all_facades)->register();
        $this->facades = [];
    }
    
    protected function getServiceProviders()
    {
        // Get all installed ServiceProviders
        
        return [
            'plugins' => [],
            'themes' => [],
        ];
    }
    
}
