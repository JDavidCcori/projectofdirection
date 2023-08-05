<?php
//require('controlador/usuariosC.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>COMUNIDAD PALLACCOCHA</title>

    <link rel="stylesheet" href="../css/crearCuenta.css">
    <link rel="shortcut icon" href="icons/namaste.png" type="image/x-icon">

    <script src="https://kit.fontawesome.com/084bfb5838.js"></script>

    <script src="../scripts/sweetalert2.all.min.js"></script>
    <script src="https://kit.fontawesome.com/84156eae16.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <!-- JavaScript -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
</head>

<body background="../images/fondo2.jpg">
    <div class="contenedor-principal ">
        <div class="cuerpo_cuenta">
            <form action="#" method="post" class="formulario-datos">
                <div class="crearCuentaText">
                    <h2 style="color:#00d8d6;">CREAR CUENTA</h2>
                </div>
                <div class="usuario">
                    <input type="text" class="input-box" name="input-dni" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="Ingrese DNI" maxlength=8 required>
                    <i class="fa-solid fa-id-card icono"></i>
                </div>
                <div class="nombre">
                    <input type="text" class="input-box" name="input-nombre" placeholder="Nombre" maxlength=40 required>
                    <i class="fa-solid fa-user icono"></i>
                </div>
                <div class="apellido">
                    <input type="text" class="input-box" name="input-apellido" placeholder="Apellidos" maxlength=40 required>
                    <i class="fa-solid fa-user icono"></i>
                </div>
                <div class="contraseña">
                    <input type="password" class="input-box" name="input-password" placeholder="Ingrese contraseña" maxlength=20 required>
                    <i class="fa-solid fa-key icono"></i>
                </div>
                <div class="celular">
                    <input type="text" class="input-box" name="input-celular" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="Ingrese numero de celular" minlength="9" maxlength=9 required>
                    <i class="fa-solid fa-phone icono"></i>
                </div>
                <button style="color:white;" id="boton-ingresar">CREAR CUENTA</button>
                <div class="recuperar_contraseña">
                    <a href="../index.php">Iniciar Sesion </a>
                </div>
            </form>
        </div>
    </div>
</body>

<?php
require '../controlador/crearCuentaC.php';

?>