<?php

session_start();

require_once("conexion.php");
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$data = null;

$userid = $_SESSION["i_usuaid"];
$host = $_SESSION["s_namehost"];
$emprid = $_SESSION["i_emprid"];

$nombreparametro = (isset($_POST['nombremenu'])) ? $_POST['nombremenu'] : '';
$descripcion = (isset($_POST['iconome'])) ? $_POST['iconome'] : '';
$result = (isset($_POST['result'])) ? $_POST['result'] : '';
$estado = (isset($_POST['estado'])) ? $_POST['estado'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$valestado = $estado == "Activo" ? 'A' : 'I';

date_default_timezone_set("America/Guayaquil");
$currentdate = date('Y-m-d H:i:s');

$consulta = "CALL sp_New_Parametro(?,?,?,?,?,?,?,?,?,?,?,??,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array($opcion,$empreid,$id,$nombreparametro,$descripcion,$valestado,0,0,'','',0,'','','',0,0,0,$userid,$host));
//$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
$data = $resultado->fetchColumn();

switch($opcion){
    case "0": //NUEVO
        $idpara = $data['Id'];
        foreach($result as $drfila){
            $consulta = "CALL sp_New_Parametro(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(1,0,$idpara,'','',$drfila['arryestado'],0,$drfila['arry_id'],$drfila['arrydetalle'],
            $drfila['arryvalorv'],$drfila['arryvalori'],'','','',0,0,0,0,''));
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        }
        break;    
    case "1": //ELIMINAR

        break;
    case "2": // ORDER MENU
   
    break;
    case "3": //GRABAR EDITAR MENU

    break;

}

print json_encode($data, JSON_UNESCAPED_UNICODE);

$conexion = null;