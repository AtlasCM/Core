<?php namespace Atlas;

interface CoreContract
{
    public function boot();
    
    /**
     * Get the Cached services path.
     *
     * @return string Cached services path
     */
    public function getCachedServicesPath($tag);
    
    /**
     * Check if Atlas is installed.
     *
     * @return bool
     */
    public function isInstalled();
    
    /**
     * Register Atlas' Facades.
     *
     * @return void
     */
    public function registerFacades($provider, $facades);
    
    public function register();
}
