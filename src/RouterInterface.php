<?php

declare(strict_types=1);

namespace Codin\Router;

interface RouterInterface
{
    public function append(RouteInterface $route): void;

    public function getRoutes(): array;

    public function group(array $options, callable $group): void;

    /**
     * Create a Route in the current name space
     *
     * @param string $method
     * @param string $path
     * @param mixed $controller
     * @return RouteInterface
     */
    public function create(string $method, string $path, $controller): RouteInterface;
}
