<?php

require_once '../negocio/Articulo.clase.php';
//require_once '../util/funciones/Funciones.clase.php';

try {

    /*
      if ( !isset( $_POST["codigoCategoria"] )){
      Funciones::imprimeJSON(500, "Faltan parametros", "");
      exit;
      }
     */

    $codigoLinea = $_POST["cbolinea"];


    if (isset($_POST["cbocategoria"])) {
        $codigoCategoria = $_POST["cbocategoria"];
    } else {
        $codigoCategoria = 0;
    }


    $codigoProveedor = $_POST["cbomarca"];

    $objCliente = new Articulo();
    $resultado = $objCliente->listar($codigoLinea, $codigoCategoria, $codigoProveedor);

//    echo '<pre>';
//    print_r($resultado);
//    echo'</pre>';

    $htmlDatosReporte = '<table border="0" cellpadding="3" cellspacing="0">';
    $htmlDatosReporte .= '<thead>';

    $htmlDatosReporte .= '<tr>';
    $htmlDatosReporte .= '<td colspan="6" class="titulo-reporte">REPORTE DE ARTICULOS</td>';
    $htmlDatosReporte .= '</tr>';

    $htmlDatosReporte .= '<tr>';
    $htmlDatosReporte .= '<td class="cabecera-reporte-lineas">CODIGO</td>';
    $htmlDatosReporte .= '<td class="cabecera-reporte-lineas">NOMBRE DEL ARTICULO</td>';
    $htmlDatosReporte .= '<td class="cabecera-reporte-lineas">PRECIO</td>';
    $htmlDatosReporte .= '<td class="cabecera-reporte-lineas">LINEA</td>';
    $htmlDatosReporte .= '<td class="cabecera-reporte-lineas">CATEGORIA</td>';
    $htmlDatosReporte .= '<td class="cabecera-reporte-lineas">MARCA</td>';
    $htmlDatosReporte .= '</tr>';
    $htmlDatosReporte .= '</thead>';


    $htmlDatosReporte .= '<tbody>';
    //aqui se imprime el detalle del reporte (los datos)

    for ($i = 0; $i < count($resultado); $i++) {
        $htmlDatosReporte .= '<tr>';
        $htmlDatosReporte .= '<td>' . $resultado[$i]["codigo"] . '</td>';
        $htmlDatosReporte .= '<td>' . $resultado[$i]["nombre"] . '</td>';
        $htmlDatosReporte .= '<td>' . $resultado[$i]["precio"] . '</td>';
        $htmlDatosReporte .= '<td>' . $resultado[$i]["linea"] . '</td>';
        $htmlDatosReporte .= '<td>' . $resultado[$i]["categoria"] . '</td>';
        $htmlDatosReporte .= '<td>' . $resultado[$i]["marca"] . '</td>';
        $htmlDatosReporte .= '</tr>';
    }

    $htmlDatosReporte .= '</tbody>';

    $htmlDatosReporte .= '</table>';
    
    $htmlDatosReporte .= '<iframe border="0" scrolling="no" style="width:900px; height:500px" src="articulo.reporte.grafico.controlador.php"></iframe>';

    $htmlReporte = Funciones::generarHTMLReporte($htmlDatosReporte);

//    echo $htmlReporte;
    
    $tipo_reporte = $_POST["tipo_reporte"];
    Funciones::generarReporte($htmlReporte, $tipo_reporte,"reporte_articulo");
    
    
    
} catch (Exception $exc) {
    Funciones::mensaje($exc->getMessage(), "e");
//    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}