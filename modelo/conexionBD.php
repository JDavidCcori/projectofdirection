<?php
    class conexionBD{
        static public function conexion(){
            $servidor="localhost";
            $baseDeDatos="comunidad";
            $usuario="root";
            $contrasenia="";
            $ruta=3360;
            $conexionBD=new mysqli($servidor,$usuario,$contrasenia,$baseDeDatos,$ruta);

            return $conexionBD;
        }
    }
?>

