<?php

session_start();

require_once("conexion.php");
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$data = null;

$userid = $_SESSION["i_usuaid"];
$host = $_SESSION["s_namehost"];
$empreid = $_SESSION["i_emprid"];

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '0';
$conid = (isset($_POST['idcon'])) ? $_POST['idcon'] : '';
$cedeid = (isset($_POST['id'])) ? $_POST['id'] : '';
$contacto = (isset($_POST['contacto'])) ? $_POST['contacto'] : '';
$cargo = (isset($_POST['cargo'])) ? $_POST['cargo'] : '';
$ext = (isset($_POST['ext'])) ? $_POST['ext'] : '';
$celular = (isset($_POST['celular'])) ? $_POST['celular'] : '';
$email1 = (isset($_POST['email1'])) ? $_POST['email1'] : '';
$email2 = (isset($_POST['email2'])) ? $_POST['email2'] : '';

date_default_timezone_set("America/Guayaquil");
$currentdate = date('Y-m-d H:i:s');

switch($opcion){
 case 0:

    $consulta = "CALL sp_New_Contacto(?,?,?,?,?,?,?,?,?,?,?)";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute(array(1,$cedeid,0,$contacto,$cargo,$ext,$email1,$email2,$celular,'',0));
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    break;
case 1: // ELIMINAR CONTACTO BDD
    $consulta = "CALL sp_New_Contacto(?,?,?,?,?,?,?,?,?,?,?)";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute(array(2,0,$conid,'' ,'','','','','','',0));
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    break;


}




?>

