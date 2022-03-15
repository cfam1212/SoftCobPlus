<?php

session_start();

require_once("conexion.php");
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$data = null;

$userid = $_SESSION["i_usuaid"];
$host = $_SESSION["s_namehost"];
$emprid = $_SESSION["i_emprid"];

$cboid = (isset($_POST['cboid'])) ? $_POST['cboid'] : '';
$descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : '';
$codigo= (isset($_POST['codigo'])) ? $_POST['codigo'] : '0';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '0';

//date_default_timezone_set("America/Guayaquil");

switch($opcion){
    case "0": //NUEVO  
        $consulta = "CALL sp_New_Perfiles(?,?,?,?,?,?,?,?,?)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(array(0,$descripcion,'',$cboid,0,0,0,0,''));
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);        
        /*foreach($result as $drfila){
            $consulta = "CALL sp_New_Perfiles(?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $valestado = $drfila['arryestado'] == "Activo" ? 'A' : 'I';
            $resultado->execute(array(0,$drfila['arrydescripcion'],$valestado,$codigo,0,0,0,$userid,$host));
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        }
        $data = '0';*/
        break;    
    case "1": //CONSULTAR
        try {
            $consulta = "CALL sp_New_Perfiles(?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(1,'','',$cboid,0,0,0,0,''));
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            $data = null;
        }

        break;
    case "2": // ELIMINNAR 
        break;

    case "3": //EDITAR ESTADO PERFILES DE CALIFICACION
        $consulta = "CALL sp_New_Perfiles(?,?,?,?,?,?,?,?,?)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(array(3,'',$codigo,$estado,$cboid,0,0,0,''));
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;    
      
}

print json_encode($data, JSON_UNESCAPED_UNICODE);

$conexion = null;