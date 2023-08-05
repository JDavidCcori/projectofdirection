<?php
require('../modelo/conexionBD.php');
edit();
function verPoblador($input)
{
    if ($input != null) {
        $query = "SELECT dni,rol,estado,nombres,apellidos,celular FROM usuario where dni like '%$input%' or rol like '%$input%' or estado like '%$input%' or nombres like '%$input%' or apellidos like '%$input%' or celular like '%$input%'";
        $res = conexionBD::conexion()->query($query);
        return $res;
    } else {
        $query = "SELECT dni,rol,estado,nombres,apellidos,celular FROM usuario";
        $res = conexionBD::conexion()->query($query);
        return $res;
    }
}

function edit(){
    if(isset($_POST['modal_dni'])&&isset($_POST['modal_nombres'])&&isset($_POST['modal_apellidos'])){
        $dni=$_POST['modal_dni_hidden'];   
        $new_dni=$_POST['modal_dni'];
        $nombre=$_POST['modal_nombres'];
        $apellidos=$_POST['modal_apellidos'];
        $rol= $_POST['modal_rol'];
        $estado=$_POST['modal_estado']!=0?1:0;
        $query="UPDATE usuario SET dni='$new_dni',nombres='$nombre',apellidos='$apellidos',rol='$rol',estado='$estado' WHERE dni='$dni'";
        echo json_encode( mysqli_query(conexionBD::conexion(),$query));
    }
}
?>

