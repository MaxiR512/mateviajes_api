<?php

require_once 'api/models/viajes.model.php';
require_once 'api/models/vehiculos.model.php';
require_once 'api/views/api.views.php';
require_once 'api/controllers/usuarios.controller.php';
// requiero el modelo y la vista para que funcionen junto con el controlador

class ViajesController {
    protected $modelViajes;
    protected $modelVehiculos;
    protected $view;

    public function __construct() {

        $this ->data = file_get_contents("php://input");

        $this->modelVehiculos = new VehiculosModel();
        $this->modelViajes = new ViajesModel();
        $this->view = new Views();
        $this->usercontroller= new UsuariosController();
    }

    private function getData() {
        return json_decode($this->data);
    }

    public function obtenerViajes() {
        if(isset($_GET['orderBy'])){
            $orden = $_GET ['orderBy'];
        }else{
                $orden=null;
        }
        if(isset($_GET['filter'])){
            $filtro = $_GET ['filter'];
        }else{
                $filtro=null;
        }
    $viajes = $this->modelViajes->getViajes($filtro, $orden);
        $this->view->response($viajes, 200);
    }
}