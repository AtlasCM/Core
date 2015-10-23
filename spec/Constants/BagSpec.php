<?php

namespace spec\Atlas\Constants;

use spec\Atlas\ObjectBehavior;
use Prophecy\Argument;

class BagSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith($this->faker->word);
    }
    
    function it_is_initializable()
    {
        $this->shouldHaveType('Atlas\Constants\Bag');
    }
    
    function it_implements_the_core_contract()
    {
        $this->shouldImplement('Atlas\Constants\Contracts\Bag');
    }
}
