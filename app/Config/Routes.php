<?php

namespace Config;

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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

 //---------- Core ----------//

$routes->get('/', 'Core::dashboard', ['filter' => 'defaultRoute']);
$routes->get('/core', 'Core::dashboard', ['filter' => 'defaultRoute']);
$routes->get('/register', 'Auth::register');
$routes->get('/login', 'Auth::login', ['filter' => 'checkLogin']);
$routes->get('/home', 'Home::index');

//---------- Modules ----------//
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'isLogin']);
$routes->get('/sample-page', 'Samplepage::sample_page', ['filter' => 'isLogin']);
$routes->get('/sample-data-tables', 'Samplepage::sample_data_tables', ['filter' => 'isLogin']);
$routes->get('/profile', 'Profile::index', ['filter' => 'isLogin']);
// $routes->get('/filelist', 'Filelist::index');
// $routes->get('/filelist/detail', 'Filelist::detail');
// $routes->get('/upload', 'Upload::index');

if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
