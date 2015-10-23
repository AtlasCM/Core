<?php

namespace %namespace%;

use spec\Atlas\ObjectBehavior;
use Prophecy\Argument;

class %name% extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('%subject%');
    }
}
