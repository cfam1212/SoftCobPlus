<?php

session_start();

require_once("conexion.php");
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$data = null;

$userid = $_SESSION["i_usuaid"];
$host = $_SESSION["s_namehost"];
$emprid = $_SESSION["i_emprid"];

$codigo= (isset($_POST['codigo'])) ? $_POST['codigo'] : '';
$result = (isset($_POST['result'])) ? $_POST['result'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$cboid = (isset($_POST['id'])) ? $_POST['id'] : '';

date_default_timezone_set("America/Guayaquil");

switch($opcion){
    case "0": //NUEVO  
        foreach($result as $drfila){
            $consulta = "CALL sp_New_Perfiles(?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $valestado = $drfila['arryestado'] == "Activo" ? 'A' : 'I';
            $resultado->execute(array(0,$drfila['arrydescripcion'],$drfila['arryestado'],$codigo,0,0,0,$userid,$host));
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        }
        $data = '0';
        break;    
    case "1": //CONSULTAR
            $consulta = "CALL sp_New_Perfiles(?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(1,'','',$cboid,0,0,0,0,''));
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case "2": // ELIMINNAR 
      
}

print json_encode($data, JSON_UNESCAPED_UNICODE);

$conexion = null;