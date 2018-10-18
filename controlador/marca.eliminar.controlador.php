<?php
require_once '../negocio/Marca.clase.php';
require_once '../util/funciones/Funciones.clase.php';
if (!isset($_POST["codigoMarca"])) {
    Funciones::imprimeJSON(500, "Faltan parametros", "");
    exit();
}
try {
    $objProveedor = new Marca();
    $codigoProveedor = $_POST["codigoMarca"];
    $resultado = $objProveedor->eliminar($codigoProveedor);
    if($resultado == true){
//        Se ha eliminado satisfactoriamente
        Funciones::imprimeJSON(200, "El registro se ha eliminado.", "");
    }
} catch (Exception $ex) {
    Funciones::imprimeJSON(500, $ex->getMessage(), "");
}

