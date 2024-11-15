<?php

    require_once('model.php');

    class ViajesModel extends Model {

    public function getViajes($filtro=null, $orden=null, $limit=null, $pag){
        $pdo = $this->crearConexion();
        
        $sql = "SELECT * FROM viajes";
        
        $offset = ($pag -1) * $limit;
        
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
        try {
            $query->execute();
            $viajes = $query->fetchAll(PDO::FETCH_OBJ);
            return $viajes;
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function getViajeById($id_destino){
        $pdo = $this->crearConexion();
        $sql = "SELECT * FROM viajes WHERE id = ?";
        $query = $pdo->prepare($sql);
        $query->execute([$id_destino]);
        $viaje = $query->fetch(PDO::FETCH_OBJ);
        return $viaje;
    }

    public function crearviaje($destino, $fecha, $horario, $pasajeros, $vehiculo, $info){
        $pdo = $this->crearConexion();
        
        $sql = 'INSERT INTO viajes (destino, fecha, horario, pasajeros, fk_vehiculo, descripcion) 
                VALUES (?,?,?,?,?,?)';

        $query = $pdo->prepare($sql);
        try {
            $query->execute([$destino, $fecha, $horario, $pasajeros, $vehiculo, $info]);
        } catch (\Throwable $th) {
            return null;
        }
    }
}