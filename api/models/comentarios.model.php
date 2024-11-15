<?php
    require_once('model.php');

class ComentariosModel extends Model {

    public function getComentarios(){
        $pdo = $this->crearConexion();
        $sql = "SELECT * FROM comentarios";
        $query = $pdo->prepare($sql);
        try {
            $query->execute();
            $comentarios = $query->fetchAll(PDO::FETCH_OBJ);
            return $comentarios;
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function getComentarioById($id_comentario){
        $pdo = $this->crearConexion();

        $sql = "SELECT * FROM comentarios WHERE id = ?";
        
        $query = $pdo->prepare($sql);
        $query->execute([$id_comentario]);
        $comentario = $query->fetch(PDO::FETCH_OBJ);
        return $comentario;
    }

    public function deleteComentarioById($id){
        $pdo = $this->crearConexion();

        $sql = 'DELETE FROM comentarios WHERE id=?';
        
        $query = $pdo->prepare($sql);
        try {
            $query->execute([$id]);
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function crearComentario($usuario, $resenia){
        $pdo = $this->crearConexion();
        
        $sql = 'INSERT INTO comentarios (usuario,resenia) 
                VALUES (?,?)';

        $query = $pdo->prepare($sql);
        try {
            $query->execute([$usuario, $resenia]);
        } catch (\Throwable $th) {
            return null;
        }
    }
}