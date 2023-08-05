
<?php
// session_start();
require(__DIR__ . '/../modelo/usuariosM.php');
if (isset($_SESSION['nombres'])) {
  header("location:vista/usuariosV.php");
}

function validarUsuarioC()
{

  if (isset($_POST['input-DNI']) && isset($_POST['input-contraseña'])) {
    $DNI = $_POST['input-DNI'];
    $contraseña = $_POST['input-contraseña'];

    $res = validarUsuarioM($DNI);
    if ($res) {
      if (password_verify($contraseña, $res['contrasenia'])) {
        session_start();
        $_SESSION['dni'] = $res['dni'];
        $_SESSION['contrasenia'] = $res['contrasenia'];
        $_SESSION['nombres'] = $res['nombres'];
        $_SESSION['apellidos'] = $res['apellidos'];
        $_SESSION['rol']= $res['rol'];
        if ($res['rol'] == "Secretario") {
          header("location:vista/usuariosV.php");

        } elseif ($res['rol'] == "Tesorero"){
          header("location:vista/usuariosV.php");
        }

      }
    }

  }

}

?>