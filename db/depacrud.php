<?php
session_start();

require_once("conexion.php");
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$data = null;

$userid = $_SESSION["i_usuaid"];
$host = $_SESSION["s_namehost"];
$empreid = $_SESSION["i_emprid"];

$nombredepa = (isset($_POST['txtDepa'])) ? $_POST['txtDepa'] : '';
$estado = (isset($_POST['chkEstado'])) ? $_POST['chkEstado'] : 'Activo';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '0';

$in_tipo = (isset($_POST['tipo'])) ? $_POST['tipo'] : '';
$in_auxv1 = (isset($_POST['auxv1'])) ? $_POST['auxv1'] : '';
$in_auxv2 = (isset($_POST['auxv2'])) ? $_POST['auxv2'] : '';
$in_auxv3 = (isset($_POST['auxv3'])) ? $_POST['auxv3'] : '';
$in_auxv4 = (isset($_POST['auxv4'])) ? $_POST['auxv4'] : '';
$in_auxv5 = (isset($_POST['auxv5'])) ? $_POST['auxv5'] : '';
$in_auxv6 = (isset($_POST['auxv6'])) ? $_POST['auxv6'] : '';
$in_auxi1 = (isset($_POST['auxi1'])) ? $_POST['auxi1'] : '0';
$in_auxi2 = (isset($_POST['auxi2'])) ? $_POST['auxi2'] : '0';
$in_auxi3 = (isset($_POST['auxi3'])) ? $_POST['auxi3'] : '0';
$in_auxi4 = (isset($_POST['auxi4'])) ? $_POST['auxi4'] : '0';
$in_auxi5 = (isset($_POST['auxi5'])) ? $_POST['auxi5'] : '0';
$in_auxi6 = (isset($_POST['auxi6'])) ? $_POST['auxi6'] : '0';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '0';

date_default_timezone_set("America/Guayaquil");
$currentdate = date('Y-m-d H:i:s');


switch($opcion){
  
    case 1: //GRABAR EDITAR PERFIL
        try
        {
            $consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(4,$empreid,'','','','','','',$in_auxi2,0,0,0,0,0));
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);        
            break;
        }catch(Exception $e)
        {
            $data = $e->getMessage();
        }
    
}

print json_encode($data, JSON_UNESCAPED_UNICODE);

$conexion = null;

?>