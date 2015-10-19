<?php namespace Atlas\Constants\Traits;

use Atlas\Constants\Bag;

interface BagAccess
{
    
    protected function _getBag($name)
    {
        return array_get($this->bags, $name, $this->bags, function() use($name) {
            return array_get(array_set($this->bags, $name, new Bag()), $name);
        });
    }
    
    public function getBag($name)
    {
        $segments = explode('.', $name);
        $name = array_shift($segments);
        $sub_bag = implode('.', $segments);
        
        if ($sub_bag) {
            return $this->_getBag($name)->getBag($sub_bag);
        }
        
        return $this->_getBag($name);
    }
    
    public function setBag($name, Bag $bag)
    {
        array_set($this->bags, $name, $bag);
    }
    
    public function __call($name)
    {
        return $this->getBag($name);
    }
    
}
