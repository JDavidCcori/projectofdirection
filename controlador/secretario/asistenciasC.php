<?php

require('../modelo/secretario/asistenciasM.php');

class AsistenciasC
{
  static public function mostrarTablaAsistencia()
  {
    $data = AsistenciasM::obtenerPobladores();
    return $data;
  }

  static public function guardarAsistencia()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dni']) && isset($_POST['estado'])) {
      $dniList = $_POST['dni'];
      $estadoList = $_POST['estado'];

      if (count($dniList) >= count($estadoList)) {
        for ($i = 0; $i < count($dniList); $i++) {
          $dni = $dniList[$i];
          $estado = isset($estadoList[$i]) ? $estadoList[$i] : '0';
          
          AsistenciasM::guardarAsistencia($dni, $estado);

          if ($estado == 0) {
            AsistenciasM::sumarMontoCuotas($dni, 30.00);
          }
        }

        return ['success' => true];
      } else {
        return ['success' => false, 'message' => 'Cantidad de DNI y estado no coincide'];
      }
    }

    return ['success' => false, 'message' => 'Error en el método de solicitud'];
  }
}
?>
