<?php

    require_once 'libs/Router.php';
    require_once 'api/controllers/vehiculos.controller.php';
    require_once 'api/controllers/viajes.controller.php';
    require_once 'api/controllers/comentarios.controller.php';

    $router = new Router();

    $router->addRoute('vehiculos', 'GET', 'VehiculosController', 'obtenerVehiculos');
    $router->addRoute('vehiculos/:ID', 'GET', 'VehiculosController', 'obtenerVehiculoByID');
    $router->addRoute('vehiculos/:ID', 'DELETE', 'VehiculosController', 'borrarVehiculo');
    $router->addRoute('vehiculos', 'POST', 'VehiculosController', 'agregarVehiculo');
    $router->addRoute('vehiculos/:ID', 'PUT', 'VehiculosController', 'actualizarVehiculo');

    $router->addRoute('viajes', 'GET', 'ViajesController', 'obtenerViajes');
    $router->addRoute('viajes/:ID', 'GET', 'ViajesController', 'obtenerViajeByID');
    $router->addRoute('viajes/:ID', 'DELETE', 'ViajesController', 'borrarViaje');
    $router->addRoute('viajes', 'POST', 'ViajesController', 'agregarViaje');
    $router->addRoute('viajes/:ID', 'PUT', 'ViajesController', 'actualizarViaje');

    $router->addRoute('comentarios', 'GET', 'ComentariosController', 'obtenerComentarios');
    $router->addRoute('comentarios/:ID', 'GET', 'ComentariosController', 'obtenerComentarioByID');
    $router->addRoute('comentarios/:ID', 'DELETE', 'ComentariosController', 'borrarComentario');
    $router->addRoute('comentarios', 'POST', 'ComentariosController', 'agregarComentario');

    $router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
