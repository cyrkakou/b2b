<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('App\Modules\Ressources\Controllers\Participants');
$routes->setDefaultMethod('create');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/admin', '\App\Modules\Auth\Controllers\Auth::index');
$routes->get('/login', '\App\Modules\Auth\Controllers\Auth::index');
$routes->get('/', '\App\Modules\Ressources\Controllers\Participants::create');

//commande
$routes->group('commandes', ['namespace' => 'App\Modules\Client\Controllers'], function ($routes) {
    $routes->add('/', 'Commandes::index');
    $routes->add('(:any)', 'Commandes::$1');
});
$routes->group('api', ['namespace' => 'App\Modules\Api\Controllers'], function ($routes) {
    //Auth
    $routes->group('auth', function ($routes) {
        $routes->add('/', 'Auth::index');
        $routes->add('(:any)', 'Auth::$1');
    });
});

//$routes->get('helloworld', '\App\Modules\Module1\Controllers\Test::index');

//$routes->get('/module1/test', '\App\Modules\Module1\Controllers\Test::index');

/**
 * --------------------------------------------------------------------
 * HMVC Routing
 * --------------------------------------------------------------------
 */

foreach(glob(APPPATH . 'Modules/*', GLOB_ONLYDIR) as $item_dir)
{
    $file = ($item_dir . '/Config/Routes.php');

    if (file_exists( $file ))
    {
        require_once( $file);
    }else{
        $module_name = basename($item_dir);
    
    }   
}
