<?php
require_once 'sesion.validar.vista.php';
require_once '../util/funciones/definiciones.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo C_NOMBRE_SOFTWARE; ?> - Principal</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <?php
        include 'estilos.vista.php';
        ?>
        <!-- Icono para la pagina principal-->
        <link rel="icon" href="../imagenes/logo2.jpg">




        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue layout-top-nav">
        <!-- Site wrapper -->
        <div class="wrapper">

            <?php
            include 'cabecera.vista.php';
            ?>
            <div class="content-wrapper">
                <section class="content">
                    <h3>Agregue los articulos al carrito</h3>
                    <p>
                    <div class="box box-success">
                        <div class="box-body">
                            <div id="listado" > 
                            </div>
                        </div>
                    </div>
                    </p>

                </section>

            </div>


        </div><!-- ./wrapper -->




        <?php
        include 'scripts.vista.php';
        ?>

        <?php
        include './tabla.carrito.php';
        ?>


        <script src="js/principal.js" type="text/javascript"></script>

        <script type="text/javascript">
            var tipo = (<?php echo $_SESSION["s_tipo"] ?>);
            if (tipo == 1) {
                $("#mantenimiento").hide();
                $("#transaccion").hide();
                $("#reportes").hide();
                $("#estadisticas").hide();
                $("#administracion").hide();
            }
        </script>
        
    </body>
</html>

<?--php  
$codigo = 'codigo';
$cantidad = 'cantidad';
$nombre = 'nombre';
$precio = 'precio';
$importe = 'importe';

echo $codigo
?>