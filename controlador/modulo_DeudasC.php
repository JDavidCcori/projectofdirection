<?php
require '../modelo/modulo_DeudasM.php';
//verificarFechasActas();
session_start();
$input=isset($_POST['input']) ? conexionBD::conexion()->real_escape_string($_POST['input']):null;
$verPagos=verPagos($input);
$num_rows=$verPagos->num_rows;
$html='';
if (isset($_SESSION['nombres'])) {
    $nombre = $_SESSION['nombres'];
    $rolState = $_SESSION['rol'] == 'Secretario' ? 'Disabled' : '';
}

if($num_rows>0){
    while($row=$verPagos->fetch_assoc()){
        $dniClass=$row['dni'];
        $html .="<tr class='$dniClass'>";
        $html .='<td>'.$row['dni'].'</td>';
        $html .='<td>'.$row['fecha_mod'].'</td>';
        $html .='<td>'.$row['total'].'</td>';
        $html .=
        "<td> 
                <button type='button'  name='edit' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#staticBackdrop' onclick='edit($dniClass)' id='buttonPagar' $rolState>Pagar</button>
        </td>";
        $html .=
        "<td>                
                <form id='verCuota'>
                <input name='view' value='$dniClass' hidden>
                <button type='button'   class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#staticBackdrop3' onclick='verCuotas()' id='buttonVer' $rolState><i class='bi bi-eye-fill text-white' ></i></button>
                </form>
        </td>";
        $html .='</tr>';
    }
}

else{
    $html.='<tr>';
    $html.='<td colspan="7">Sin Resultados</td>';
    $html.='</tr>';
}

/* 
if($num_rows>0){
    while($row=$verDeuda->fetch_assoc()){
        $dniClass=$row['dni'];
        $estado=$row['estado']!=0?'Activo':'Inactivo';
        $iterable='';
        $asunto='';
        if($row['estado']==0 || $row['monto']==0){
            $iterable='Disabled';
        }
        if($row['numero_acta']==null){
            $asunto='Sin asunto';
        }
        else{
            $asunto=verActa($row['numero_acta']);
        }
        $html .="<tr class='$dniClass'>";
        $html .='<td>'.$row['dni'].'</td>';
        $html .='<td>'.verDeudor($row['dni']).'</td>';
        $html .='<td>'.$estado.'</td>';
        $html .='<td>'.$row['monto'].'</td>';
        $html .='<td>'.$row['fecha_pago'].'</td>';
        $html .='<td>'.$row['descripcion'].'</td>';
        $html .='<td>'.$asunto.'</td>';
        $html .=
        "<td> 
                <button type='button'  name='edit' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#staticBackdrop' onclick='edit($dniClass)' id='buttonPagar' $iterable >Pagar</button>
        </td>";
        $html .='</tr>';
    }
}

else{
    $html.='<tr>';
    $html.='<td colspan="7">Sin Resultados</td>';
    $html.='</tr>';
} */
echo json_encode($html,JSON_UNESCAPED_UNICODE);

?>
