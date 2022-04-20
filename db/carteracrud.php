<?php

session_start();

require_once("conexion.php");
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$data = null;

$userid = $_SESSION["i_usuaid"];
$host = $_SESSION["s_namehost"];
$empreid = $_SESSION["i_emprid"];


$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '0';

date_default_timezone_set("America/Guayaquil");
$currentdate = date('Y-m-d H:i:s');



switch($opcion){
    case 0:// CONSULTA TODOS LOS GESTORES
        $consulta = "CALL sp_New_Cartera(?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(array(4, 0, 0, 0, 0, '', '', '', '', '', 0, 0, 0));
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);   
        break;
    case 1: 
       
        break;
    case 2: 
     
        break;
    case 3:
       
        break;    
}







print json_encode($data, JSON_UNESCAPED_UNICODE);

$conexion = null;

?>