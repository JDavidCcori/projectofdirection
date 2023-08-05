<?php
require(__DIR__ . '/../modelo/usuariosM.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dni = $_POST["dni"];
    $celular = $_POST["celular"];
    $Contrasena = $_POST["nuevaContrasena"];
    $confirmarContrasena = $_POST["confirmarContrasena"];


    if (validarUsuario($dni, $celular)) {

        if ($Contrasena === $confirmarContrasena) {

            if (actualizarContrasena($dni, $celular, $Contrasena)) {
                echo "Contraseña cambiada exitosamente.";
                header("Location: ../index.php");
                exit;
            } else {

                echo "Hubo un error al cambiar la contraseña.";
            }
        } else {
            echo "Las contraseñas no coinciden.";
        }
    } else {
        echo "Los datos del usuario no son válidos.";
    }
}

function validarUsuario($dni, $celular)
{

    $conn = conexionBD::conexion();
    $dni = mysqli_real_escape_string($conn, $dni);
    $celular = mysqli_real_escape_string($conn, $celular);
    $query = "SELECT * FROM usuario WHERE dni='$dni' AND celular='$celular'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}
function actualizarContrasena($dni, $celular, $Contrasena)
{
    $conn = conexionBD::conexion();
    $dni = $conn->real_escape_string($dni);
    $celular = $conn->real_escape_string($celular);
    $Contrasena = $conn->real_escape_string(password_hash($Contrasena, PASSWORD_BCRYPT));

    $query = "UPDATE usuario SET contrasenia='$Contrasena' WHERE dni=$dni AND celular = $celular";
    return conexionBD::conexion()->query($query);
    if ($conn->query($query) === 0) {
        if ($conn->affected_rows > 0) {
            echo "Contraseña modificado exitosamente";
            return true;

        } else {
            echo "Los datos del usuario no son válidos.";
            return false;
        }
    } else {
        echo "Error al cambiar la contraseña: " . $conn->error;
        return false;
    }

}

?>