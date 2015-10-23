<?php

namespace spec\Atlas;

use Faker\Factory as Faker;

use PhpSpec\Laravel\LaravelObjectBehavior;
use Prophecy\Argument;

abstract class ObjectBehavior extends LaravelObjectBehavior
{
    public $faker;
    
    function __construct()
    {
        $this->faker = Faker::create();
    }
}