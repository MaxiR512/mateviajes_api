<?php
    require_once 'libs/Router.php';
    require_once 'api/controllers/vehiculos.controller.php';
    require_once 'api/controllers/viajes.controller.php';

    $router = new Router();


    $router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);