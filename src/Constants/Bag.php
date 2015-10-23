<?php namespace Atlas\Constants;

use Atlas\Constants\Traits\BagAccess;
use Atlas\Constants\Contracts\Bag as BagContract;

class Bag implements BagContract
{
    use BagAccess;
    
    protected $name;
    
    protected $file;
    
    protected $bags;
    
    protected $contents = [];
    
    public function __construct($name, $file = null)
    {
        $this->name = $name;
        
        if ($file) {
            $this->file = $file;
            $this->load();
        }
    }
    
    protected function getContentsFromFile($file)
    {
        $contents = include $file;
        
        foreach ($contents as $key => $value) {
            if (! preg_match('/^[A-Z][A-Z0-9_-]+$/', $key)) {
                unset($contents[$key]);
                $contents[strtoupper(ltrim($key, '0123456789-_'))] = $value;
            }
        }
        
        return $contents;
    }
    
    public function load($file = null)
    {
        $file = Accessor::BAG_PATH . '/' . ($file ?: $this->file);
        
        if (file_exists($file)) {
            $this->contents = array_merge($this->contents, $this->getContentsFromFile($file));
        }
        
        return $this;
    }
    
    public function reload()
    {
        $this->contents = [];
        $this->load();
        
        return $this;
    }
    
    public function getValue($key)
    {
        return array_get($this->contents, $key);
    }
    
    public function __get($key)
    {
        return $this->getValue($key);
    }
}
