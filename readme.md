# Router

Simple routing component

```php
$routes = new Router();

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
$route = $matcher->match($psr7request);
$route->getController(); // returns controller@method
```
