<?php namespace Atlas\Constants;

use CupOfTea\Package\SubPackage;

use Atlas\Constants\Traits\BagAccess;

class Accessor
{
    
    use BagAccess;
    
    protected $bags;
    
    public function __construct()
    {
        $disk = Storage::createLocalDriver([
            'driver' => 'local',
            'root'   => __DIR__ . '/bags',
        ]);
        
        $bags = $disk->allFiles();
        
        foreach($bags as $bag) {
            $name = $bag;
            array_set($this->bags, $name, new Bag($bag));
        }
    }
    
}
