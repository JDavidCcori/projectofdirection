
<?php
require '../modelo/crearCuentaM.php';
if (isset($_POST['input-dni'])) {
    $dni = $_POST['input-dni'];
    $nombres = $_POST['input-nombre'];
    $apellidos = $_POST['input-apellido'];
    $password = $_POST['input-password'];
    $celular = $_POST['input-celular'];
    if (verificarExistenciaEnBD($dni)) {
        if (verificarPoblador($dni)) {
            if (crearCuenta($dni, $password, $nombres, $apellidos, $celular)) {
                echo "<script> alertify.set('notifier', 'position', 'top-right');
                alertify.success('Creado Exitosamente');
               
                </script>";
            } else {
                echo "<script> alertify.set('notifier', 'position', 'top-right');
                alertify.success('No se pudo crear la cuenta');</script>";
            }
        } else {
            echo "<script>alertify.set('notifier', 'position', 'top-right');
            alertify.success('No es un poblador de Pallaccocha');</script>";
        }
    } else {
        echo "<script> alertify.set('notifier', 'position', 'top-right');
        alertify.success('Usted ya esta registrado');</script>";
    }
}
?>