<?php

namespace %namespace%;

use PhpSpec\Laravel\LaravelObjectBehavior;
use Prophecy\Argument;

class %name% extends LaravelObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('%subject%');
    }
}
