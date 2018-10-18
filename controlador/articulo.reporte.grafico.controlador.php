<?php
    require_once '../negocio/Articulo.clase.php';
    
    $objArticulo = new Articulo();
    $resultado = $objArticulo->articulosPorLinea();
    
    
    $datosGrafico = "['Lineas', 'Cantidad de articulos por linea']";
    
    for ($i = 0; $i < count($resultado); $i++) {
        $datosGrafico.=",['".$resultado[$i]["linea"]."',    ".$resultado[$i]["cantidad"]."]";
    }
    
    
//    echo'<pre>';
//    print_r($datosGrafico);
//    echo '</pre>';
    
?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          <?php
                echo $datosGrafico;
          ?>
        ]);

        var options = {
          title: 'Reporte - Cantidad de articulos por linea',
          is3D: true
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
</html>