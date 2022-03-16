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
$idperfil = (isset($_POST['id'])) ? $_POST['id'] : '0';
$descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : '';
$estado = (isset($_POST['estado'])) ? $_POST['estado'] : '';
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

    case "3": //EDITAR PERFIL DE CALIFICACION
        $consulta = "CALL sp_New_Perfiles(?,?,?,?,?,?,?,?,?)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(array(3,'',$cboid,$estado,$idperfil,0,0,0,''));
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;    

    case "4": //EDITAR PERFIL DE CALIFICACION
        $consulta = "CALL sp_New_Perfiles(?,?,?,?,?,?,?,?,?)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(array(4,'',$cboid,$descripcion,$idperfil,0,0,0,''));
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;           
      
}

print json_encode($data, JSON_UNESCAPED_UNICODE);

$conexion = null;