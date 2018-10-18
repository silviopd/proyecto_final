<?php

require_once '../util/funciones/Funciones.clase.php';

$datosJSONDetalle = $_POST["p_datosJSONDetalle"];
try {

    $resultado = $datosJSONDetalle;

//    $_SESSION["s_lista"]=$datosJSONDetalle;
//    echo $resultado;
    
    Funciones::imprimeJSON(200, "ok", $resultado);

//    foreach ($detalleVentaArray as $key => $value) {
//        $codigo = $value->codigoArticulo;
//        $nombre = $value->nombre;
//        $precio = $value->precio;
//        $cantidad = $value->cantidad;
//        $importe = $value->importe;
//        
//    }        
} catch (Exception $exc) {
    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}
