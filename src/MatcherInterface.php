<?php

declare(strict_types=1);

namespace Codin\Router;

use Psr\Http\Message\RequestInterface;

interface MatcherInterface
{
    public function match(RequestInterface $request): RouteInterface;
}
