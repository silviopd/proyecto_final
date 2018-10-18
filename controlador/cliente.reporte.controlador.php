<?php

require_once '../negocio/Cliente.clase.php';
//require_once '../util/funciones/Funciones.clase.php';

try {

//    $codigoLinea = $_POST["cbolinea"];
//    
//    if ( !isset( $_POST["codigoCategoria"] )){
//        $codigoCategoria = $_POST["cbocategoria"];
//    }else{
//        $codigoCategoria=0;
//    }
//    
//    $codigoMarca = $_POST["cbomarca"];
    
    $objCliente = new Cliente();
    $resultado = $objCliente->listarClientexVenta();
    
//    echo'<pre>';
//    print_r($resultado);
//    echo'</pre>';
//    
    $htmlDatosReporte = '<table border="0" cellpadding="3" cellspacing="0">';
    $htmlDatosReporte .= '<thead>';

        $htmlDatosReporte .= '<tr>';
        $htmlDatosReporte .= '<td colspan="6" class="titulo-reporte">REPORTE DE CLIENTES POR VENTA</td>';
        $htmlDatosReporte .= '</tr>';
        
        $htmlDatosReporte .= '<tr>';
       $htmlDatosReporte .= '<td colspan="14"><pre><font size=5 color="red"> Desde: 01-01-2010           Hasta: 01-01-2017</font></pre></td>';
        $htmlDatosReporte .= '</tr>';
        
        $htmlDatosReporte .= '<tr>';
        $htmlDatosReporte .= '';
            $htmlDatosReporte .= '<td class="cabecera-reporte-lineas">Codigo Cliente</td>';
            $htmlDatosReporte .= '<td class="cabecera-reporte-lineas">Nombre</td>';
            $htmlDatosReporte .= '<td class="cabecera-reporte-lineas">DNI</td>';
            $htmlDatosReporte .= '<td class="cabecera-reporte-lineas">Direccion</td>';
            $htmlDatosReporte .= '<td class="cabecera-reporte-lineas">Teléfono</td>';
            $htmlDatosReporte .= '<td class="cabecera-reporte-lineas">Total</td>';
            
        $htmlDatosReporte .= '</tr>';
    $htmlDatosReporte .= '</thead>';


    $htmlDatosReporte .= '<tbody>';
    for ($i = 0; $i < count($resultado); $i++) {
                $htmlDatosReporte .= '<tr>';
                    $htmlDatosReporte .= '<td>'.$resultado[$i]["codigo_cliente"].'</td>';
                    $htmlDatosReporte .= '<td>'.$resultado[$i]["nombre_completo"].'</td>';
                    $htmlDatosReporte .= '<td>'.$resultado[$i]["dni"].'</td>';
                    $htmlDatosReporte .= '<td>'.$resultado[$i]["direccion"].'</td>';
                    $htmlDatosReporte .= '<td>'.$resultado[$i]["telefono"].'</td>';
                    $htmlDatosReporte .= '<td>'.$resultado[$i]["total"].'</td>';
               
                $htmlDatosReporte .= '</tr>';
            }
    $htmlDatosReporte .= '</tbody>';
        
    
    $htmlDatosReporte .= '</table>';
    
    $htmlDatosReporte .='<iframe frameborder="0" scrolling="no" style="width: 900px; height: 500px;" src="cliente.grafico.controlador.php"></iframe>';
    
    
    $htmlReporte= Funciones::generarHTMLReporte($htmlDatosReporte);
    
  
    $tipo_reporte= $_POST["tipo_reporte"];//$tipo_reporte: 1=HTML, 2=PDF y  3=EXCEL
    Funciones::generarReporte($htmlReporte, $tipo_reporte, "reporte-cliente");
    
} catch (Exception $exc) {
    Funciones::mensaje($exc->getMessage(), "e");
//   Funciones::imprimeJSON(500, $exc->getMessage(), "");
}
