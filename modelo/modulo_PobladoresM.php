<?php
require('../modelo/conexionBD.php');
edit();
add();
function verPoblador($input)
{
    if ($input != null) {
        $query = "SELECT dni,nombres,apellidos,celular,estado FROM poblador where dni like '%$input%' or nombres like '%$input%' or apellidos like '%$input%' or celular like '%$input%' or estado like '%$input%'";
        $res = conexionBD::conexion()->query($query);
        return $res;
    } else {
        $query = "SELECT dni,nombres,apellidos,celular,estado FROM poblador";
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
        $celular= $_POST['modal_celular'];
        $estado=$_POST['modal_estado']!=0?1:0;
        $query="UPDATE poblador SET dni='$new_dni',nombres='$nombre',apellidos='$apellidos',celular='$celular',estado='$estado' WHERE dni='$dni'";
        echo json_encode( mysqli_query(conexionBD::conexion(),$query));
    }
}

function add(){
    

    if(isset($_POST['modal_addDni'])){
        $dniV=$_POST['modal_addDni'];
        $dniExistQuery=mysqli_query(conexionBD::conexion(),"SELECT dni from poblador where dni='$dniV'");
        $dniExist=$dniExistQuery->fetch_array();
        if(is_null($dniExist)){
            $dni=$_POST['modal_addDni'];   
            $nombre=$_POST['modal_addNombres'];
            $apellidos=$_POST['modal_addApellidos'];
            $celular= $_POST['modal_addCelular'];
            $query="INSERT INTO poblador VALUES('$dni','$nombre','$apellidos','$celular',1)" ;
            echo json_encode( mysqli_query(conexionBD::conexion(),$query));
            
        }
        else{
            echo json_encode('DNI EXISTENTE');
        }
       
    }
}

?>

