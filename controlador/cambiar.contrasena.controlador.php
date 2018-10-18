<?php

require_once '../negocio/CambioContrasena.clase.php';
require_once '../util/funciones/Funciones.clase.php';

try {
    session_name("SitemaComercial1");
    session_start();

    $obj = new CambioContrasena();
    $contra = $_POST["p_contranueva"];
    $codigo = $_SESSION["s_codigo_usuario"];
    $tipo = $_SESSION["s_cargo_usuario"];
    
    $resultado = $obj->cambiarcontrasena($contra, $codigo, $tipo);
    
    Funciones::imprimeJSON(200, "", $resultado);
} catch (Exception $exc) {
    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}