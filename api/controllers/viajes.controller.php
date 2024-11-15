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
        $filtro = isset($_GET['filter']) ? $_GET['filter'] : null;
        $orden = isset($_GET['orderBy']) ? $_GET['orderBy'] : null;
        $limit = isset($_GET['limit']) ? $_GET['limit'] : null;
        $pag = isset($_GET['page']) ? $_GET['page'] : 1;
        if($viajes = $this->modelViajes->getViajes($filtro, $orden, $limit, $pag)){
            $cantidad= count($viajes);
            $this->view->response("Se muestra/ n << ".$cantidad." >> resultado/ s",200);
            $this->view->response($viajes,200);
        }else{
            $this->view->response("No hay elementos para mostrar, revisar los params",400);
        }
    }

    public function obtenerViajeByID($params) {
        $id = $params [':ID'];
        $viaje = $this->modelViajes->getViajeById($id);
        if($viaje) {
            $this->view->response($viaje,200);
        } else {
            $this->view->response("Viaje no encontrado",404);
        }
    }
}