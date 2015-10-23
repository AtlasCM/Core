<?php

namespace spec\Atlas;

use spec\Atlas\ObjectBehavior;
use Prophecy\Argument;

class CoreSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Atlas\Core');
    }
    
    function it_implements_the_core_contract()
    {
        $this->shouldImplement('Atlas\CoreContract');
    }
    
    function it_should_have_a_cahed_services_path()
    {
        $tag = $this->faker->word;
        
        $this->getCachedServicesPath($tag)->shouldBe(app()->basePath() . '/bootstrap/cache/atlas_'. $tag . '_services.json');
    }
    
}
