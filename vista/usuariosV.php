<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>COMUNIDAD PALLACCOCHA</title>


    <link rel="stylesheet" href="../css/menu.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
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
                    <a href="usuariosV.php?modulo=actas">ACTAS</a>
                </div>

                <div class="opcion">
                    <i class="fa-sharp fa-solid fa-file-circle-question"></i>
                    <a href="usuariosV.php?modulo=asistencias">ASISTENCIAS</a>
                </div>

                <div class="opcion">
                    <i class="fa-solid fa-list-check"></i>
                    <a href="usuariosV.php?modulo=deudas">CUOTAS</a>
                </div>

                <div class="opcion">
                    <i class="fa-solid fa-list-check"></i>
                    <a href="usuariosV.php?modulo=pobladores">POBLADORES</a>
                </div>

                <div class="opcion">
                    <i class="fa-solid fa-list-check"></i>
                    <a href="usuariosV.php?modulo=usuarios">USUARIOS</a>
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
                    $rol = $_SESSION['rol'];
                    echo "$nombre";
                    echo " - $rol";
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