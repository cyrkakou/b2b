<?php
$routes->group('auth', ['namespace' => 'App\Modules\Auth\Controllers'], function ($routes) {
    $routes->add('logout', 'Auth::logout');
    $routes->add('signup', 'Auth::signup');
    $routes->group('users', function ($routes) {
        $routes->add('/', 'Users::index');
        $routes->add('(:any)', 'Users::$1');
    });
    $routes->group('roles', function ($routes) {
        $routes->add('/', 'Roles::index');
        $routes->add('(:any)', 'Roles::$1');
    });
    $routes->group('permissions', function ($routes) {
        $routes->add('/', 'Permissions::index');
        $routes->add('(:any)', 'Permissions::$1');
    });
    $routes->group('components', function ($routes) {
        $routes->add('/', 'Components::index');
        $routes->add('(:any)', 'Components::$1');
    });
    $routes->group('strategies', function ($routes) {
        $routes->add('/', 'Strategies::index');
        $routes->add('(:any)', 'Strategies::$1');
    });
});
