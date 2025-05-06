<?php 
$routes->group('profile', ['namespace' => 'App\Modules\Profile\Controllers'], function ($routes) {
    $routes->get('/', 'Profile::index');
});
?>
