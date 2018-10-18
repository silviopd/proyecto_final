<?php

    //require_once 'sesion.validar.controlador.php';

    require_once '../negocio/Proveedor.clase.php';
    require_once '../util/funciones/Funciones.clase.php';

    try {
	$obj = new Proveedor();
        $resultado = $obj->cargarProveedor();
	Funciones::imprimeJSON(200, "", $resultado);
	
    } catch (Exception $exc) {
	Funciones::imprimeJSON(500, $exc->getMessage(), "");
	
    }
