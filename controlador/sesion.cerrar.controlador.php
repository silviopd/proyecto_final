<?php

session_name("SitemaComercial1");
session_start();

unset($_SESSION["s_nombre_usuario"]);
unset($_SESSION["s_cargo_usuario"]);
unset($_SESSION["s_codigo_usuario"]);
unset($_SESSION["s_tipo"]);

session_destroy();

header("location:../vista/index.php");
