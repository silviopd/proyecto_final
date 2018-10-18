<?php

require_once '../negocio/Articulo.clase.php';
require_once '../util/funciones/Funciones.clase.php';

try {
    
    if ( !isset( $_POST["codigoCategoria"] )){
        Funciones::imprimeJSON(500, "Faltan parametros", "");
        exit;
    }
    $codigoLinea = $_POST["codigoLinea"];
    $codigoCategoria = $_POST["codigoCategoria"];
    $codigoProveedor = $_POST["codigoMarca"];
    
    $objCliente = new Articulo();
    $resultado = $objCliente->listar($codigoLinea, $codigoCategoria, $codigoProveedor);
    
    Funciones::imprimeJSON(200, "", $resultado);
    
    
} catch (Exception $exc) {
    //Funciones::mensaje($exc->getMessage(), "e");
    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}

