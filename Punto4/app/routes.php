 <?php

    $router->get('', 'PagesController@home');

    $router->get('not_found', 'ProjectController@notFound');
    $router->get('internal_error', 'ProjectController@internalError');

    $router->get('turnos', 'Turnoscontroller@index');
    $router->get('turnos/nuevoTurno', 'Turnoscontroller@nuevoTurno');
    $router->post('turnos/registrarTurno', 'Turnoscontroller@registrarTurno');
    $router->get('turnos/resumen', 'Turnoscontroller@resumen');

