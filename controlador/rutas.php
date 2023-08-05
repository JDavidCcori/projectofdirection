<?php

if(isset($_GET["modulo"])){
    switch ($_GET["modulo"]){
        case 'actas':
            header('location:secretario/actasVista.php');
            break;
        
        case 'asistencias':
            include("secretario/asistenciaV.php");
            break;
        
        case 'pobladores':
            include("secretario/modulo_PobladoresV.php");
            break;

        case 'deudas':
            include("tesorero/modulo_DeudasV.php");
            break;    

        case 'usuarios':
            include("secretario/modulo_UsuariosV.php");
            break;    
            
        default:
            include("secretario/modulo_PobladoresV.php");
            break;
    }
    
}else{
    include("secretario/modulo_PobladoresV.php");
}
