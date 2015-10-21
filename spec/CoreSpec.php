<?php

namespace spec\Atlas;

use PhpSpec\Laravel\LaravelObjectBehavior;
use Prophecy\Argument;

class CoreSpec extends LaravelObjectBehavior
{
    
    function it_is_initializable()
    {
        $this->shouldHaveType('Atlas\Core');
    }
    
    function it_should_have_a_cahed_services_path()
    {
        $tag = 'tag';
        
        $this->getCachedServicesPath($tag)->shouldBe(app()->basePath() . '/bootstrap/cache/atlas_'. $tag . '_services.json');
    }
    
}
