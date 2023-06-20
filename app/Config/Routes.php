<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Core');
$routes->setDefaultMethod('dashboard');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Core::dashboard', ['filter' => 'defaultRoute']);

//---------- Modules ----------//
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/profile', 'Profile::index', ['filter' => 'isLogin']);
$routes->get('/menulist', 'Menulist::index');
$routes->get('/cart', 'Cart::index', ['filter' => 'isLogin']);
$routes->get('/order', 'Order::index', ['filter' => 'isLogin']);
$routes->get('/critic', 'Critic::index', ['filter' => 'isLogin']);

$routes->get('/menulist/detail', 'Menulist::detail');
$routes->get('/order/detail', 'Order::detail');

$routes->get('/noaccess', 'Noaccess::index');
$routes->get('/register', 'Auth::register');
$routes->get('/login', 'Auth::login');

$routes->get('/upload', 'Upload::index', ['filter' => 'isAdmin']);
$routes->get('/discount', 'Discount::index');
$routes->get('/orderadmin', 'Order::index_admin');
$routes->get('/report', 'Report::index');
$routes->get('/criticadmin', 'Critic::index_admin');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
