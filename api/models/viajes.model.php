<?php

    require_once('model.php');

    class ViajesModel extends Model {

    public function getViajes($filtro=null, $orden=null){
        $pdo = $this->crearConexion();
        $sql = "SELECT * FROM viajes";
        if($filtro) {
            $sql .= " WHERE $filtro";
        }
        if($orden) {
            $sql .= " ORDER BY $orden";
        }
        $query = $pdo->prepare($sql);
        $query->execute();
    
        $viajes = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $viajes;
    }

    public function getViajeById($id_destino){
        $pdo = $this->crearConexion();
        $sql = "SELECT * FROM viajes WHERE id = ?";
        $query = $pdo->prepare($sql);
        $query->execute([$id_destino]);
        $viaje = $query->fetch(PDO::FETCH_OBJ);
        return $viaje;
    }
}