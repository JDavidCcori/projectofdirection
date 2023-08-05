<?php
require(__DIR__ . '/../controlador/recuperarC.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="../css/menu.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <script src="https://kit.fontawesome.com/84156eae16.js" crossorigin="anonymous"></script>
    <style>
    .button {
        padding-left: 45%;
        height: auto;
        }
    .form {
        margin-bottom: 30px;
        margin-left: 45%;
    }
    .form button {
        display: flex;
        width: 210px;
        color: #fff;
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
    .h2 {
        margin-left: 40%;
    }
    </style>
</head>

<body>
    <div class="contenedor">
        <h2 class="h2">Modificar Contraseña</h2>
        <form class="form" action="../controlador/recuperarC.php?" method="post">
            <dl>
                <dt>
                    <label for="dni">DNI:</label>
                </dt>
                <dd>
                    <input type="text" id="dni" name="dni" required>
                </dd>
            </dl>
            <dl>
                <dt>
                    <label for="celular">Número de Celular:</label>
                </dt>
                <dd>
                    <input type="text" id="celular" name="celular" required>
                </dd>
            </dl>

            <dl>
                <dt>
                    <label for="nuevaContrasena">Nueva contraseña:</label>
                </dt>
                <dd>
                    <input type="password" id="nuevaContrasena" name="nuevaContrasena" required>
                </dd>
            </dl>

            <dl>
                <dt>
                    <label for="confirmarContrasena">Confirmar Contraseña:</label>
                </dt>
                <dd>
                    <input type="password" id="confirmarContrasena" name="confirmarContrasena" required>
                </dd>
            </dl>
            <button type="submit">Cambiar contraseña</button>
        </form>
    </div>
    <div class="button">
        <a href="../index.php">Cancelar</a>
    </div>
</body>

</html>