<?php
require_once '../negocio/Cargo.clase.php';
require_once '../util/funciones/Funciones.clase.php';
try {
    $objCargo = new Cargo();
    $resultado = $objCargo->cargarListaDatos();
    Funciones::imprimeJSON(200, "", $resultado);
} catch (Exception $ex) {
//    Funciones::mensaje($ex->getMessage(), "e");
    Funciones::imprimeJSON(500, $ex->getMessage(), "");
}


