<?php

require_once '../negocio/Categoria.clase.php';
require_once '../util/funciones/Funciones.clase.php';

try {
    
    if ( !isset( $_POST["codigoLinea"] )){
        Funciones::imprimeJSON(500, "Faltan parametros", "");
        exit;
    }
    $codigoLinea = $_POST["codigoLinea"];
//    $codigoCategoria = $_POST["codigoCategoria"];
//    $codigoMarca = $_POST["codigoMarca"];
    
    $objCategoria = new Categoria();
    $resultado = $objCategoria->listar($codigoLinea);
    
    Funciones::imprimeJSON(200, "", $resultado);
    
    
} catch (Exception $exc) {
    //Funciones::mensaje($exc->getMessage(), "e");
    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}


