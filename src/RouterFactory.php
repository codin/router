<?php

declare(strict_types=1);

namespace Codin\Router;

use InvalidArgumentException;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RecursiveRegexIterator;
use RegexIterator;

class RouterFactory
{
    public static function createFromPath(string $path): RouterInterface
    {
        if (!is_dir($path)) {
            throw new InvalidArgumentException("Router path '{$path}' does not exist");
        }
        $dir = new RecursiveDirectoryIterator($path);
        $it = new RecursiveIteratorIterator($dir);
        $filter = new RegexIterator($it, '/^.+\.php$/i', RecursiveRegexIterator::GET_MATCH);
        $router = new Router();
        foreach ($filter as $file) {
            $routes = require $file->pathname();
            array_walk($routes, [$router, 'append']);
        }
        return $router;
    }
}
