<?php

require '../../modelo/conexionBD.php';


class actasModelo
{

       // MOSTRAR TABLA DE ACTAS
       static public function mostrarActasM()
       {
              $consulta = "SELECT * from acta";

              $respuesta = mysqli_query(conexionBD::conexion(), $consulta);
              return  $respuesta;
       }

       //AGREGAR ACTA
       static public function agregarActasM($asunto, $acuerdo, $lugar, $formated_DATE,   $dni_usuario)
       {

              $consulta = "INSERT INTO acta (asunto_acta, acuerdo_acta, lugar, fecha, dni_usuario) VALUES ('$asunto', '$acuerdo', '$lugar', '$formated_DATE', '$dni_usuario ')";

              $respuesta = mysqli_query(conexionBD::conexion(), $consulta);
              return $respuesta;
       }


       //EDITAR Y ACTUALIZAR ACTA
       static public function editarActasM($asunto_reunion,   $acuerdo_reunion, $lugar_reunion,   $numero_acta)
       {
              $consulta = "UPDATE acta SET asunto_acta = '$asunto_reunion', acuerdo_acta='$acuerdo_reunion ', lugar='$lugar_reunion'
           WHERE numero_acta='$numero_acta '";

              $respuesta = mysqli_query(conexionBD::conexion(), $consulta);
              return $respuesta;
       }


       //VER DETALLES ACTA
       static public function verActasM($numero_acta)
       {
              $consulta = "SELECT * FROM acta WHERE numero_acta='$numero_acta'";

              $respuesta = mysqli_query(conexionBD::conexion(), $consulta);
              return $respuesta;
       }

       //VER DETALLES ACTA
       static public function verPDFM($id)
       {
              $consulta = "SELECT * FROM acta WHERE numero_acta='$id'";

              $respuesta = mysqli_query(conexionBD::conexion(), $consulta);
              return $respuesta;
       }

       static public function participantesM()
       {
              $consulta = "SELECT p.dni, p.nombres, p.apellidos
       FROM poblador p
       JOIN asistencia a ON p.dni = a.dni
       JOIN acta ac ON a.fecha_asistencia = ac.fecha
       WHERE a.estado = 1  AND a.fecha_asistencia = ac.fecha GROUP by p.dni";

              $respuesta = mysqli_query(conexionBD::conexion(), $consulta);
              return $respuesta;
       }
}?>
