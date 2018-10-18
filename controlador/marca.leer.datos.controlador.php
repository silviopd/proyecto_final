<?php
require_once '../negocio/Marca.clase.php';
require_once '../util/funciones/Funciones.clase.php';
if(!isset($_POST["p_codigoMarca"])){
    Funciones::imprimeJSON(500, "Faltan parametros", "");
    exit();
}

try {
    $objProveedor = new Marca();
    $codigoProveedor = $_POST["p_codigoMarca"];
    $resultado =  $objProveedor->leerDatos($codigoProveedor);
    Funciones::imprimeJSON(200, "", $resultado);
} catch (Exception $ex) {
    Funciones::imprimeJSON(500, $ex->getMessage(), "");
}


