<?php
require('../modelo/conexionBD.php');

function crearCuenta($input_dni,$input_password,$input_nombres,$input_apellidos,$input_celular){
    

    $dni=mysqli_real_escape_string(conexionBD::conexion(),$input_dni);
    $password=mysqli_real_escape_string(conexionBD::conexion(),$input_password);
    $password=password_hash($password,PASSWORD_DEFAULT);
    $nombres=mysqli_real_escape_string(conexionBD::conexion(),$input_nombres);
    $apellidos=mysqli_real_escape_string(conexionBD::conexion(),$input_apellidos);
    $celular=mysqli_real_escape_string(conexionBD::conexion(),$input_celular);
    $query="INSERT INTO usuario VALUES('$dni','$password','Sin rol',0,'$nombres','$apellidos','$celular')";  
    return conexionBD::conexion()->query($query);
}
function verificarPoblador($dni){
    $existeQuery=mysqli_query(conexionBD::conexion(),"SELECT dni FROM poblador WHERE dni='$dni'");
    $existe=$existeQuery->fetch_assoc();
    $bool=is_null($existe)?false:true;
    return $bool;
}

function verificarExistenciaEnBD($dni){
    $existeQuery=mysqli_query(conexionBD::conexion(),"SELECT dni FROM usuario WHERE dni='$dni'");
    $existe=$existeQuery->fetch_assoc();
    $bool=is_null($existe)?true:false;
    return $bool;
}
?>