<?php

require_once('model.php');

class VehiculosModel extends Model {
    
    public function getVehiculos($filtro=null, $orden=null, $limit=null, $pag){
        $offset = ($pag -1) * $limit;
        $pdo = $this->crearConexion();
        $sql = "SELECT * FROM vehiculos";
        if ($filtro){
            $sql .= " WHERE $filtro";
        }
        if($orden){
            $sql.= " ORDER BY $orden";
        }
        if($limit){
            $sql .= " LIMIT $limit OFFSET $offset";
        }
        $query = $pdo->prepare($sql);
        try {
            $query->execute();
            $vehiculos = $query->fetchAll(PDO::FETCH_OBJ);
            return $vehiculos;
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function getVehiculoById($id_vehiculo){
        $pdo = $this->crearConexion();
        $sql = "SELECT * FROM vehiculos WHERE id = ?";
        $query = $pdo->prepare($sql);
        $query->execute([$id_vehiculo]);
        $vehiculo = $query->fetch(PDO::FETCH_OBJ);
        return $vehiculo;
    }

    public function deleteAutomovilById($id){
        $pDO = $this->crearConexion();
        $sql = 'DELETE FROM vehiculos WHERE id=?';
        $query = $pDO->prepare($sql);
        try {
            $query->execute([$id]);
        } catch (\Throwable $th) {
            return null;
        }
    }
}