<?php namespace Atlas\Core\Installer;

use Atlas\Core\Installer\Contracts\Installer as InstallerContract;

class Installer implements InstallerContract
{
    
    /**
     * @inheritdoc
     */
    public function environmentIsConfigured()
    {
        return env('ATLAS_INSTALLED', false);
    }
    
    /**
     * @inheritdoc
     */
    public function setEnv($variables)
    {
        
    }
    
    /**
     * @inheritdoc
     */
    public function dbIsInstalled()
    {
        return Schema::hasTable('AtlasMeta') ? ((bool) DB::table('AtlasMeta')->where('meta_name', 'is_installed')->where('meta_value', true)->count()) : false;
    }
    
    /**
     * @inheritdoc
     */
    public function getAppKey()
    {
        DB::table('AtlasMeta')->where('meta_name', 'is_installed')
    }
    
    /**
     * @inheritdoc
     */
    public function migrateDb()
    {
        
    }
    
    /**
     * @inheritdoc
     */
    public function setSuperAdmin($details)
    {
        
    }
    
}
