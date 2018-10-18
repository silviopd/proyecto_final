<?php

    //require_once 'sesion.validar.controlador.php';

    require_once '../negocio/Cliente.clase.php';
    require_once '../util/funciones/Funciones.clase.php';

    try {
	$obj = new Cliente();
        $resultado = $obj->cargarCliente();
	Funciones::imprimeJSON(200, "", $resultado);
	
    } catch (Exception $exc) {
	Funciones::imprimeJSON(500, $exc->getMessage(), "");
	
    }
