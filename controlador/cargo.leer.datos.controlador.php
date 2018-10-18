<?php
require_once '../negocio/Cargo.clase.php';
require_once '../util/funciones/Funciones.clase.php';
if(!isset($_POST["p_codigoCargo"])){
    Funciones::imprimeJSON(500, "Faltan parametros", "");
    exit();
}

try {
    $objCargo = new Cargo();
    $codigoCargo = $_POST["p_codigoCargo"];
    $resultado =  $objCargo->leerDatos($codigoCargo);
    Funciones::imprimeJSON(200, "", $resultado);
} catch (Exception $ex) {
    Funciones::imprimeJSON(500, $ex->getMessage(), "");
}

