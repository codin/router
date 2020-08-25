<?php

declare(strict_types=1);

namespace Codin\Router;

class Route implements RouteInterface
{
    /**
     * @var string
     */
    protected $method;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var mixed
     */
    protected $controller;

    /**
     * @var array
     */
    protected $params;

    /**
     * @param string $method
     * @param string $path
     * @param mixed $controller
     * @param array $params
     */
    public function __construct(string $method, string $path, $controller, array $params = [])
    {
        $this->method = \strtoupper($method);
        $this->path = \rtrim($path, '/');
        $this->controller = $controller;
        $this->params = $params;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function withParams(array $params): self
    {
        return new self($this->method, $this->path, $this->controller, $params);
    }
}
