# Router

Simple routing component

```php
$routes = new Router(); // RouterFactory::createFromPath('path/to/definitions');

$route = $routes->create('get', '/path/to/resource', 'controller@method');
$routes->append($route);

// or shortcut
$routes->get('/path/to/resource', 'controller@method');

// using grouping
$routes->group([
    'prefix' => '/api',
    'namespace' => 'API\\',
], static function ($routes) {
    $routes->get('/path/to/resource', 'controller@method');
})

$psr7request = new Request('post', 'foo/bar');
$matcher = new Matcher($routes);
try {
    $route = $matcher->match($psr7request);
} catch (Exceptions\RouteNotFound $e) {
    // do something with 404
}
$route->getController(); // returns controller@method
```
