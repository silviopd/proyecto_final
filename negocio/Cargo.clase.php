<?php

require_once '../datos/Conexion.clase.php';

class Cargo extends Conexion {

    private $codigoCargo;
    private $descripcion;

    function getCodigoCargo() {
        return $this->codigoCargo;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function setCodigoCargo($codigoCargo) {
        $this->codigoCargo = $codigoCargo;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }


     public function cargarListaDatos() {
        try {
            $sql = "select * from cargo order by 2;";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll();
            return $resultado;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function eliminar($p_codigoCargo) {
        $this->dblink->beginTransaction();
        try {
            $sql = "delete from cargo where codigo_cargo = :p_codigoCargo;";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigoCargo", $p_codigoCargo);
            $sentencia->execute();
            $this->dblink->commit();
            return true;
        } catch (Exception $ex) {
            $this->dblink->rollBack();
            throw $ex;
        }
    }

    public function agregar() {
        $this->dblink->beginTransaction();
        try {
            $sql = "INSERT INTO cargo(descripcion) VALUES (:p_descripcion);";
            $sentencia = $this->dblink->prepare($sql);
//          $sentencia->bindParam(":p_codigoCargo", $this->getCodigoCargo());
            $sentencia->bindParam(":p_descripcion", $this->getDescripcion());
            $sentencia->execute();
            $this->dblink->commit();
            return true;
        } catch (Exception $ex) {
            $this->dblink->rollBack();
            throw $ex;
        }
    }

    public function editar() {
        $this->dblink->beginTransaction();
        try {
            $sql = "update cargo set descripcion = :p_descripcion where codigo_cargo = :p_codigo_cargo;";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_descripcion", $this->getDescripcion());
            $sentencia->bindParam(":p_codigo_cargo", $this->getCodigoCargo());
            $sentencia->execute();
            $this->dblink->commit();
            return true;
        } catch (Exception $ex) {
//            throw new Exception("No se ha configurado el correlativo para la tabla Linea.");
            $this->dblink->rollBack();
            throw $ex;
        }
    }

    public function leerDatos($p_codigoCargo) {
        try {
            $sql = "select * from cargo where codigo_cargo = :p_codigo_cargo;";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_cargo", $p_codigoCargo);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }



}


