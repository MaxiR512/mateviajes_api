<?php

require_once 'api/models/usuarios.model.php';
require_once 'api/views/api.views.php';

class UsuariosController {

    private $model;
    private $view;

    public function __construct(){
        $this->model = new UsuariosModel();
        $this->view = new Views();
    }

    public function auth_basic() {
        if(!isset($_SERVER['PHP_AUTH_USER']) || empty($_SERVER['PHP_AUTH_USER'])){
            return $this->view->response("Ingrese usuario válido", 401);
        }
        if(!isset($_SERVER['PHP_AUTH_PW']) || empty($_SERVER['PHP_AUTH_PW'])){
            return $this->view->response("Ingrese contraseña válida", 401);
        }
        try {
            $usuario = $_SERVER['PHP_AUTH_USER'];
            $password = $_SERVER['PHP_AUTH_PW'];

            return $this->autenticar($usuario, $password);
        } catch (\Throwable $th) {
            echo ($th);
            return;
        }
    }

    private function autenticar ($usuario, $password) {
        $user = $this->model->getUsuario($usuario);

        if($user && password_verify($password,($user->password))){
            return true;
        }
        return false;
    }
}