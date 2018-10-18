<?php

require_once '../negocio/Venta.clase.php';
require_once '../util/funciones/Funciones.clase.php';

try {
    
 
    $p_codigoCliente = $_POST["cbocliente"];
    $p_codigoTipoComprobante = $_POST["cbotc"];
    $fecha1 = $_POST["txtfecha1"];
    $fecha2 = $_POST["txtfecha2"];
    $tipo = $_POST["rbtipo"];
    
    $objVentar = new Venta();
    $resultado = $objVentar->ventaReporte($fecha1, $fecha2,$tipo ,$p_codigoCliente, $p_codigoTipoComprobante);
    
//    Funciones::imprimeJSON(200, "", $resultado);
    $htmlDatosReporte = '<table border="0" cellpadding="3" cellspacing="0">';
    $htmlDatosReporte .= '<thead>';

        $htmlDatosReporte .= '<tr>';
        $htmlDatosReporte .= '<td colspan="10" class="titulo-reporte">REPORTE DE VENTAS</td>';
        $htmlDatosReporte .= '</tr>';

        $htmlDatosReporte .= '<tr>';
            $htmlDatosReporte .= '<td class="cabecera-reporte-lineas">NRO VENTA</td>';
            $htmlDatosReporte .= '<td class="cabecera-reporte-lineas">TIPO COMPROBANTE</td>';
            $htmlDatosReporte .= '<td class="cabecera-reporte-lineas">NUMERO SERIE</td>';
            $htmlDatosReporte .= '<td class="cabecera-reporte-lineas">NOMBRE</td>';
            $htmlDatosReporte .= '<td class="cabecera-reporte-lineas">FECHA VENTA</td>';
            $htmlDatosReporte .= '<td class="cabecera-reporte-lineas">SUB TOTAL</td>';
            $htmlDatosReporte .= '<td class="cabecera-reporte-lineas">IGV</td>';
            $htmlDatosReporte .= '<td class="cabecera-reporte-lineas">TOTAL</td>';
            $htmlDatosReporte .= '<td class="cabecera-reporte-lineas">CODIGO_USUARIO</td>';
            $htmlDatosReporte .= '<td class="cabecera-reporte-lineas">ESTADO</td>';
            
        $htmlDatosReporte .= '</tr>';
    $htmlDatosReporte .= '</thead>';


    $htmlDatosReporte .= '<tbody>';
    //aqui se imprime el detalle del reporte (los datos)
    
    for ($i = 0; $i < count($resultado); $i++) {
                $htmlDatosReporte .= '<tr>';
                    $htmlDatosReporte .= '<td>'.$resultado[$i]["numero_venta"].'</td>';
                    $htmlDatosReporte .= '<td>'.$resultado[$i]["descripcion"].'</td>';
                    $htmlDatosReporte .= '<td>'.$resultado[$i]["numero_serie"].'</td>';
                    $htmlDatosReporte .= '<td>'.$resultado[$i]["numero_documento"].'</td>';
                    $htmlDatosReporte .= '<td>'.$resultado[$i]["nombre_completo"].'</td>';
                    $htmlDatosReporte .= '<td>'.$resultado[$i]["fecha_venta"].'</td>';
                    $htmlDatosReporte .= '<td>'.$resultado[$i]["sub_total"].'</td>';
                    $htmlDatosReporte .= '<td>'.$resultado[$i]["igv"].'</td>';
                    $htmlDatosReporte .= '<td>'.$resultado[$i]["total"].'</td>';
                    $htmlDatosReporte .= '<td>'.$resultado[$i]["codigo_usuario"].'</td>';
                    $htmlDatosReporte .= '<td>'.$resultado[$i]["estado"].'</td>';
                    
                $htmlDatosReporte .= '</tr>';
            }
    
    $htmlDatosReporte .= '</tbody>';
        
    
    $htmlDatosReporte .= '</table>';
    
    $htmlDatosReporte .='<iframe frameborder="0" scrolling="no" style="width: 900px; height: 500px;" src="venta.grafico.controlador.php"></iframe>';
    
//    echo $htmlDatosReporte;
    
    $htmlReporte = Funciones::generarHTMLReporte($htmlDatosReporte);
    
//    echo $htmlReporte;
    
    $tipo_reporte = $_POST["tipo_reporte"];
//    $tipo_reporte: 1=HTML, 2=PDF, 3=XLS
    
    Funciones::generarReporte($htmlReporte, $tipo_reporte, "reporte-venta");
    
} catch (Exception $exc) {
    //Funciones::mensaje($exc->getMessage(), "e");
    Funciones::imprimeJSON(500, $exc->getMessage(), "e");
}


