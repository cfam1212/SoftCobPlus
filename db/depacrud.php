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
$estado = (isset($_POST['estado'])) ? $_POST['estado'] : 'Activo';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '0';

if($estado == 'Activo'){
    $estado = 'A';
}else $estado = 'I';

//POST UPDATE DEPARTAMENTO

date_default_timezone_set("America/Guayaquil");
$currentdate = date('Y-m-d H:i:s');

switch($opcion){
    case 0: // AGREGAR NUEVO DEPARTAMENTO
        $consulta = "CALL sp_New_Departamento(?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(array(1,$empreid,$nombredepa,$estado,'','','',$id,0,0,$currentdate,$userid,$host));
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 1: //EDITAR DEPARTAMENTO
        $consulta = "CALL sp_New_Departamento(?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(array(3,$empreid,$nombredepa,$estado,'','','',$id,0,0,$currentdate,$userid,$host));
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3: //ELIMINAR DEPARTAMENTO
        $consulta = "CALL sp_New_Departamento(?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(array(4,$empreid,'','','','','',$id,0,0,'',0,''));
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;           
    case 4: //UPDATE ESTO DEPARTAMENTO BDD
        $consulta = "CALL sp_New_Departamento(?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(array(6,$empreid,'',$estado,'','','',$id ,0,0,'',0,''));
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);   
        break;  
}

print json_encode($data, JSON_UNESCAPED_UNICODE);

$conexion = null;

?>