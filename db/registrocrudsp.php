<?php
session_start();

require_once("conexion.php");
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$data = null;

$userid = $_SESSION["i_usuaid"];
$host = $_SESSION["s_namehost"];


$idsupervisor = (isset($_POST['idsupervisor'])) ? $_POST['idsupervisor'] : '0';
$idcedente = (isset($_POST['idcedente'])) ? $_POST['idcedente'] : '0';
$estado = (isset($_POST['estado'])) ? $_POST['estado'] : 'Activo';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '0';

$newestado = $estado == 'Activo' ? 'A' : 'I';

//date_default_timezone_set("America/Guayaquil");
//$currentdate = date('Y-m-d H:i:s');

switch($opcion){
    case 0: 
        $consulta = "CALL sp_New_Supervisor(?,?,?,?,?,?,?,?,?,?)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(array(1,$idcedente,$idsupervisor,$newestado,'','',0,0,$userid,$host));
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);              
        break;
    case 1: 
        $consulta = "CALL sp_New_Gestor(?,?,?,?,?,?,?,?,?,?)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(array(1,$idcedente,$idsupervisor,$newestado,'','',0,0,$userid,$host));
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);              
        break;    
}

print json_encode($data, JSON_UNESCAPED_UNICODE);

$conexion = null;

?>