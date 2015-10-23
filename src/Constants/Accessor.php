<?php namespace Atlas\Constants;

use Storage;
use Atlas\Constants\Traits\BagAccess;

class Accessor
{
    use BagAccess;
    
    const BAG_PATH = __DIR__ . '/bags';
    
    protected $bags;
    
    public function __construct()
    {
        $disk = Storage::createLocalDriver([
            'driver' => 'local',
            'root'   => __DIR__ . '/bags',
        ]);
        
        $bags = $disk->allFiles();
        
        foreach ($bags as $bag) {
            $name = str_replace('.php', '', $bag);
            
            if (! str_contains($bag, '/')) {
                array_set($this->bags, $name, new Bag($name, $bag));
            } else {
                $full_name = str_replace('/', '.', $name);
                $parents = explode('/', $name);
                $name = array_pop($parents);
                $parent = implode('.', $parents);
                
                $this->getBag($parent)->addBag($name, new Bag($full_name, $bag));
            }
        }
    }
}
