<?php
session_start();

require_once("conexion.php");
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$data = null;

ini_set('memory_limit', '2GB');

$userid = $_SESSION["i_usuaid"];
$host = $_SESSION["s_namehost"];
$empreid = $_SESSION["i_emprid"];



$cedenteid = (isset($_POST['cedeid'])) ? $_POST['cedeid'] : '0';
$productoid = (isset($_POST['producid'])) ? $_POST['producid'] : '0';
$catalogoid = (isset($_POST['catalogoid'])) ? $_POST['catalogoid'] : '0';
//campos persona
$cedula = (isset($_POST['cedula'])) ? $_POST['cedula'] : '';
$nombres = (isset($_POST['nombres'])) ? $_POST['nombres'] : '';
$apellidos = (isset($_POST['apellidos'])) ? $_POST['apellidos'] : '';
$fechanaci = (isset($_POST['fechanaci'])) ? $_POST['fechanaci'] : '';
$provincia = (isset($_POST['provincia'])) ? $_POST['provincia'] : '0';
$ciudad = (isset($_POST['ciudad'])) ? $_POST['ciudad'] : '0';
$direcciondom = (isset($_POST['direcciondom'])) ? $_POST['direcciondom'] : '';
$referenciadom = (isset($_POST['referenciadom'])) ? $_POST['referenciadom'] : '';
$direcciontra = (isset($_POST['direcciontra'])) ? $_POST['direcciontra'] : '';
$referenciatra = (isset($_POST['referenciatra'])) ? $_POST['referenciatra'] : '';
$email = (isset($_POST['email'])) ? $_POST['email'] : '';
$totaldeuda = (isset($_POST['totaldeuda'])) ? $_POST['totaldeuda'] : '0';
$diasmora = (isset($_POST['diasmora'])) ? $_POST['diasmora'] : '0';
$capitalxvencer = (isset($_POST['capitalxvencer'])) ? $_POST['capitalxvencer'] : '0';
$capitalvencido = (isset($_POST['capitalvencido'])) ? $_POST['capitalvencido'] : '0';
$capitalmora = (isset($_POST['capitalmora'])) ? $_POST['capitalmora'] : '0';
$valorexigible = (isset($_POST['valorexigible'])) ? $_POST['valorexigible'] : '0';
$fechaobligacion = (isset($_POST['fechaobligacion'])) ? $_POST['fechaobligacion'] : '';
$fechavencimiento = (isset($_POST['fechavencimiento'])) ? $_POST['fechavencimiento'] : '';
$fechaultpago = (isset($_POST['fechaultpago'])) ? $_POST['fechaultpago'] : '';
$fonodeu1 = (isset($_POST['fonodeu1'])) ? $_POST['fonodeu1'] : '0';
$fonodeu2 = (isset($_POST['fonodeu2'])) ? $_POST['fonodeu2'] : '0';
$fonodeu3 = (isset($_POST['fonodeu3'])) ? $_POST['fonodeu3'] : '0';
$fonodeu4 = (isset($_POST['fonodeu4'])) ? $_POST['fonodeu4'] : '0';
$fonodeu5 = (isset($_POST['fonodeu5'])) ? $_POST['fonodeu5'] : '0';
$fonodeu6 = (isset($_POST['fonodeu6'])) ? $_POST['fonodeu6'] : '0';
$fonodeu7 = (isset($_POST['fonodeu7'])) ? $_POST['fonodeu7'] : '0';
$fonodeu8 = (isset($_POST['fonodeu8'])) ? $_POST['fonodeu8'] : '0';
$fonodeu9 = (isset($_POST['fonodeu9'])) ? $_POST['fonodeu9'] : '0';
$fonodeu10 = (isset($_POST['fonodeu10'])) ? $_POST['fonodeu10'] : '0';
//campos persona referencias
$cedularef1 = (isset($_POST['cedularef1'])) ? $_POST['cedularef1'] : '';
$nombreref1 = (isset($_POST['nombreref1'])) ? $_POST['nombreref1'] : '';
$fono1ref1 = (isset($_POST['fono1ref1'])) ? $_POST['fono1ref1'] : '0';
$fono2ref1 = (isset($_POST['fono2ref1'])) ? $_POST['fono2ref1'] : '0';
$direcciondomref1 = (isset($_POST['direcciondomref1'])) ? $_POST['direcciondomref1'] : '';
$referenciadomref1 = (isset($_POST['referenciadomref1'])) ? $_POST['referenciadomref1'] : '';
$emailref1 = (isset($_POST['emailref1'])) ? $_POST['emailref1'] : '';

$cedularef2 = (isset($_POST['cedularef2'])) ? $_POST['cedularef2'] : '';
$nombreref2 = (isset($_POST['nombreref2'])) ? $_POST['nombreref2'] : '';
$fono1ref2 = (isset($_POST['fono1ref2'])) ? $_POST['fono1ref2'] : '0';
$fono2ref2 = (isset($_POST['fono2ref2'])) ? $_POST['fono2ref2'] : '0';
$direcciondomref2 = (isset($_POST['direcciondomref2'])) ? $_POST['direcciondomref2'] : '';
$referenciadomref2 = (isset($_POST['referenciadomref2'])) ? $_POST['referenciadomref2'] : '';
$emailref2 = (isset($_POST['emailref2'])) ? $_POST['emailref2'] : '';
//campos persona garantes

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '0';
$estado = (isset($_POST['estado'])) ? $_POST['estado'] : 'Activo';

$newestado = $estado == 'Activo' ? 'A' : 'I';


date_default_timezone_set("America/Guayaquil");
$currentdate = date('Y-m-d H:i:s');

switch($opcion){
    case 0: //INSERTAR PERSONA 
          
                $consulta = "CALL sp_Subir_Cartera_Persona(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute(array(0,'','','',0,0,$currentdate,$userid,$host));
                
                $personaid = $resultado->fetchColumn();
                     
            
    case 1: //
      
    case 2: //
      
    case 3: //
             
    case 4://
     
    case 5: //
      
          
}

print json_encode($data, JSON_UNESCAPED_UNICODE);

$conexion = null;

?>