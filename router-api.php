<?php

    require_once 'libs/Router.php';
    require_once 'api/controllers/vehiculos.controller.php';
    require_once 'api/controllers/viajes.controller.php';

    $router = new Router();

    $router->addRoute('vehiculos', 'GET', 'VehiculosController', 'obtenerVehiculos');

    $router->addRoute('viajes', 'GET', 'ViajesController', 'obtenerViajes');

    $router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
