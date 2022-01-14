<?php
session_start();

require_once("conexion.php");
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$data = null;

$userid = $_SESSION["i_usuaid"];
$host = $_SESSION["s_namehost"];
$empreid = $_SESSION["i_emprid"];

$id = (isset($_POST['id'])) ? $_POST['id'] : '0';
$nomcedente = (isset($_POST['cedente'])) ? $_POST['cedente'] : '';
$nomcedente = (isset($_POST['supervisor'])) ? $_POST['supervisor'] : '';
$estado = (isset($_POST['estado'])) ? $_POST['estado'] : 'Activo';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '0';

if($estado == 'Activo'){
    $estado = 'A';
}else $estado = 'I';

date_default_timezone_set("America/Guayaquil");
$currentdate = date('Y-m-d H:i:s');

$consulta = "CALL sp_New_Supervisor(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array($tipo,$empreid,$nombredepa,$estado,'','','',$id,0,0,$currentdate,$userid,$host));
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

switch($opcion){
    case 0: 
        $consulta = "CALL sp_New_Departamento(?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(array(0,$empreid,'','','','','',0,0,0,'',0,''));
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);              
        break;  
}

print json_encode($data, JSON_UNESCAPED_UNICODE);

$conexion = null;

?>