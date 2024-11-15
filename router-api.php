<?php

    require_once 'libs/Router.php';
    require_once 'api/controllers/vehiculos.controller.php';
    require_once 'api/controllers/viajes.controller.php';

    $router = new Router();

    $router->addRoute('vehiculos', 'GET', 'VehiculosController', 'obtenerVehiculos');
    $router->addRoute('vehiculos/:ID', 'GET', 'VehiculosController', 'obtenerVehiculoByID');
    $router->addRoute('vehiculos/:ID', 'DELETE', 'VehiculosController', 'borrarVehiculo');
    $router->addRoute('vehiculos', 'POST', 'VehiculosController', 'agregarVehiculo');


    $router->addRoute('viajes', 'GET', 'ViajesController', 'obtenerViajes');
    $router->addRoute('viajes/:ID', 'GET', 'ViajesController', 'obtenerViajeByID');
    $router->addRoute('viajes', 'POST', 'ViajesController', 'agregarViaje');


    $router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
