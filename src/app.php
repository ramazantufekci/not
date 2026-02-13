<?php

use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();
$routes->add('hello', new Routing\Route('/hello/{name}', ['name' => 'World']));
$routes->add('not', new Routing\Route('/not'));

return $routes;
