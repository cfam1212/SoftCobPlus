<?php 
    
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    require_once("conexion.php");
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    $data = null;
    
    $opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : 0;
    $id = (isset($_POST['id'])) ? $_POST['id'] : 0;
    
    switch($opcion){
     case 0: //LLENAR CIUDAD
        $cbo = 'Ciudad';
        $consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(array(30,0,'','','','','','',$id,0,0,0,0,0));        
        $dropbox = $resultado->fetchAll(PDO::FETCH_ASSOC);                  
         break;       

    }

?>

<option value="0">--Seleccione <?php echo $cbo ?>--</option>
<?php foreach($dropbox as $opc): //creamos las opciones a partir de los datos obtenidos ?>
<option value="<?= $opc['Codigo'] ?>"><?= $opc['Descripcion'] ?></option>
<?php endforeach; ?>