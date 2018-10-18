<?php

require_once '../datos/Conexion.clase.php';

class Marca extends Conexion {
    private $codigoMarca;
    private $descripcion;
    
    function getCodigoMarca() {
        return $this->codigoMarca;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function setCodigoMarca($codigoMarca) {
        $this->codigoMarca = $codigoMarca;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

        
    public function cargarListaDatos() {
	try {
            $sql = " select * from marca order by 2";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    public function eliminar($p_codigoMarca) {
        $this->dblink->beginTransaction();
        try {
            $sql = "delete from marca where codigo_marca = :p_codigoMarca;";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigoMarca", $p_codigoMarca);
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
            
            $sql = "select * from f_generar_correlativo('marca') as nc";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetch();
            
            if ($sentencia->rowCount()){
                $nuevoCodigo = $resultado["nc"];
                $this->setCodigoMarca($nuevoCodigo);
            
            $sql = "INSERT INTO marca values (:p_codigoMarca ,:p_descripcion);";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigoMarca", $this->getCodigoMarca());
            $sentencia->bindParam(":p_descripcion", $this->getDescripcion());
            $sentencia->execute();
            $this->dblink->commit();
            return true;
        }
        }
        catch (Exception $ex) {
            $this->dblink->rollBack();
            throw $ex;
        }
    }

    public function editar() {
        $this->dblink->beginTransaction();
        try {
            $sql = "update marca set descripcion = :p_descripcion where codigo_marca = :p_codigo_marca;";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_descripcion", $this->getDescripcion());
            $sentencia->bindParam(":p_codigo_marca", $this->getCodigoMarca());
            $sentencia->execute();
            $this->dblink->commit();
            return true;
        } catch (Exception $ex) {
//            throw new Exception("No se ha configurado el correlativo para la tabla Linea.");
            $this->dblink->rollBack();
            throw $ex;
        }
    }

    public function leerDatos($p_codigoMarca) {
        try {
            $sql = "select * from marca where codigo_marca = :p_codigo_marca;";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_marca", $p_codigoMarca);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }


    
}
