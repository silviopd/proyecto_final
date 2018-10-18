$("#btncerrar").click(function () {
    document.location.href = "principal.vista.php";
});

$("#txtcontrasenaactual").focusout(function () {
    var clave;
    $.post(
            "../controlador/validar.contrasena.controlador.php",
            {
                p_contra : $("#txtcontrasenaactual").val()
            }
    ).done(function (resultado) {
        var datosJSON = resultado;
        if (datosJSON.estado===200 ) {
            $.each(datosJSON.datos, function (i, item) {
                clave = item.clave;
            });
            if (clave==null) {
                swal("Contraseña incorrecta...","", "warning");
                $("#txtcontrasenaactual").val("");
                $("#txtcontrasenaactual").focus();
            }            
        }
    })
});

$("#frmgrabar").submit(function (evento) {
    evento.preventDefault();
    var contra1 = $("#txtnuevacontrasena1").val();
    var contra2 = $("#txtnuevacontrasena2").val();
        
    if (contra1 === contra2) {
        swal({
            title: "Confirme",
            text: "¿Esta seguro de grabar los datos ingresados?",
            showCancelButton: true,
            confirmButtonColor: '#3d9205',
            confirmButtonText: 'Si',
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: true,
            imageUrl: "../imagenes/pregunta.png"
        },
                function (isConfirm) {

                    if (isConfirm) { //el usuario hizo clic en el boton SI

                        //procedo a grabar

                        $.post(
                                "../controlador/cambiar.contrasena.controlador.php",
                                {
                                    p_contranueva : $("#txtnuevacontrasena1").val()
                                }
                        ).done(function (resultado) {
                            var datosJSON = resultado;
                            if (datosJSON.estado === 200) {
                                swal({
                                    title: "Exito",
                                    text: datosJSON.mensaje,
                                    type: "success",
                                    showCancelButton: false,
                                    //confirmButtonColor: '#3d9205',
                                    confirmButtonText: 'Ok',
                                    closeOnConfirm: true,
                                },
                                        function () {
                                            document.location.href = "principal.vista.php";
                                        });
                            } else {
                                swal("Mensaje del sistema", resultado, "warning");
                            }

                        }).fail(function (error) {
                            var datosJSON = $.parseJSON(error.responseText);
                            swal("Error", datosJSON.mensaje, "error");
                        });
                    }
                });
    } else {
        swal("Contraseñas diferentes", "", "warning");
        $("#txtcontraseña1").val("");
        $("#txtcontraseña2").val("");        
        $("#txtcontraseña1").focus();
    }
});

