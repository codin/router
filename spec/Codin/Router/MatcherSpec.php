<?php

namespace spec\Codin\Router;

use Codin\Router\RouteInterface;
use Codin\Router\RouterInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument\Token\TypeToken;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

class MatcherSpec extends ObjectBehavior
{
    public function it_should_match_simple_paths(RouterInterface $router, RequestInterface $request, UriInterface $uri, RouteInterface $route)
    {
        $request->getMethod()->shouldBeCalled()->willReturn('GET');
        $request->getUri()->shouldBeCalled()->willReturn($uri);
        $uri->getPath()->shouldBeCalled()->willReturn('/foo');

        $route->getMethod()->shouldBeCalled()->willReturn('GET');
        $route->getPath()->shouldBeCalled()->willReturn('/foo');

        $router->getRoutes()->shouldBeCalled()->willReturn([$route]);

        $this->beConstructedWith($router);
        $this->match($request)->shouldReturn($route);
    }

    public function it_should_match_simple_tokens(RouterInterface $router, RequestInterface $request, UriInterface $uri, RouteInterface $route)
    {
        $request->getMethod()->shouldBeCalled()->willReturn('GET');
        $request->getUri()->shouldBeCalled()->willReturn($uri);
        $uri->getPath()->shouldBeCalled()->willReturn('/foo/123/baz');

        $route->getMethod()->shouldBeCalled()->willReturn('GET');
        $route->getPath()->shouldBeCalled()->willReturn('/foo/{bar}/baz');
        $route->withParams(['bar' => '123'])->shouldBeCalled()->willReturn($route);
        $route->getParams()->shouldBeCalled()->willReturn(['bar' => '123']);

        $router->getRoutes()->shouldBeCalled()->willReturn([$route]);

        $this->beConstructedWith($router);
        $this->match($request)->shouldReturn($route);
        $this->match($request)->getParams()->shouldReturn(['bar' => '123']);
    }

    public function it_should_match_token_types(RouterInterface $router, RequestInterface $request, UriInterface $uri, RouteInterface $route)
    {
        $request->getMethod()->shouldBeCalled()->willReturn('GET');
        $request->getUri()->shouldBeCalled()->willReturn($uri);
        $uri->getPath()->shouldBeCalled()->willReturn('/foo/123/baz');

        $route->getMethod()->shouldBeCalled()->willReturn('GET');
        $route->getPath()->shouldBeCalled()->willReturn('/foo/{bar:num}/baz');
        $route->withParams(new TypeToken('array'))->shouldBeCalled()->willReturn($route);
        $route->getParams()->shouldBeCalled()->willReturn(['bar' => '123']);

        $router->getRoutes()->shouldBeCalled()->willReturn([$route]);

        $this->beConstructedWith($router);
        $this->match($request)->shouldReturn($route);
        $this->match($request)->getParams()->shouldReturn(['bar' => '123']);
    }

    public function it_should_match_patterns(RouterInterface $router, RequestInterface $request, UriInterface $uri, RouteInterface $route)
    {
        $request->getMethod()->shouldBeCalled()->willReturn('GET');
        $request->getUri()->shouldBeCalled()->willReturn($uri);
        $uri->getPath()->shouldBeCalled()->willReturn('/foo/bar/baz');

        $route->getMethod()->shouldBeCalled()->willReturn('GET');
        $route->getPath()->shouldBeCalled()->willReturn('/foo/[a-z]+/baz');
        $route->withParams([])->shouldBeCalled()->willReturn($route);
        $route->getParams()->shouldBeCalled()->willReturn([]);

        $router->getRoutes()->shouldBeCalled()->willReturn([$route]);

        $this->beConstructedWith($router);
        $this->match($request)->shouldReturn($route);
        $this->match($request)->getParams()->shouldReturn([]);
    }
}
