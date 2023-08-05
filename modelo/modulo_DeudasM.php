<?php
require('../modelo/conexionBD.php');
date_default_timezone_set('America/Lima');

realizarPago();
if (isset($_POST['modal_nuevoMonto'])) {
    generarCuotaDeuda();
}
function verificarFechasActas()
{
    $query = "SELECT id_cuota,fecha_pago FROM cuotas";
    $res = mysqli_query(conexionBD::conexion(), $query);
    $res_num = $res->num_rows;
    $dateToday = date('Y-m-d H:i:s', time());
    for ($i = 0; $i < $res_num; $i++) {
        $result = $res->fetch_assoc();
        $idCuota = $result['id_cuota'];
        $fecha_pago = $result['fecha_pago'];
        if (compararFechas($fecha_pago, $dateToday)) {
            mysqli_query(conexionBD::conexion(), "UPDATE cuotas SET estado = 0 WHERE id_cuota ='$idCuota'");
        }
    }
}

function compararFechas($fecha1, $fecha2)
{
    $fechaObj1 = DateTime::createFromFormat('Y-m-d H:i:s', $fecha1);
    $fechaObj2 = DateTime::createFromFormat('Y-m-d H:i:s', $fecha2);

    if (!$fechaObj1 || !$fechaObj2) {
        throw new Exception('Formato de fecha incorrecto');
    }

    if ($fechaObj1 < $fechaObj2) {

        return true; // La primera fecha es anterior a la segunda
    } elseif ($fechaObj1 > $fechaObj2) {

        return false; // La primera fecha es posterior a la segunda
    } else {

        return false; // Las fechas son iguales
    }
}


function verDeudas($input)
{

    if ($input != null) {
        $query = "SELECT dni,estado,monto,fecha_pago,descripcion,numero_acta FROM cuotas where dni like '%$input%' or estado like '%$input%' or monto like '%$input%' or fecha_pago like '%$input%' or descripcion like '%$input%' or numero_acta like '%$input%'";
        /* "SELECT asunto_acta FROM acta WHERE numero_acta='$numeroActa'" */
        $res = conexionBD::conexion()->query($query);
        return $res;
    } else {
        $query = "SELECT dni,estado,monto,fecha_pago,descripcion,numero_acta FROM cuotas";
        $res = conexionBD::conexion()->query($query);
        return $res;
    }
}

function verPagos($input)
{
    if ($input != null) {   
        $query = "SELECT dni,fecha_mod,total FROM pagos where dni like '%$input%' and total != 0";

        $res = conexionBD::conexion()->query($query);
        return $res;
    } else {
        $query = "SELECT dni,fecha_mod,total FROM pagos WHERE total != 0";
        $res = conexionBD::conexion()->query($query);
        return $res;
    }
}

function verActa($numeroActa)
{
    $query = "SELECT asunto_acta FROM acta WHERE numero_acta='$numeroActa'";
    $res = conexionBD::conexion()->query($query);
    $result = $res->fetch_assoc();
    return $result['asunto_acta'];
}
function verDeudor($dni)
{
    $query = "SELECT nombres,apellidos FROM poblador WHERE dni='$dni'";
    $res = conexionBD::conexion()->query($query);
    $result = $res->fetch_assoc();
    $nombreCompleto = $result['nombres'] . ' ' . $result['apellidos'];
    return $nombreCompleto;
}
function realizarPago()
{
    if (isset($_POST['modal_dni'])) {
        $dni = $_POST['modal_dni'];
        $monto = $_POST['modal_monto'];
        $montoPagar = $_POST['modal_montoPagar'];
        $newMonto = $monto - $montoPagar;
        $fecha_actual = date("Y-m-d h:i:s", time());
        $query = "UPDATE pagos SET total='$newMonto',fecha_mod='$fecha_actual' WHERE dni='$dni'";
        echo json_encode(mysqli_query(conexionBD::conexion(), $query));
    }
}

function generarCuotaDeuda()
{
    if (isset($_POST['modal_nuevoMonto'])) {

        /* if ($_POST['modal_tipoCuota'] == 'Cuota') { */
        $numeroActa = $_POST['modal_idActa'];
        $monto = $_POST['modal_nuevoMonto'];
        $fechaPago = date('Y-m-d H:i:s', time());
        $descripcion = $_POST['modal_descripcion'];
        $pob = mysqli_query(conexionBD::conexion(), 'SELECT dni FROM poblador');
        $pobRows = $pob->num_rows;
        $actaQuery = "SELECT numero_acta FROM acta WHERE numero_acta='$numeroActa'";
        $actaExists = conexionBD::conexion()->query($actaQuery);
        $acta = $actaExists->fetch_assoc();
        if (is_null($acta)) {
            echo json_encode('No existe el acta');
        } else {
            for ($i = 0; $i < $pobRows; $i++) {
                $res = $pob->fetch_assoc();
                $dni = $res['dni'];
                mysqli_query(conexionBD::conexion(), "INSERT INTO cuotas VALUES(null,'$dni',1,'$monto','$fechaPago','$descripcion','$numeroActa')");
                $pago = mysqli_query(conexionBD::conexion(), "SELECT dni FROM pagos WHERE dni='$dni'");
                $pagoDni = $pago->fetch_assoc();
                if (is_null($pagoDni)) {
                    $timeNow = date('Y-m-d H:i:s', time());
                    $query = "INSERT INTO pagos VALUES('$dni','$timeNow','$monto')";
                    mysqli_query(conexionBD::conexion(), $query);
                } else {

                    $timeNow = date('Y-m-d H:i:s', time());
                    $queryTotal = mysqli_query(conexionBD::conexion(), "SELECT total FROM pagos WHERE dni='$dni'");
                    $totalPrevio = $queryTotal->fetch_assoc();
                    $totalFinal = $monto + $totalPrevio['total'];
                    mysqli_query(conexionBD::conexion(), "UPDATE pagos SET total='$totalFinal',fecha_mod='$timeNow' WHERE dni='$dni'");
                }
            }
            echo json_encode('Correcto');
        }

        
        /*  } */
        /* if ($_POST['modal_tipoCuota'] == 'Deuda') {
            $idPoblador = $_POST['modal_idPoblador'];
            $monto = $_POST['modal_nuevoMonto'];
            $fechaPago = date('Y-m-d H:i:s', strtotime($_POST['modal_fechaPago']));;
            $descripcion = $_POST['modal_descripcion'];

            echo json_encode(mysqli_query(conexionBD::conexion(), "INSERT INTO cuotas VALUES(null,'$idPoblador',1,'$monto','$fechaPago','$descripcion',null)"));
        } */
    }
}
?>