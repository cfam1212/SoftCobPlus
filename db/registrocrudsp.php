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
$idgestor = (isset($_POST['idgestor'])) ? $_POST['idgestor'] : '0';
$estado = (isset($_POST['estado'])) ? $_POST['estado'] : 'Activo';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '0';

$newestado = $estado == 'Activo' ? 'A' : 'I';

//POST UPDATE ESTADO BDD

$idcede = (isset($_POST['idcede'])) ? $_POST['idcede'] : '';
$idsuper = (isset($_POST['idsuper'])) ? $_POST['idsuper'] : '';
$estadochk = (isset($_POST['estadosu'])) ? $_POST['estadosu'] : '';



//date_default_timezone_set("America/Guayaquil");
//$currentdate = date('Y-m-d H:i:s');

switch($opcion){
    case 0: //INSERTAR NUEVO SUPERVISOR
        $consulta = "CALL sp_New_Supervisor(?,?,?,?,?,?,?,?,?,?)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(array(1,$idcedente,$idsupervisor,$newestado,'','',0,0,$userid,$host));
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);              
        break;
    case 1: //INSERTAR NUEVO GESTOR
        $consulta = "CALL sp_New_Gestor(?,?,?,?,?,?,?,?)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(array(0,$idsupervisor,$idgestor,$estado,'','',0,0));
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);              
        break;
    case 2: //ACTUALIZAR ESTADO DEL GESTOR
        $consulta = "CALL sp_New_Gestor(?,?,?,?,?,?,?,?)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(array(1,$idsupervisor,$idgestor,$estado,'','',0,0));
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);         
        break;  
    case 3: //ELIMNAR SUPERVISOR
        $consulta = "CALL sp_New_Supervisor(?,?,?,?,?,?,?,?,?,?)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(array(2,0,$idsupervisor,'','','',0,0,0,''));
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);              
        break;         
    case 4://ELIMINAR GESTOR
        $consulta = "CALL sp_New_Gestor(?,?,?,?,?,?,?,?)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(array(2,$idsupervisor,$idgestor,'','','',0,0));
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);         
        break;
    case 5: //UPDATE ESTADO SUPERVISOR
        $consulta = "CALL sp_New_Supervisor(?,?,?,?,?,?,?,?,?,?)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(array(3,$idcede,$idsuper,$estadochk,'','',0,0,$userid,$host));
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);              
        break;  
          
}

print json_encode($data, JSON_UNESCAPED_UNICODE);

$conexion = null;

?>