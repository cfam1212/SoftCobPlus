<?php

session_start();

require_once("conexion.php");
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$data = null;

$userid = $_SESSION["i_usuaid"];
$host = $_SESSION["s_namehost"];
$empreid = $_SESSION["i_emprid"];

$cedeid = (isset($_POST['cedeid'])) ? $_POST['cedeid'] : '';
$provid = (isset($_POST['provid'])) ? $_POST['provid'] : '';
$ciudid = (isset($_POST['ciudid'])) ? $_POST['ciudid'] : '';
$cedente = (isset($_POST['cedente'])) ? $_POST['cedente'] : '';
$ruc = (isset($_POST['ruc'])) ? $_POST['ruc'] : '';
$direccion = (isset($_POST['direccion'])) ? $_POST['direccion'] : '';
$telefono1 = (isset($_POST['telefono1'])) ? $_POST['telefono1'] : '';
$telefon2 = (isset($_POST['telefono2'])) ? $_POST['telefono2'] : '';
$fax = (isset($_POST['fax'])) ? $_POST['fax'] : '';
$url = (isset($_POST['url'])) ? $_POST['url'] : '';
$estado = (isset($_POST['estado'])) ? $_POST['estado'] : '';
$nivel = (isset($_POST['nivel'])) ? $_POST['nivel'] : '0';
$resultcontacto = (isset($_POST['resultcontacto'])) ? $_POST['resultcontacto'] : '';
$resultproducto = (isset($_POST['resultproducto'])) ? $_POST['resultproducto'] : '';
$resultcatalogo = (isset($_POST['resultcatalogo'])) ? $_POST['resultcatalogo'] : '';
$resultagencia = (isset($_POST['resultagencia'])) ? $_POST['resultagencia'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '0';

date_default_timezone_set("America/Guayaquil");
$currentdate = date('Y-m-d H:i:s');

switch($opcion){
    case 0: //NUEVO
        $consulta = "CALL sp_New_Cedente(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(array(0,$empreid,$cedeid,$provid,$ciudid,$cedente,$ruc,$direccion,$telefono1,$telefon2,$fax,$url,'A',
        $nivel,'','','',0,0,0,$userid,$host));
        //$id = $resultado->fetchAll(PDO::FETCH_ASSOC);
        $cedeid = $resultado->fetchColumn();
        foreach($resultcontacto as $drfila){
            $consulta = "CALL sp_New_Contacto(?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$cedeid,$drfila['arrycodigo'],$drfila['arrycontacto'],$drfila['arrycbocargo'],
            $drfila['arryext'],$drfila['arryemail1'],$drfila['arryemail2'],$drfila['arrycelular'],'','0'));
        }
        foreach($resultproducto as $drfila){
            $consulta = "CALL sp_New_Producto(?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$cedeid,$drfila['arryproducto'],$drfila['arrydescrip'],$drfila['arryestado'],
            '','','0','0'));
            
            $prceid = $resultado->fetchColumn();
            foreach($resultcatalogo as $drfilax){
                if($drfilax['arryproductocat'] == $drfila['arryproducto'])
                {
                    $consulta = "CALL sp_New_Catalogo(?,?,?,?,?,?,?,?,?,?,?)";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute(array(0,$prceid,$drfilax['arrycodigocat'],$drfila['arrycatalogo'],'',
                    $drfila['arryestado'],'','','0','0'));
                }
            }
        }
        $data = "OK";
    break;   

    case 1: //GRABAR EDITAR PERFIL
        try
        {
            $consulta = "CALL sp_New_Perfil(?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(2,$empreid,$id,0,$nombreperfil,$observacion,$valestado,$crear,$modificar,$eliminar,
            $currentdate,$userid,$host));
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
            if($result != '0'){
                foreach($result as $drfila){
                    $consulta = "CALL sp_New_Perfil(?,?,?,?,?,?,?,?,?,?,?,?,?)";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute(array(1,$empreid,$id,$drfila,'','','','','','',$currentdate,$userid,$host));
                }
            }
        }catch(Exception $e)
        {
            $data = $e->getMessage();
        }
    break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);

$conexion = null;