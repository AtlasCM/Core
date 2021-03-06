<?php namespace Atlas\Constants\Traits;

use Atlas\Constants\Bag;

trait BagAccess
{
    protected function _getBag($name)
    {
        return array_get($this->bags, $name, function () use ($name) {
            return array_get(array_set($this->bags, $name, new Bag($name)), $name);
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
    
    public function addBag($name, Bag $bag)
    {
        if (! array_get($this->bags, $name)) {
            array_set($this->bags, $name, $bag);
        }
    }
    
    public function __call($name, $a)
    {
        return $this->getBag($name);
    }
}
