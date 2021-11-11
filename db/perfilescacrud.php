<?php

session_start();

require_once("conexion.php");
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$data = null;

$userid = $_SESSION["i_usuaid"];
$host = $_SESSION["s_namehost"];
$emprid = $_SESSION["i_emprid"];

$codigo= (isset($_POST['nomparametro'])) ? $_POST['nomparametro'] : '';
$result = (isset($_POST['result'])) ? $_POST['result'] : '';

date_default_timezone_set("America/Guayaquil");

switch($opcion){
    case "0": //NUEVO      
        foreach($result as $drfila){
            $consulta = "CALL sp_New_Perfiles(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $valestado = $drfila['arryestado'] == "Activo" ? 'A' : 'I';
            $resultado->execute(array(0,0,$idPara,'','',$valestado,0,$drfila['arrydescripcion'],$drfila['arryestado'],
            $drfila['arryvalorv'],$drfila['arryvalori'],'','','',0,0,0,0,''));
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        }
        $data = '0';
        break;    
    case "1": //MODIFICAR
        $consulta = "CALL sp_New_Parametro(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(array(2,$emprid,$id,$nomparametro,$descripcion,$valestado,0,0,'','',0,'','','',0,0,0,$userid,$host));
              
        foreach($result as $drfila){
            $consulta = "CALL sp_New_Parametro(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $valestado = $drfila['arryestado'] == "Activo" ? 'A' : 'I';
            $resultado->execute(array(1,0,$id,'','',$valestado,0,$drfila['arry_id'],$drfila['arrydetalle'],
            $drfila['arryvalorv'],$drfila['arryvalori'],'','','',0,0,0,0,''));
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        }
        $data = '0';        
        break;
    case "2": // ELIMINNAR PARAMETRO-DETALLE
        $consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(array(34,$_SESSION["i_emprid"],'','','','','','',$id,0,0,0,0,0));
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC); 
        if($data == 0) {
            $consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(35,$_SESSION["i_emprid"],'','','','','','',$id,0,0,0,0,0));
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);     
        }else{
            $data = "NO";
        }   
    break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);

$conexion = null;