<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>COMUNIDAD PALLACCOCHA</title>


    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="../styles/menu.css">
    <link rel="shortcut icon" href="../icons/namaste.png" type="image/x-icon">

    <script src="../scripts/sweetalert2.all.min.js"></script>
    <script src="https://kit.fontawesome.com/84156eae16.js" crossorigin="anonymous"></script>
</head>

<body>

    <div class="contenedor_general">
        <div class="barra_menu">
            <div class="encabezado">

                <i class="fa-solid fa-user"></i>

            </div>

            <div class="opciones_menu">

                <div class="opcion">
                    <i class="fa-solid fa-list-check"></i>
                    <a href="usuariosV.php?modulo=acta">VER ACTA</a>
                </div>

                <div class="opcion">
                    <i class="fa-sharp fa-solid fa-file-circle-question"></i>
                    <a href="usuariosV.php?modulo=asistencias">VER ASISTENCIAS</a>
                </div>

                <div class="opcion">
                    <i class="fa-solid fa-list-check"></i>
                    <a href="usuariosV.php?modulo=deudas">DEUDAS</a>
                </div>

                <div class="opcion">
                    <i class="fa-solid fa-list-check"></i>
                    <a href="usuariosV.php?modulo=pobladores">VER POBLADORES</a>
                </div>


                <div class="boton_salir">
                    <a href="../controlador/cerrarSesion.php">SALIR</a>
                </div>

            </div>
        </div>

        <div class="contenido">
            <div class="cabecera">

                <?php
                session_start();
                if (isset($_SESSION['nombres'])) {
                    $nombre = $_SESSION['nombres'];
                    echo "$nombre";
                } 
                ?>
                <?php //include('../controladores/nombre_usuario_controlador.php'); ?>

                <i class="fa-solid fa-circle-user"></i>

            </div>

            <div class="contenido-modulo">
                <?php include('../controlador/rutas.php'); ?>
            </div>

        </div>

    </div>

</body>