<?php
require '../../modelo/secretario/actasModelo.php';


//Si....
if (isset($_POST['guardar_acta'])) {
    actasControlador::agregarActaC();
}

if (isset($_POST['update_student'])) {
    actasControlador::editarActaC();
}

if (isset($_GET['numero_acta'])) {

    actasControlador::verActaC();
}



class actasControlador
{


    // MOSTRAR TABLA DE ACTAS
    static public function mostrarActasC()
    {
      $resultado = actasModelo::mostrarActasM();
      return $resultado;
    }

    
    //AGREGAR ACTA NUEVA
    static public function agregarActaC()
    {

        session_start();
       $dni_usuario= $_SESSION['dni'] ;
  

        $con = conexionBD::conexion();
        $asunto = mysqli_real_escape_string($con, $_POST['asunto']);
        $acuerdo = mysqli_real_escape_string($con, $_POST['acuerdo']);
        $lugar = mysqli_real_escape_string($con, $_POST['lugar']);

        if ($asunto == NULL || $acuerdo == NULL || $lugar == NULL) {
            $res = [
                'status' => 422,
                'message' => 'Todos los campos son obligatorios'
            ];
            echo json_encode($res);
            return;
        }

        $formated_DATE = date('Y-m-d');
        $resultado = actasModelo::agregarActasM($asunto, $acuerdo, $lugar, $formated_DATE,  $dni_usuario);

        if ($resultado) {
            $res = [
                'status' => 200,
                'message' => 'Acta creado exitosamente'
            ];
            echo json_encode($res);
            return;
        } else {
            $res = [
                'status' => 500,
                'message' => 'El Acta no fué creada correctamente'
            ];
            echo json_encode($res);
            return;
        }
    }

    //EDITAR Y ACTULIZAR ACTA
    static public function editarActaC()
    {
        $con = conexionBD::conexion();
        $numero_acta = mysqli_real_escape_string($con, $_POST['acta_id']);
        $asunto_reunion = mysqli_real_escape_string($con, $_POST['asunto']);
        $acuerdo_reunion = mysqli_real_escape_string($con, $_POST['acuerdo']);
        $lugar_reunion = mysqli_real_escape_string($con, $_POST['lugar']);


        if ($asunto_reunion == NULL || $acuerdo_reunion == NULL || $lugar_reunion  == NULL) {
            $res = [
                'status' => 422,
                'message' => 'Todos los campos son obligatorios'
            ];
            echo json_encode($res);
            return;
        }

        $resultado = actasModelo::editarActasM($asunto_reunion,   $acuerdo_reunion, $lugar_reunion,   $numero_acta);
        if ($resultado) {
            $res = [
                'status' => 200,
                'message' => 'Acta actualizada exitosamente'
            ];
            echo json_encode($res);
            return;
        } else {
            $res = [
                'status' => 500,
                'message' => 'No se realizó la actualización'
            ];
            echo json_encode($res);
            return;
        }
    }


    //VER DETALLES ACTA
    static public function verActaC()
    {
        $con = conexionBD::conexion();
        $numero_acta = mysqli_real_escape_string($con, $_GET['numero_acta']);

        $resultado = actasModelo::verActasM($numero_acta);


        if (mysqli_num_rows($resultado) == 1) {
            $datosActa = mysqli_fetch_array($resultado);

            $res = [
                'status' => 200,
                'message' => 'Acta encontrada',
                'data' =>  $datosActa
            ];
            echo json_encode($res);
            return;
        } else {
            $res = [
                'status' => 404,
                'message' => 'Número de acta no encontrada'
            ];
            echo json_encode($res);
            return;
        }
    }

    static public function verPDFC()
    {
  
        $id = ($_GET['numero']); 
  
      $resultado = actasModelo:: verPDFM($id);
      return $resultado;
    }

    static public function participantesC()
    {
      $resultado = actasModelo::  participantesM();
      return $resultado;
    }

}
