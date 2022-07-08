<?php

    session_start();

    require_once("conexion.php");
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();


    $userid = $_SESSION["i_usuaid"];
    $host = $_SESSION["s_namehost"];
    $empreid = $_SESSION["i_emprid"];


    $cedenteid = (isset($_POST['cedeid'])) ? $_POST['cedeid'] : '0';
    $productoid = (isset($_POST['producid'])) ? $_POST['producid'] : '0';
    $catalogoid = (isset($_POST['catalogoid'])) ? $_POST['catalogoid'] : '0';
    $gestorid = (isset($_POST['idgestor'])) ? $_POST['idgestor'] : '0';

    $datospersona = (isset($_POST['arraypersona'])) ? $_POST['arraypersona'] : '';

    foreach($datospersona as $drfila){
        /*$consulta = "CALL sp_New_Parametro(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $resultado = $conexion->prepare($consulta);
        $valestado = $drfila['arryestado'] == "Activo" ? 'A' : 'I';*/

        $cedula = $drfila['arrycedula'];
        $nombre = $drfila['arrynombres'];
        
        //$resultado->execute(array(1,0,$idPara,'','',$valestado,0,$drfila['arryid'],$drfila['arrydetalle'],
        //$drfila['arryvalorv'],$drfila['arryvalori'],'','','',0,0,0,0,''));
        //$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        $data = 'OK';
    }    

    //print json_encode($data, JSON_UNESCAPED_UNICODE);
    echo $data;

    $conexion = null;    

?>