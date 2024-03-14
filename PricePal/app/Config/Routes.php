<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

use App\Controllers\Pages;
$routes->get('/', [Pages::class, 'index']);
// $routes->get('pages', [Pages::class, 'index']);
// $routes->get('(:segment)', [Pages::class, 'index']);
$routes->get('PricePal/assets/(:any)', 'assets\Images');
//$route['assets/(:any)'] = 'assets/$1';