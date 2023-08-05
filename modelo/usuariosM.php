<?php
   require(__DIR__ . '/../modelo/conexionBD.php');

    function validarUsuarioM($DNI){

        // $contraLimpia=$contraseña;
        // "$DNI.....$contraseña";
        $consulta="SELECT * from `usuario` where dni='$DNI' ";
      //  $consulta="SELECT * FROM `usuario` WHERE `dni`=71609235 and `contrasenia`='123'";
        $respuesta=mysqli_query(conexionBD::conexion(),$consulta);

       return $respuesta->fetch_array(MYSQLI_ASSOC);
      // return $DNI;
    }

?>