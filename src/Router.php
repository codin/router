<?php

declare(strict_types=1);

namespace Codin\Router;

class Router implements RouterInterface
{
    /**
     * @var array<RouteInterface>
     */
    protected $routes;

    /**
     * @var array
     */
    protected $segments = [];

    /**
     * @var array
     */
    protected $namespaces = [];

    public function __construct(array $routes = [])
    {
        foreach ($routes as $route) {
            $this->append($route);
        }
    }

    /**
     * @return array<RouteInterface>
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function append(RouteInterface $route): void
    {
        $this->routes[] = $route;
    }

    protected function addOptions(array $options): void
    {
        if (isset($options['prefix'])) {
            $this->segments[] = \rtrim($options['prefix'], '/');
        }

        if (isset($options['namespace'])) {
            $this->namespaces[] = '\\'.$options['namespace'];
        }
    }

    protected function removeOptions(array $options): void
    {
        if (isset($options['prefix'])) {
            \array_pop($this->segments);
        }

        if (isset($options['namespace'])) {
            \array_pop($this->namespaces);
        }
    }

    protected function getPrefix(): string
    {
        return \implode('', $this->segments);
    }

    protected function getNamespace(): string
    {
        return \implode('', $this->namespaces) . '\\';
    }

    public function group(array $options, callable $group): void
    {
        $this->addOptions($options);

        $group($this);

        $this->removeOptions($options);
    }

    /**
     * Create a Route in the current name space
     *
     * @param string $method
     * @param string $path
     * @param mixed $controller
     * @return RouteInterface
     */
    public function create(string $method, string $path, $controller): RouteInterface
    {
        return new Route(
            $method,
            $this->getPrefix().$path,
            \is_string($controller) ? $this->getNamespace().$controller : $controller
        );
    }

    /**
     * Short cut for create() + append()
     *
     * @param string $method
     * @param array $args
     */
    public function __call(string $method, array $args): void
    {
        $route = $this->create(\strtoupper($method), $args[0], $args[1]);

        $this->append($route);
    }
}
