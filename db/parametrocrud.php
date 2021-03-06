<?php

session_start();

require_once("conexion.php");
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$data = null;

$userid = $_SESSION["i_usuaid"];
$host = $_SESSION["s_namehost"];
$emprid = $_SESSION["i_emprid"];

$idparametro = (isset($_POST['idpa'])) ? $_POST['idpa'] : '';
$nomparametro = (isset($_POST['nomparametro'])) ? $_POST['nomparametro'] : '';
$descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : '';
$result = (isset($_POST['result'])) ? $_POST['result'] : '';
$estado = (isset($_POST['estado'])) ? $_POST['estado'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$detalle = (isset($_POST['detalle'])) ? $_POST['detalle'] : '';
$valorv = (isset($_POST['valorv'])) ? $_POST['valorv'] : '';
$valori = (isset($_POST['valori'])) ? $_POST['valori'] : '';
$orden = (isset($_POST['orden'])) ? $_POST['orden'] : '';
$valestado = $estado == "Activo" ? 'A' : 'I';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

date_default_timezone_set("America/Guayaquil");
$currentdate = date('Y-m-d H:i:s');

switch($opcion){
    case "0": //NUEVO
        $consulta = "CALL sp_New_Parametro(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(array(0,$emprid,$id,$nomparametro,$descripcion,$valestado,0,0,'','',0,'','','',0,0,0,$userid,$host));
        $idPara = $resultado->fetchColumn();        
        foreach($result as $drfila){
            $consulta = "CALL sp_New_Parametro(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $valestado = $drfila['arryestado'] == "Activo" ? 'A' : 'I';
            $resultado->execute(array(1,0,$idPara,'','',$valestado,0,$drfila['arryid'],$drfila['arrydetalle'],
            $drfila['arryvalorv'],$drfila['arryvalori'],'','','',0,0,0,0,''));
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        }
        $data = '0';
        break;    
    case "1": //MODIFICAR
        $consulta = "CALL sp_New_Parametro(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(array(2,$emprid,$id,$nomparametro,$descripcion,'',0,0,'','',0,'','','',0,0,0,$userid,$host));
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        
              
        // foreach($result as $drfila){
        //     $consulta = "CALL sp_New_Parametro(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        //     $resultado = $conexion->prepare($consulta);
        //     $valestado = $drfila['arryestado'] == "Activo" ? 'A' : 'I';
        //     $resultado->execute(array(1,0,$id,'','',$valestado,0,$drfila['arryid'],$drfila['arrydetalle'],
        //     $drfila['arryvalorv'],$drfila['arryvalori'],'','','',0,0,0,0,''));
        //     $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        // }       
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
    case "3": //UPDATE ESTADO PARAMETRO BDD
            $consulta = "CALL sp_New_Parametro(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(3,$emprid,$idparametro,'','',$estado,0,0,'','',0,'','','',0,0,0,0,''));
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
    case "4": //UPDATE ESTADO PARAMETRO DETALLE BDD
            $consulta = "CALL sp_New_Parametro(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(4,0,0,'','',$valestado,$id,0,'','',0,'','','',0,0,0,0,''));
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
    case "5": //NUEVO PARAMETRO DETALLE
            $consulta = "CALL sp_New_Parametro(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(5,0,$id,'','',$valestado,0,$orden,$detalle,$valorv,$valori,'','','',0,0,0,0,''));
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;    
    case "6": //
            $consulta = "CALL sp_New_Parametro(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(6,0,$idparametro,'','','',$id,0,'','',0,'','','',0,0,0,0,''));
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
    case "7": //UPDATE PARAMETRO DETALLA DIRECTO BDD
            $consulta = "CALL sp_New_Parametro(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(7,0,0,'','','',$id,0,$detalle,$valorv,$valori,'','','',0,0,0,0,''));
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;                                 
}

print json_encode($data, JSON_UNESCAPED_UNICODE);

$conexion = null;