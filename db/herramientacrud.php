<?php
session_start();

require_once("conexion.php");
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$data = null;

$userid = $_SESSION["i_usuaid"];
$host = $_SESSION["s_namehost"];
$empreid = $_SESSION["i_emprid"];


$cedenteid = (isset($_POST['cedeid'])) ? $_POST['cedeid'] : '0';
$productoid = (isset($_POST['producid'])) ? $_POST['producid'] : '0';
$catalogoid = (isset($_POST['catalogoid'])) ? $_POST['catalogoid'] : '0';
$estado = (isset($_POST['estado'])) ? $_POST['estado'] : 'Activo';
$resultcartera = (isset($_POST['cartera'])) ? $_POST['cartera'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '0';

$newestado = $estado == 'Activo' ? 'A' : 'I';


date_default_timezone_set("America/Guayaquil");
$currentdate = date('Y-m-d H:i:s');

switch($opcion){
    case 0: //INSERTAR PERSONA 
            if($resultcartera != '')
            {
                foreach($resultcartera as $fila){
                $consulta = "CALL sp_Subir_Cartera_Persona(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute(array(0,'',$fila['arrycedula'],$fila['arrynombres'],$fila['arryapellidos'],'',
                $fila['arryfechanac'],'',$fila['arryprovincia'],0,'',$fila['arrydirecdom'],$fila['arryrefedom'],
                $fila['arrydirectra'],'', $fila['arryemail'],'','',0,0,$currentdate,$userid,$host));
                
                $personaid = $resultado->fetchColumn();
                }
            }
    case 1: //
      
    case 2: //
      
    case 3: //
             
    case 4://
     
    case 5: //
      
          
}

print json_encode($data, JSON_UNESCAPED_UNICODE);

$conexion = null;

?>