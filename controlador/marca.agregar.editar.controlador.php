<?php
require_once '../negocio/Marca.clase.php';
require_once '../util/funciones/Funciones.clase.php';
if(!isset($_POST["p_datosFormulario"])){
    Funciones::imprimeJSON(500, "Faltan parametros", "");
    exit();
}
$datosFormulario = $_POST["p_datosFormulario"];
parse_str($datosFormulario, $datosFormularioArray);

//print_r($datosFormularioArray); // convertir todos los datos que llegan concatenados a un array

try {
    $objProveedor = new Marca();
//    $objMarca->setCodigoMarca($datosFormularioArray["txtcodigo"]);
    $objProveedor->setDescripcion($datosFormularioArray["txtdescripcion"]);
    if($datosFormularioArray["txttipooperacion"]=="agregar"){
        $resultado = $objProveedor->agregar();
        if($resultado == true){
            Funciones::imprimeJSON(200, "Grabado con exito.", "");
        }
    }else{
        $objProveedor->setCodigoMarca($datosFormularioArray["txtcodigo"]);
        $resultado = $objProveedor->editar();
        if($resultado == true){
            Funciones::imprimeJSON(200, "Grabado con exito.", "");
        }
    }
} catch (Exception $ex) {
    Funciones::imprimeJSON(500, $ex->getMessage(), "");
}
//las dos siguientes lineas sirven para ver si los datos estan llegando al formulario
//echo $datosFormulario;
exit();
