<?php

    require_once('model.php');

    class ViajesModel extends Model {

    public function getViajes($filtro=null, $orden=null, $limit=null, $pag){
        $offset = ($pag -1) * $limit;
        $pdo = $this->crearConexion();
        $sql = "SELECT * FROM viajes";
        if($filtro) {
            $sql .= " WHERE $filtro";
        }
        if($orden) {
            $sql .= " ORDER BY $orden";
        }
        if($limit){
            $sql .= " LIMIT $limit OFFSET $offset";
        }
        $query = $pdo->prepare($sql);
        $query->execute();
        try {
            $query->execute();
            $viajes = $query->fetchAll(PDO::FETCH_OBJ);
            return $viajes;
        } catch (\Throwable $th) {
            return null;
        }
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