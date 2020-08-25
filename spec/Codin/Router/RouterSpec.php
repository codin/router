<?php

namespace spec\Codin\Router;

use Codin\Router\RouteInterface;
use PhpSpec\ObjectBehavior;

class RouterSpec extends ObjectBehavior
{
    public function it_should_append_routes(RouteInterface $route)
    {
        $this->append($route);
        $this->getRoutes()->shouldContain($route);
    }
}
