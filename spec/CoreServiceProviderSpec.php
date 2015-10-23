<?php

namespace spec\Atlas;

use Illuminate\Foundation\Application;
use Illuminate\Config\Repository;

use spec\Atlas\ObjectBehavior;
use Prophecy\Argument;

class CoreServiceProviderSpec extends ObjectBehavior
{
    function let(Application $app, Repository $cfg)
    {
        $cfg->get(Argument::type('string'), Argument::any())->willReturn([]);
        $cfg->set(Argument::type('string'), Argument::any())->willReturn([]);
        
        $app->offsetGet('config')->willReturn($cfg);
        
        $this->beConstructedWith($app);
    }
    
    function it_is_initializable()
    {
        $this->shouldHaveType('Atlas\CoreServiceProvider');
    }
    
    function it_implements_base_service_provider()
    {
        $this->shouldImplement('Illuminate\Support\ServiceProvider');
    }
    
    function it_should_provide_core_contract()
    {
        $this->provides()->shouldContain('Atlas\CoreContract');
    }
    
    function it_should_register_core_contract(Application $app)
    {
        $app->offsetGet(Argument::type('string'))->shouldBeCalled();
        $app->singleton('Atlas\CoreContract', 'Atlas\Core')->shouldBeCalled();
        
        $this->register();
    }
    
    function it_should_boot_the_core_if_atlas_is_installed(\Atlas\CoreContract $core)
    {
        $core->isInstalled()->willReturn(true);
        $core->boot()->shouldBeCalled();
        
        $this->boot($core);
    }
    
    function it_should_not_boot_the_core_if_atlas_is_not_installed(\Atlas\CoreContract $core)
    {
        $core->isInstalled()->willReturn(false);
        $core->boot()->shouldNotBeCalled();
        
        $this->boot($core);
    }
}
