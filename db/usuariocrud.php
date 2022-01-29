<?php

session_start();

require_once("conexion.php");
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$data = null;

$userid = $_SESSION["i_usuaid"];
$host = $_SESSION["s_namehost"];
$empreid = $_SESSION["i_emprid"];

$perfil = (isset($_POST['perfil'])) ? $_POST['perfil'] : '0';
$depar = (isset($_POST['depar'])) ? $_POST['depar'] : '0';
$tipouser = (isset($_POST['tipouser'])) ? $_POST['tipouser'] : '0';
$username = (isset($_POST['username'])) ? $_POST['username'] : '';
$lastname = (isset($_POST['lastname'])) ? $_POST['lastname'] : '';
$login = (isset($_POST['login'])) ? $_POST['login'] : '';
$password = (isset($_POST['password'])) ? $_POST['password'] : '';
$estado = (isset($_POST['estado'])) ? $_POST['estado'] : 'Activo';
$caduca = (isset($_POST['caduca'])) ? $_POST['caduca'] : 'NO';
$fechacaduca = (isset($_POST['fechacaduca'])) ? $_POST['fechacaduca'] : '01/01/2020';
$cambiar = (isset($_POST['cambiar'])) ? $_POST['cambiar'] : 'NO';
$fotoimg = (isset($_FILES['imagen']["name"])) ? $_FILES['imagen']["name"] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '0';
$id = (isset($_POST['id'])) ? $_POST['id'] : '0';
$nombreArchivo = '';

if($caduca == 'SI'){
    $caduca = 'SI';
}else $caduca = 'NO';

if($estado == 'Activo'){
    $estado = 'A';
}else $estado = 'I';

if($cambiar == 'SI'){
    $cambiar = 'SI';
}else $cambiar = 'NO';

date_default_timezone_set("America/Guayaquil");
$currentdate = date('Y-m-d H:i:s');

switch($opcion){
    case 0: //NUEVO
        if($id == 0)
        {
            $fecha = new DateTime();
            $nombreArchivo = ($fotoimg != "") ? $fecha->getTimestamp() ."_". $_FILES["imagen"]["name"] : "";

            if($fotoimg != ''){
                $tmpFoto = $_FILES["imagen"]["tmp_name"];

                if($tmpFoto != ""){
                    move_uploaded_file($tmpFoto,"../images/".$nombreArchivo);
                }
            }
            $consulta = "CALL sp_New_Usuario(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,0,$perfil,$empreid,$username,$lastname,'',$login,$password,'A',$caduca,$fechacaduca,
            $cambiar,$nombreArchivo,$userid,$host,$depar,$tipouser,'','',0,0,0));
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC); 
        }        
    break;
    case 1:
        $opc = 1;
        if($fotoimg != ""){
            $tmpFoto = $_FILES["imagen"]["tmp_name"];
            if($tmpFoto != ""){
                $consulta = "SELECT usua_imagepath FROM seguridad_usuario WHERE usua_id=?";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute(array($id));
                $userfoto = $resultado->fetch(PDO::FETCH_LAZY);   
                if($userfoto["usua_imagepath"] != ""){
                    if(file_exists("../images/" . $userfoto["usua_foto"])){
                        unlink("../images/" . $userfoto["usua_foto"]);
                    }
                }
                $opc = 2;
                $fecha = new DateTime();
                $nombreArchivo = ($fotoimg != "") ? $fecha->getTimestamp() . "_" . $_FILES["imagen"]["name"] : "";
                move_uploaded_file($tmpFoto,"../images/".$nombreArchivo);                
            }                
        }
        $consulta = "CALL sp_New_Usuario(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(array($opc,$id,$perfil,$empreid,$username,$lastname,'',$login,'','',$caduca,$fechacaduca,$cambiar,$nombreArchivo,
                $userid,$host,$depar,$tipouser,'','',0,0,0));
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

        $consulta = "SELECT u.usua_id AS UserId, CONCAT_WS(' ',u.usua_nombres,u.usua_apellidos) AS Usuario, u.usua_login AS Namelogin, 
                    p.perf_descripcion AS Perfil, CASE u.usua_estado WHEN 'A' THEN 'Activo' ELSE 'Inactivo' END AS Estado 
                    FROM seguridad_usuario u INNER JOIN seguridad_perfil p ON u.perf_id = p.perf_id WHERE u.usua_id = '$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);  
    break; 
    case 2:
        $opc = 3;
        if($fotoimg != ""){
            $tmpFoto = $_FILES["imagen"]["tmp_name"];
            if($tmpFoto != ""){
                $consulta = "SELECT usua_imagepath FROM usuarios WHERE usua_id=?";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute(array($id));
                $userfoto = $resultado->fetch(PDO::FETCH_LAZY);   
                if($userfoto["usua_imagepath"] != ""){
                    if(file_exists("../images/" . $userfoto["usua_imagepath"])){
                        unlink("../images/" . $userfoto["usua_imagepath"]);
                    }
                }            
                $opc = 4;
                $fecha = new DateTime();
                $nombreArchivo = ($fotoimg != "") ? $fecha->getTimestamp() . "_" . $_FILES["imagen"]["name"] : "";
                move_uploaded_file($tmpFoto,"../images/".$nombreArchivo);                
            }
        }        
        $consulta = "CALL sp_New_Usuario(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(array($opc,$id,$perfil,$empreid,$username,$lastname,'',$login,$password,'',$caduca,$fechacaduca,$cambiar,
                $nombreArchivo,$userid,$host,$depar,$tipouser,'','',0,0,0));  
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

        $consulta = "SELECT u.usua_id AS UserId, CONCAT_WS(' ',u.usua_nombres,u.usua_apellidos) AS Usuario, u.usua_login AS Namelogin, 
                    p.perf_descripcion AS Perfil, CASE u.usua_estado WHEN 'A' THEN 'Activo' ELSE 'Inactivo' END AS Estado 
                    FROM seguridad_usuario u INNER JOIN seguridad_perfil p ON u.perf_id = p.perf_id WHERE u.usua_id = '$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);  
        break;

    case 3: //UPDATE ESTADO USUARIO BDD
        $consulta = "CALL sp_New_Usuario(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(array(5,$id,0,0,'','','','','',$estado,'','','',
        '',0,'',0,'','','',0,0,0));  
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);

$conexion = null;