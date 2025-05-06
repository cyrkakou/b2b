<?php 
$routes->group('dashboard', ['namespace' => 'App\Modules\Dashboard\Controllers'], function ($routes) {
    $routes->get('/', 'Dashboard::index');
    $routes->get('geojson', 'Dashboard::geojson');
    $routes->get('geopoint', 'Dashboard::geopoint');
    //Test
    $routes->group('dashboard', function ($routes) {
        $routes->add('/', 'Dashboard::index');
        $routes->add('(:any)', 'Dashboard::$1');
    });        
});
?>
