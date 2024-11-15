<?php

require_once 'api/models/comentarios.model.php';
require_once 'api/views/api.views.php';
require_once 'api/controllers/usuarios.controller.php';

class ComentariosController {
    protected $model;
    protected $view;

    public function __construct() {
        
        $this->data = file_get_contents("php://input");
        
        $this->model = new ComentariosModel();
        $this->view = new Views();
        $this->usercontroller = new UsuariosController();

    }

    private function getData(){
        return json_decode($this->data);
    }

    public function obtenerComentarios(){
        $comentarios = $this->model->getComentarios();
        $cantidad= count($comentarios);
        $this->view->response("Se muestra/ n << ".$cantidad." >> resultado/ s",200);
        $this->view->response($comentarios,200);
        
    }

    public function obtenerComentarioByID($params){
        $id = $params [':ID'];
        $comentario= $this->model->getComentarioById($id);
        if($comentario){
        $this->view->response($comentario,200);
    }
    else{
            $this->view->response("Comentario no encontrado",404);
        }
    }

    public function borrarComentario($params){
        if($this->usercontroller->auth_basic()){
            $id = $params [':ID'];
            if($this->model->getComentarioById($id)){
                $this->model->deleteComentarioById($id);
                $this->view->response("Comentario eliminado con exito",200);
            }else{
                $this->view->response("Comentario no encontrado",404);
            }
        }else{
            $this->view->response("Acceso denegado",401);
        }
    }

    public function agregarComentario(){
        if($this->usercontroller->auth_basic()){
            $nuevo = $this->getData();
            
            if(!isset($nuevo->usuario) || empty($nuevo->usuario)){
                $this->view->response("No se agrega porque el campo << Usuario >> esta vacío",400 );
                return;
            }
            if(!isset($nuevo->resenia) || empty($nuevo->resenia)){
                $this->view->response("No se agrega porque el campo << Reseña >> esta vacío",400 );
                return;
            }
                $this->model->crearComentario($nuevo->usuario, $nuevo->resenia);
                $this->view->response("Comentario creado con éxito",201);
        }else{
            $this->view->response("Acceso denegado",401);
        }
    }
}