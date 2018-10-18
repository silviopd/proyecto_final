$(document).ready(function () {
    listar();
});

function listar() {

    $.post
            (
                    "../controlador/principal.listar.controlador.php",
                    {
                    }
            ).done(function (resultado) {
        var datosJSON = resultado;
        if (datosJSON.estado === 200) {
            var html = "";
            html += '<small>';
            html += '<table id="tabla-listado" class="table table-bordered table-striped">';
            html += '<thead>';
            html += '<tr style="background-color: #ededed; height:25px;">';
            html += '<th>CODIGO</th>';
            html += '<th>NOMBRE DEL ARTICULO</th>';
            html += '<th>PRECIO</th>';
            html += '<th>LINEA</th>';
            html += '<th>CATEGORIA</th>';
            html += '<th>MARCA</th>';
            html += '<th>STOCK</th>';
            html += '<th style="text-align: center;width:250px">OPCIONES</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody id="tabla-fila">';
            //Detalle
            $.each(datosJSON.datos, function (i, item) {
                html += '<tr>';
                html += '<td align="center" style="vertical-align:middle; width:60px">' + item.codigo + '</td>';
                html += '<td style="vertical-align:middle">' + item.nombre + '</td>';
                html += '<td style="vertical-align:middle">' + item.precio + '</td>';
                html += '<td style="vertical-align:middle">' + item.linea + '</td>';
                html += '<td style="vertical-align:middle">' + item.categoria + '</td>';
                html += '<td style="vertical-align:middle">' + item.marca + '</td>';
                html += '<td style="vertical-align:middle">' + item.stock + '</td>';
                html += '<td align="center" style="vertical-align:middle">';
//                html += '<form action="../controlador/principal.leer.datos.controlador.php" method="post">';
                html += '<input placeholder="ingrese cantidad" style="width:100px" id="txtcantidad" name="txtcantidad"></input>';
                html += '&nbsp;&nbsp;';
                html += '<button id="btnagregar" name="btnagregar" class="btn btn-primary btn-xs" >Agregar  <i class="glyphicon glyphicon-shopping-cart" ></i></button>';
                html += '<input id="txtcodigo" name="txtcodigo" value="' + item.codigo + '" hidden=""></input>';
                html += '<input id="txtprecio" name="txtprecio" value="' + item.precio + '" hidden=""></input>';
                html += '<input id="txtnombre" name="txtnombre" value="' + item.nombre + '" hidden=""></input>';
//                html += '</form>';
                html += '</td>';
                html += '</tr>';
            });
            html += '</tbody>';
            html += '</table>';
            html += '</small>';
            $("#listado").html(html);
            $('#tabla-listado').dataTable({
                "aaSorting": [[1, "asc"]]
            });
        } else {
            swal("Mensaje del sistema", resultado, "warning");
        }

    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        swal("Error", datosJSON.mensaje, "error");
    });
}

var arrayDetalle = new Array();

$(document).on("click", "#btnagregar", function () {
    var fila = $(this).parents().get(0);

    var codigo = $(fila).find("#txtcodigo").val();
    var cantidad = $(fila).find("#txtcantidad").val();
    var nombre = $(fila).find("#txtnombre").val();
    var precio = $(fila).find("#txtprecio").val();
    var importe = cantidad * precio;


    var objDetalle = new Object(); //Crear un objeto para almacenar los datos

    /*declaramos y asignamos los valores a los atributos*/
    objDetalle.codigoArticulo = codigo;    
    objDetalle.nombre = nombre;
    objDetalle.precio = precio;
    objDetalle.cantidad = cantidad;
    objDetalle.importe = importe;
    /*declaramos y asignamos los valores a los atributos*/

    arrayDetalle.push(objDetalle); //agregar el objeto objDetalle al array arrayDetalle

    //Convertimos el array "arrayDetalle" a formato de JSON
    var jsonDetalle = JSON.stringify(arrayDetalle);

//    alert(jsonDetalle);
//    return 0;

    $.post(
            "../controlador/llenar.carrito.controlador.php",
            {
                p_datosJSONDetalle: jsonDetalle
            }
    ).done(function (resultado) {
        var datosJSON = resultado;
        if (datosJSON.estado === 200) {
//            $.each(datosJSON.datos, function (item) {
//                var fila = '<tr>' +
//            '<td class="text-center" style="vertical-align:middle;">' + item.codigoArticulo + '</td>' +
//            '<td style="vertical-align:middle;">' + item.nombre + '</td>' +
//            '<td class="text-right" style="vertical-align:middle;">' + item.precio + '</td>' +
//            '<td class="text-right" style="vertical-align:middle;">' + item.cantidad + '</td>' +
//            '<td class="text-right" style="vertical-align:middle;">' + item.importe + '</td>' +
//            '<td id="celiminar" class="text-center" style="font-size:20px" ><a href="javascript:void()"><i class="fa fa-close text-danger"></i></a></td>' +
//            '</tr>';
//    
//            $("#detalleventa-carrito").append(fila);

                alert(datosJSON.datos);
//            });
    
        } else {
            swal("Mensaje del sistema", resultado, "warning");
        }

    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        swal("Error", datosJSON.mensaje, "error");
    });

});
