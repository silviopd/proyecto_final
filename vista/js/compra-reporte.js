$(document).ready(function(){
    cargarComboProveedor("#cboproveedor","todos");
    cargarComboTc("#cbotc","todos");
});

$("#cboproveedor").change(function(){
    var codigoCliente = $("#cboproveedor").val();
    cargarComboTc("#cbotc", "todos", codigoCliente);
});


