<?php

require_once '../negocio/Proveedor.clase.php';

$obj = new Proveedor();

$valorBusqueda = $_GET["term"];

$resultado = $obj->cargarDatosProveedor($valorBusqueda);

$datos = array();

for ($i = 0; $i < count($resultado); $i++) {
    $registro = array
            (
                "label" => $resultado[$i]["razon_social"],
                "value" => array
                            (
                                "ruc" => $resultado[$i]["ruc_proveedor"],
                                "razon_social" => $resultado[$i]["razon_social"],
                                "direccion" => $resultado[$i]["direccion"],
                                "telefono" => $resultado[$i]["telefono"] 
                            )
            );
    
    $datos[$i] = $registro;
}

echo json_encode($datos);