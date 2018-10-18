<?php
require_once '../negocio/Compra.clase.php';
$objCompra = new Compra();
$resultado = $objCompra->graficoReporteCompra();

$datosGrafico1 = "['razon_social', 'sum']";
for ($i = 0; $i < count($resultado); $i++) {
     $datosGrafico1 .= ",['". $resultado[$i]["razon_social"] ."',     ".$resultado[$i]["sum"] ."]";
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
          title: 'Cantidad de Compras por cliente',
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

