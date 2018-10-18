<?php
require_once '../negocio/Articulo.clase.php';
require_once '../util/funciones/Funciones.clase.php';



//if (! isset($_POST["p_codigoArticulo"]) ){
//    Funciones::imprimeJSON(500, "Faltan parametros", "");
//    exit();
//}

try {
    $objArti = new Articulo();
    $codigoArticulo = $_POST["txtcodigo"];
    $cantidad = $_POST["txtcantidad"];
    $resultado = $objArti->leerDatos2($codigoArticulo);
//    
    Funciones::imprimeJSON(200, "", $resultado);
    Funciones::imprimeJSON(200, "", $cantidad);
} catch (Exception $exc) {
    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}


