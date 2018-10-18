<?php
require_once '../negocio/Proveedor.clase.php';
require_once '../util/funciones/Funciones.clase.php';


try {
    $objProveedor = new Proveedor();
    $codigoProveedor = $_POST["p_rucProveedor"];
    $resultado =  $objProveedor->leerDatos($codigoProveedor);
    Funciones::imprimeJSON(200, "", $resultado);
} catch (Exception $ex) {
    Funciones::imprimeJSON(500, $ex->getMessage(), "");
}


