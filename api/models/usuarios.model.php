<?php
    require_once('model.php');

class UsuariosModel extends Model {

    public function getUsuario($user){
        $pdo = $this->crearConexion();
        $sql = "SELECT * FROM usuarios WHERE usuario = ?";
        $query = $pdo->prepare($sql);
        $query->execute([$user]);
        $usuario = $query->fetch(PDO::FETCH_OBJ);
    
        return $usuario;
    }
}