<?php namespace Atlas\Constants\Contracts;

interface Bag
{
    public function load($file = null);
    
    public function reload();
    
    public function getValue($key);
}
