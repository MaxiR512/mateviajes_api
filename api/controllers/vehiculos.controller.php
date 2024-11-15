<?php

require_once 'api/models/vehiculos.model.php';
require_once 'api/views/api.views.php';
require_once 'api/controllers/usuarios.controller.php';

class VehiculosController {
    protected $model;
    protected $view;

    public function __construct() {
        
        $this->data = file_get_contents("php://input");
        
        $this->model = new VehiculosModel();
        $this->view = new Views();
        $this->usercontroller = new UsuariosController();

    }

    private function getData(){
        return json_decode($this->data);
    }

    public function obtenerVehiculos(){
        $limit = isset($_GET['limit']) ? $_GET['limit'] : null;
        $pag = isset($_GET['page']) ? $_GET['page'] : 1;
        $orden = isset($_GET['orderBy']) ? $_GET['orderBy'] : null;
        $filtro = isset($_GET['filter']) ? $_GET['filter'] : null;
        if($vehiculos = $this->model->getVehiculos($filtro, $orden, $limit, $pag)){
            $cantidad= count($vehiculos);
            $this->view->response("Se muestra/ n << ".$cantidad." >> resultado/ s",200);
            $this->view->response($vehiculos,200);
        }else{
            $this->view->response("No hay elementos para mostrar, revisar los params",400);
        }
    }

    public function obtenerVehiculoByID($params){
        $id = $params [':ID'];
        $vehiculo= $this->model->getVehiculoById($id);
        if($vehiculo){
        $this->view->response($vehiculo,200);
    }
    else{
            $this->view->response("vehiculo no encontrado",404);
        }
    }

    public function borrarVehiculo($params){
        if($this->usercontroller->auth_basic()){
            $id = $params [':ID'];
            if($this->model->getVehiculoById($id)){
                $this->model->deleteVehiculoById($id);
                $this->view->response("Vehiculo eliminado con exito",200);
            }else{
                $this->view->response("Vehiculo no encontrado",404);
            }
        }else{
            $this->view->response("Acceso denegado",401);
        }
    }

    public function agregarVehiculo(){
        if($this->usercontroller->auth_basic()){
            $nuevo = $this->getData();
            
            if(!isset($nuevo->marca) || empty($nuevo->marca)){
                $this->view->response("No se agrega porque el campo << Marca >> esta vacío",400 );
                return;
            }
            if(!isset($nuevo->modelo) || empty($nuevo->modelo)){
                $this->view->response("No se agrega porque el campo << Modelo >> esta vacío",400 );
                return;
            }
            if(!isset($nuevo->anio) || empty($nuevo->anio)){
                $this->view->response("No se agrega porque el campo << Año >> esta vacío",400 );
                return;
            }
            if(!isset($nuevo->patente) || empty($nuevo->patente)){
                $this->view->response("No se agrega porque el campo << Patente >> esta vacío",400 );
                return;
            }
            if(!isset($nuevo->asientos) || empty ($nuevo->asientos)){
                $this->view->response("No se agrega porque el campo << Asientos >> esta vacío",400 );
                return;
            }
                $this->model->crearvehiculo($nuevo->marca, $nuevo->modelo, $nuevo->anio, $nuevo->patente, $nuevo->asientos);
                $this->view->response("Vehiculo creado con éxito",201);
        }else{
            $this->view->response("Acceso denegado",401);
        }
    }
}