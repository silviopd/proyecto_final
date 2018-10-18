<?php
require_once '../negocio/Cliente.clase.php';
$objCliente = new Cliente();
$resultado = $objCliente->listarClientexVenta();

$datosGrafico1 = "['nombre_completo', 'total']";
for ($i = 0; $i < count($resultado); $i++) {
     $datosGrafico1 .= ",['". $resultado[$i]["nombre_completo"] ."',     ".$resultado[$i]["total"] ."]";
}

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
          echo $datosGrafico1;
          ?>
        ]);

        var options = {
          title: 'Cantidad de Articulos por Linea',
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

