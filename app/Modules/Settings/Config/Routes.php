<?php
$routes->group('settings', ['namespace' => 'App\Modules\Settings\Controllers'], function ($routes) {
    $routes->group('sectors', function ($routes) {
        $routes->add('/', 'Sectors::index');
        $routes->add('(:any)', 'Sectors::$1');
    });
    $routes->group('goals', function ($routes) {
        $routes->add('/', 'Goals::index');
        $routes->add('(:any)', 'Sectors::$1');
    });
    $routes->group('activities', function ($routes) {
        $routes->add('/', 'Activities::index');
        $routes->add('(:any)', 'Sectors::$1');
    });
    $routes->group('profiles', function ($routes) {
        $routes->add('/', 'Profiles::index');
        $routes->add('(:any)', 'Sectors::$1');
    });
});
