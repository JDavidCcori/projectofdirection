<?php
require '../modelo/modulo_DeudasM.php';

if (isset($_POST['view'])) {
    $dni = $_POST['view'];
    $cuotaQuery = mysqli_query(conexionBD::conexion(), "SELECT monto,fecha_pago,numero_acta FROM cuotas WHERE dni='$dni'");
    $cuotaNumRows = $cuotaQuery->num_rows;
    $html='';

    for ($i = 0; $i < $cuotaNumRows; $i++) {
        $cuota = $cuotaQuery->fetch_assoc();
        $asunto = verActa($cuota['numero_acta']);
        $monto = $cuota['monto'];
        $fecha = $cuota['fecha_pago'];

        $html.= "<tr>
                        <td>$asunto</td>
                        <td>$monto</td>
                        <td>$fecha</td>
                </tr>";
    }

    echo json_encode($html,JSON_UNESCAPED_UNICODE);
}

?>
