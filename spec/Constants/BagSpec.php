<?php

namespace spec\Atlas\Constants;

use PhpSpec\Laravel\LaravelObjectBehavior;
use Prophecy\Argument;

class BagSpec extends LaravelObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Atlas\Constants\Bag');
    }
    
    function it_implements_the_core_contract()
    {
        $this->shouldImplement('Atlas\Constants\Contracts\Bag');
    }
}
