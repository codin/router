<?php

namespace spec\Codin\Router;

use Codin\Router\RouteInterface;
use PhpSpec\ObjectBehavior;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

class RouteSpec extends ObjectBehavior
{
    /*
    public function it_should_not_match(RequestInterface $request, UriInterface $uri)
    {
        $this->beConstructedWith('GET', '/foo', 'controller@method', []);
        $request->getMethod()->shouldBeCalled()->willReturn('GET');
        $request->getUri()->shouldBeCalled()->willReturn($uri);
        $uri->getPath()->shouldBeCalled()->willReturn('/bar');
        $this->match($request)->shouldReturn(null);
    }

    public function it_should_match_method_path(RequestInterface $request, UriInterface $uri)
    {
        $this->beConstructedWith('GET', '/path', 'controller@method', []);
        $request->getMethod()->shouldBeCalled()->willReturn('GET');
        $request->getUri()->shouldBeCalled()->willReturn($uri);
        $uri->getPath()->shouldBeCalled()->willReturn('/path');
        $this->match($request)->shouldBeAnInstanceOf(RouteInterface::class);
    }

    public function it_should_match_regex(RequestInterface $request, UriInterface $uri)
    {
        $this->beConstructedWith('GET', '/path/.+', 'controller@method', []);
        $request->getMethod()->shouldBeCalled()->willReturn('GET');
        $request->getUri()->shouldBeCalled()->willReturn($uri);
        $uri->getPath()->shouldBeCalled()->willReturn('/path/123');
        $this->match($request)->shouldBeAnInstanceOf(RouteInterface::class);
    }

    public function it_should_match_patterns_and_return_params(RequestInterface $request, UriInterface $uri)
    {
        $this->beConstructedWith('GET', '/path/{foo:num}/path/{bar:slug}/path/{baz}', 'controller@method', []);
        $request->getMethod()->shouldBeCalled()->willReturn('GET');
        $request->getUri()->shouldBeCalled()->willReturn($uri);
        $uri->getPath()->shouldBeCalled()->willReturn('/path/123');
        $this->match($request)->shouldBeAnInstanceOf(RouteInterface::class);
        $this->match($request)->getParams()->shouldEqual(['id' => '123']);
    }
    */
}
