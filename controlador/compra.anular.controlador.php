<?php

require_once '../negocio/Compra.clase.php';
require_once '../util/funciones/Funciones.clase.php';

if  (
        (! isset($_POST["p_numero_compra"]))
    )
{
    Funciones::imprimeJSON(500, "Faltan parametros lol", "");
    exit();
}


$objVenta = new Compra();
try {
    $numero_compra = $_POST["p_numero_compra"];
    $resultado = $objVenta->anular($numero_compra);
    if ($resultado == true){
        Funciones::imprimeJSON(200, "compra anulada correctamente", "");
    }
} catch (Exception $exc) {
    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}
