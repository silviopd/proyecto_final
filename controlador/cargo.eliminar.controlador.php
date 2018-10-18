<?php
require_once '../negocio/Cargo.clase.php';
require_once '../util/funciones/Funciones.clase.php';
if (!isset($_POST["codigoCargo"])) {
    Funciones::imprimeJSON(500, "Faltan parametros", "");
    exit();
}
try {
    $objCargo = new Cargo();
    $codigoCargo = $_POST["codigoCargo"];
    $resultado = $objCargo->eliminar($codigoCargo);
    if($resultado == true){
//        Se ha eliminado satisfactoriamente
        Funciones::imprimeJSON(200, "El registro se ha eliminado.", "");
    }
} catch (Exception $ex) {
    Funciones::imprimeJSON(500, $ex->getMessage(), "");
}