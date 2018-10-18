<?php
require_once '../negocio/Marca.clase.php';
require_once '../util/funciones/Funciones.clase.php';
try {
    $objProveedor = new Marca();
    $resultado = $objProveedor->cargarListaDatos();
    Funciones::imprimeJSON(200, "", $resultado);
} catch (Exception $ex) {
//    Funciones::mensaje($ex->getMessage(), "e");
    Funciones::imprimeJSON(500, $ex->getMessage(), "");
}
