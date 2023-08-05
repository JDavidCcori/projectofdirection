<?php
date_default_timezone_set('America/Lima');
require ('../modelo/conexionBD.php');
class AsistenciasM extends conexionBD
{
  static public function obtenerPobladores() {
    $conexionBD = conexionBD::conexion();
    $stmt = $conexionBD->query('SELECT dni,nombres, apellidos  FROM poblador');
    $data = $stmt->fetch_all(MYSQLI_ASSOC);

    return $data;
}

static public function guardarAsistencia($dni, $estado) {
    $conexionBD = conexionBD::conexion();
    $date= date('Y-m-d');
    $conexionBD->query("INSERT INTO asistencia VALUES (null,'$date','$estado','$dni')");
    
}

static public  function sumarMontoCuotas($dni, $monto) {
    $conexionBD = conexionBD::conexion();
    $stmt = $conexionBD->prepare('UPDATE cuotas SET monto = monto + ? WHERE dni = ?');
    $stmt->bind_param('di', $monto, $dni);
    $stmt->execute();
}
}
?>