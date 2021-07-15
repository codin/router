<?php

declare(strict_types=1);

namespace Codin\Router;

use Psr\Http\Message\RequestInterface;

class Matcher implements MatcherInterface
{
    protected RouterInterface $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    protected function getNamedPattern(string $name): string
    {
        $aliases = [
            'num' => '([0-9]+)',
            'alpha' => '([A-Za-z]+)',
            'alnum' => '([A-Za-z0-9]+)',
            'slug' => '([a-zA-Z-_]+)',
            'any' => '(.*)',
        ];
        if (\array_key_exists($name, $aliases)) {
            return $aliases[$name];
        }
        return '([^/]+)';
    }

    protected function parse(string $path): callable
    {
        $pattern = '~(?<segments>\{(?<params>[^:]+)(\:(?<types>[^\}]+))?\})~';
        $matches = \preg_match_all($pattern, $path, $captures);

        if (false === $matches) {
            throw Exceptions\RoutePatternError::create(\preg_last_error());
        }

        foreach ($captures['segments'] ?? [] as $index => $segment) {
            $path = \str_replace($segment, $this->getNamedPattern($captures['types'][$index]), $path);
        }

        $tokens = $captures['params'] ?? [];

        return static function (string $requestPath) use ($path, $tokens): ?array {
            $match = \preg_match('~^'.$path.'$~', $requestPath, $captures);

            if (false === $match) {
                throw Exceptions\RoutePatternError::create(\preg_last_error());
            }

            if (0 === $match) {
                return null;
            }

            $params = \array_combine($tokens, \array_slice($captures, 1));

            if (false === $params) {
                throw new Exceptions\RoutePatternError('number of tokens does not match combine values');
            }

            return $params;
        };
    }

    public function match(RequestInterface $request): RouteInterface
    {
        foreach ($this->router->getRoutes() as $route) {
            if ($route->getMethod() !== RouteInterface::METHOD_ANY && $route->getMethod() !== $request->getMethod()) {
                continue;
            }

            if ($request->getUri()->getPath() === $route->getPath()) {
                return $route;
            }

            $compiled = $this->parse($route->getPath());
            $params = $compiled($request->getUri()->getPath());

            if (null === $params) {
                continue;
            }

            return $route->withParams($params);
        }

        throw new Exceptions\RouteNotFound(sprintf(
            'Route not found. %s %s',
            $request->getMethod(),
            $request->getUri()
        ));
    }
}
