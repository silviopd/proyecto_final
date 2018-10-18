<?php

require_once '../negocio/Categoria.clase.php';
require_once '../util/funciones/Funciones.clase.php';

if (! isset($_POST["p_codigoCategoria"]) ){
    Funciones::imprimeJSON(500, "Faltan parametros", "");
    exit();
}

try {
    $objCate = new Categoria();
    $codigoCategoria = $_POST["p_codigoCategoria"];
    $resultado = $objCate->leerDatos($codigoCategoria);
    
    Funciones::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}

