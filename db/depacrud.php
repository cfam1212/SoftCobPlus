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
$nombredepa = (isset($_POST['nomdepa'])) ? $_POST['nomdepa'] : '';
$estado = (isset($_POST['estado'])) ? $_POST['estado'] : 'A';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '0';

date_default_timezone_set("America/Guayaquil");
$currentdate = date('Y-m-d H:i:s');

switch($opcion){
    case 0:
        $consulta = "CALL sp_New_Departamento(?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(array(1,$_SESSION["i_emprid"],$nombredepa,$estado,'','','',0,0,0,$currentdate,$userid,$host)); 

        $consulta = "CALL sp_New_Departamento(?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(array(0,$empreid,'','','','','',0,0,0,'',0,''));
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);              
        break;
    case 1:
        $consulta = "CALL sp_New_Departamento(?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(array(2,$empreid,$nombredepa,'','','','',$id,0,0,'',0,''));
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);              
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);

$conexion = null;

?>