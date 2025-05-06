<?php
$routes->group('ressources', ['namespace' => 'App\Modules\Ressources\Controllers'], function ($routes) {
    $routes->group('participants', function ($routes) {
        $routes->add('/', 'Participants::index');
        $routes->add('list/', 'Participants::do_list');
        
        // Agenda and availability routes
        $routes->get('agenda/(:num)', 'Participants::viewAgenda/$1');
        $routes->get('available-slots/(:num)', 'Participants::getAvailableSlots/$1');
        $routes->match(['get', 'post'], 'manage-availability', 'Participants::manageAvailability');
        
        // Appointment routes
        $routes->post('request-appointment/(:num)', 'Participants::requestAppointment/$1');
        $routes->get('manage-appointments', 'Participants::manageAppointments');
        $routes->post('update-appointment/(:num)', 'Participants::updateAppointment/$1');
        
        $routes->add('(:any)', 'Participants::$1');
    });
});
?>
