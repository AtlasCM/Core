<?php namespace Atlas\Installer;

use DB;
use Schema;
use Constants;
use Exception;

use Atlas\Installer\Contracts\Installer as InstallerContract;

class Installer implements InstallerContract
{
    /**
     * @protected string Atlas Metadata table
     */
    protected $meta_table;
    
    /**
     * @protected string Atlas Metadata table key field
     */
    protected $meta_key;
    
    /**
     * @protected string Atlas Metadata table value field
     */
    protected $meta_value;
    
    public function __construct()
    {
        $this->meta_table = Constants::db()->META_TABLE;
        $this->meta_key = Constants::db()->META_KEY;
        $this->meta_value = Constants::db()->META_VALUE;
    }
    
    /**
     * {@inheritdoc}
     */
    public function environmentIsConfigured()
    {
        return env('ATLAS_INSTALLED', false);
    }
    
    /**
     * {@inheritdoc}
     */
    public function setEnv($variables)
    {
    }
    
    public function dbIsConfigured()
    {
        try {
            DB::connection()->getDatabaseName();
        } catch(Exception $e) {
            return false;
        }
        
        return true;
    }
    
    /**
     * {@inheritdoc}
     */
    public function dbIsInstalled()
    {
        try {
            $table_exists = Schema::hasTable($this->meta_table);
        } catch(Exception $e) {
            return false;
        }
        
        return Schema::hasTable($this->meta_table) ? ((bool) DB::table($this->meta_table)->where($this->meta_name, 'is_installed')->where('meta_value', true)->count()) : false;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getAppKey()
    {
        DB::table('AtlasMeta')->where('meta_name', 'is_installed');
    }
    
    /**
     * {@inheritdoc}
     */
    public function migrateDb()
    {
    }
    
    /**
     * {@inheritdoc}
     */
    public function setSuperAdmin($details)
    {
    }
}
