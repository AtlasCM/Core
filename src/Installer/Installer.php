<?php namespace Atlas\Installer;

use DB;
use Schema;
use Storage;
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
    
    /**
     * @protected \League\Flysystem\Filesystem
     */
    protected $disk;
    
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
        $disk = $this->getDisk();
        
        if (! $disk->exists('.env')) {
            $disk->copy('atlas.env', '.env');
        }
        
        $dotenv = $disk->get('.env');
        
        $env = collect(explode(PHP_EOL, $dotenv))->map(function ($kv, $line) {
            if (str_contains($kv, '=')) {
                $kv = explode('=', $kv);
                list($key, $value) = $kv;
                
                return compact('key', 'value', 'line');
            }
            
            return ['key' => $line, 'value' => null, 'line' => $line];
        })->keyBy('key');
        
        $variables = collect($variables)->map(function ($value, $key) use ($env) {
            $line = $key == 'ATLAS_INSTALLED' ? -INF : ($env->has($key) ? $env->get($key)['line'] : INF);
            
            return compact('key', 'value', 'line');
        });
        if ($variables->has('ATLAS_INSTALLED')) {
            $variables->put(0, ['key' => 0, 'value' => null, 'line' => -INF + 1]);
        }
        
        $env = $env->merge($variables)->sortBy('line')->reduce(function ($env_str, $kv) {
            extract($kv);
            
            return $env_str . (is_string($key) ? $key . '=' . (is_string($value) ? $value : var_export($value, true)) : '') . PHP_EOL;
        });
        $env = trim(preg_replace('/\n\n\n*/', PHP_EOL . PHP_EOL, $env));
        
        if ($env !== $dotenv) {
            $disk->put('.env', $env);
        }
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
    
    protected function getDisk()
    {
        if ($this->disk) {
            return $this->disk;
        }
        
        return $this->disk = Storage::createLocalDriver([
            'driver' => 'local',
            'root'   => base_path(),
        ]);
    }
}
