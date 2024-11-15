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

    public function agregarViaje(){
        if($this->usercontroller->auth_basic()){
            $nuevo = $this->getData();
            
            if(!isset($nuevo->destino) || empty($nuevo->destino)){
                $this->view->response("No se agrega porque el campo << Destino >> esta vacío",400 );
                return;
            }
            if(!isset($nuevo->fecha) || empty($nuevo->fecha)){
                $this->view->response("No se agrega porque el campo << Fecha >> esta vacío",400 );
                return;
            }
            if(!isset($nuevo->horario) || empty($nuevo->horario)){
                $this->view->response("No se agrega porque el campo << Horario >> esta vacío",400 );
                return;
            }
            if(!isset($nuevo->pasajeros) || empty($nuevo->pasajeros)){
                $this->view->response("No se agrega porque el campo << Pasajeros >> esta vacío",400 );
                return;
            }
            if(!isset($nuevo->fk_vehiculo) || empty($nuevo->fk_vehiculo)){
                $this->view->response("No se agrega porque el campo << Vehículo >> esta vacío",400 );
                return;
            }
            if(!($this->modelVehiculos->getVehiculoById($nuevo->fk_vehiculo))){
                $this->view->response("No existe el vehiculo",400 );
                return;
            }
            if(!isset($nuevo->descripcion) || empty ($nuevo->descripcion)){
                $this->view->response("No se agrega porque el campo << Info >> esta vacío",400 );
                return;
            }
            $this->modelViajes->crearviaje($nuevo->destino, $nuevo->fecha, $nuevo->horario, $nuevo->pasajeros, $nuevo->fk_vehiculo, $nuevo->descripcion);
            $this->view->response("Viaje creado con éxito",201);
        }else{
            $this->view->response("Acceso denegado",401);
        }
    }
}