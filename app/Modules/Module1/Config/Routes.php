<?php 
$routes->group('module1', ['namespace' => 'App\Modules\Module1\Controllers'], function ($routes) {
    $routes->get('/', 'Test::index');
    //Test
    $routes->group('test', function ($routes) {
        $routes->add('/', 'Test::index');
        $routes->add('(:any)', 'Test::$1');        
    });        
});
?>