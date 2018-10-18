/*INICIO: BUSQUEDA DE CLIENTES*/
$("#txtnombreproveedor").autocomplete({
    source: "../controlador/proveedor.autocompletar.controlador.php",
    minLength: 2, //Filtrar desde que colocamos 3 o mas caracteres
    focus: f_enfocar_registro,
    select: f_seleccionar_registro
});

function f_enfocar_registro(event, ui){
    var registro = ui.item.value;
    $("#txtnombreproveedor").val(registro.razon_social);
    event.preventDefault();
}

function f_seleccionar_registro(event, ui){
    var registro = ui.item.value;
    $("#txtnombreproveedor").val(registro.razon_social);
    $("#txtcodigoproveedor").val(registro.ruc);
    $("#lbldireccioncliente").val(registro.direccion);
    $("#lbltelefonocliente").val(registro.telefono);
    
    event.preventDefault();
    }
    
    
    
    $("#txtarticulo").autocomplete({
    source: "../controlador/articulo.autocompletar.controlador.php",
    minLength: 3, //Filtrar desde que colocamos 3 o mas caracteres
    focus: f_enfocar_registro_articulo,
    select: f_seleccionar_registro_articulo
});

function f_enfocar_registro_articulo(event, ui){
    var registro = ui.item.value;
    $("#txtarticulo").val(registro.nombre);
    event.preventDefault();
}

function f_seleccionar_registro_articulo(event, ui){
    var registro = ui.item.value;
    $("#txtarticulo").val(registro.nombre);
    $("#txtcodigoarticulo").val(registro.codigo);
    $("#txtprecio").val(registro.precio);
    $("#txtstock").val(registro.stock);
    $("#txtcantidad").focus();
    
    
    event.preventDefault();
}