<?php

require_once '../datos/Conexion.clase.php';

class Categoria extends Conexion {
    private $codigoCategoria;
    private $descripcion;
    private $codigoLinea;
    
    function getCodigoCategoria() {
        return $this->codigoCategoria;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getCodigoLinea() {
        return $this->codigoLinea;
    }

    function setCodigoCategoria($codigoCategoria) {
        $this->codigoCategoria = $codigoCategoria;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setCodigoLinea($codigoLinea) {
        $this->codigoLinea = $codigoLinea;
    }

        
    public function listar( $p_codigoLinea ) {
        try {
            $sql = "select * from f_listar_categoria(:p_codigoLinea)";
           
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigoLinea", $p_codigoLinea);
            $sentencia->execute();
            
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            return $resultado;
            
        } catch (Exception $exc) {
            throw $exc;
        }
    }
//    public function listar2($p_codigoLinea ){
//        try {
//            $sql = "select * from f_listar_categoria(:p_codigoLinea)";
//           
//            $sentencia = $this->dblink->prepare($sql);
//            $sentencia->bindParam(":p_codigoLinea", $p_codigoLinea);
//            $sentencia->execute();
//            
//            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
//            
//            return $resultado;
//            
//        } catch (Exception $exc) {
//            throw $exc;
//        }
//    }
    
    
    public function cargarListaDatos($p_codigoLinea){
	try {
            $sql = "select * from categoria where codigo_linea = :p_codigoLinea order by 2";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigoLinea", $p_codigoLinea);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
     public function eliminar($p_codigoCategoria) {
        $this->dblink->beginTransaction();
        try {
            $sql = "delete from categoria where codigo_categoria = :p_codigoCategoria;";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigoCategoria", $p_codigoCategoria);
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
            $sql = "select * from f_generar_correlativo('categoria') as nc";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetch();
            
            if ($sentencia->rowCount()){
                $nuevoCategoria = $resultado["nc"];
                $this->setCodigoCategoria($nuevoCategoria);
                
            $sql = "INSERT INTO categoria VALUES (:p_codigo_Categoria,:p_descripcion, :p_codigo_linea);";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_Categoria", $this->getCodigoCategoria());
            $sentencia->bindParam(":p_descripcion", $this->getDescripcion());
            $sentencia->bindParam(":p_codigo_linea", $this->getCodigoLinea());
            $sentencia->execute();
            $this->dblink->commit();
            return true;
            }
        } catch (Exception $ex) {
            $this->dblink->rollBack();
            throw $ex;
        }
    }

    public function editar() {
        $this->dblink->beginTransaction();
        try {
            $sql = "update categoria set descripcion = :p_descripcion where codigo_categoria = :p_codigo_categoria;";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_descripcion", $this->getDescripcion());
            $sentencia->bindParam(":p_codigo_categoria", $this->getCodigoCategoria());
            $sentencia->execute();
            $this->dblink->commit();
            return true;
        } catch (Exception $ex) {
//            throw new Exception("No se ha configurado el correlativo para la tabla Linea.");
            $this->dblink->rollBack();
            throw $ex;
        }
    }

    public function leerDatos($p_codigoCategoria) {
        try {
            $sql = "select * from categoria where codigo_categoria = :p_codigo_categoria;";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_categoria", $p_codigoCategoria);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
//    public function articulosPorLinea() {
//        try {
//            $sql = "select l.descripcion as linea,
//count(a.*) as cantidad
//from
//articulo a inner join categoria c on (a.codigo_categoria = c.codigo_categoria)
//inner join linea l on (l.codigo_linea = c.codigo_linea)
//group by l.descripcion
//order by 1 ";
//            $sentencia = $this->dblink->prepare($sql);
//            $sentencia->execute();
//            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
//            return $resultado;
//        } catch (Exception $exc) {
//            echo $exc;
//        }
//        }

}
