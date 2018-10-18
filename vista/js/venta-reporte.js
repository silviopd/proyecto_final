$(document).ready(function(){
    cargarComboCliente("#cbocliente","todos");
    cargarComboTc("#cbotc","todos");
});

$("#cbocliente").change(function(){
    var codigoCliente = $("#cbocliente").val();
    cargarComboTc("#cbotc", "todos", codigoCliente);
});


