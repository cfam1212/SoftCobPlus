<?php

    ini_set('display_errors', 0);

    require_once '../dashmenu/panel_menu.php';
    require_once '../funciones/funciones.php';

    //$xServidor = $_SERVER['HTTP_HOST'];
    //$xServerName = $_SERVER['SERVER_NAME'];

    //echo $xServerName;
    //exit(0);

    @session_start();

    $userid = $_SESSION["i_usuaid"];
    $host = $_SESSION["s_namehost"];
    $empreid = $_SESSION["i_emprid"];    
        
    if(isset($_SESSION["s_usuario"])){
        if($_SESSION["s_login"] != "loged"){
            header("Location: ./logout.php");
            exit();
        } else{
        }
    } else{
        header("Location: ./logout.php");
        exit();
    }

    $consulta = "CALL sp_New_Cartera(?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute(array(1, 0, 0, 0, 0, '', '', '', '', '', 0, 0, 0));
    $dataciu = $resultado->fetchAll(PDO::FETCH_ASSOC);

    //$menuid = (isset($_POST['id'])) ? $_POST['id'] : '';
    //$subiocartera = (isset($_POST['subiocartera'])) ? $_POST['subiocartera'] : '';

    $MostarData = 0;

    if (isset($_POST['Enviar'])) {

        $cedeid = safe($_POST['cbocedente']);

        if (is_uploaded_file($_FILES['file_input']['tmp_name'])) {
            //echo "<h1>" . "File ". $_FILES['file_input']['name'] ." subido." . "</h1>";
            //echo "<h2>Datos subidos:</h2>";
            //readfile($_FILES['file_input']['tmp_name']);
            $type = $_FILES['file_input']['type'];
            $size = $_FILES['file_input']['size'];
        }
    
        if($type == 'application/vnd.ms-excel' and $size < 100000){
            //Import uploaded file to Database
            $handle = fopen($_FILES['file_input']['tmp_name'], "r");
        
            while (($data = fgetcsv($handle, 2000, ";")) !== FALSE) {
                if(str_contains($data[0], 'Cedula'))
                {
                    
                }else{

                    $nombrecompleto = $data[1].' '.$data[2];

                    $consulta = "CALL sp_Subir_Cartera_Persona(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute(array(0,'C',$data[0],$data[1],$data[2],$nombrecompleto,$data[3],'M',$data[4],
                    $data[5],'S','A',$userid,$host));
                    
                    $personaid = $resultado->fetchColumn(); 

                    $tipocliente = 'TIT';
                    $tipotelefono = '';                

                    if($data[21] != ''){

                        $primervalor = substr($data[21], 0, 1);
                        $segvalor = substr($data[21], 0, 2);
                        $largo = strlen($data[21]);

                        if(strlen($data[21]) > 8 || strlen($data[21]) < 11){
                        
                            switch($segvalor){
                                case "09":
                                    $tipotelefono = 'CEL';
                                break; 
                                case "02":
                                case "03":
                                case "04":
                                case "05":
                                case "06":
                                case "07":
                                case "08":
                                    $tipotelefono = 'CON';
                                break;   

                            }
                        }   
                    
                        if(strlen($data[21]) > 6 || strlen($data[21]) < 11){

                            switch($primervalor){
                                case "9":
                                    $tipotelefono = 'CEL';
                                    if($largo == 9){
                                        $data[21] = '0' . $data[21];
                                    }
                                break;
                                    
                                case "2":
                                case "3":
                                case "4":
                                case "5":
                                case "6":
                                case "7":
                                case "8":
                                    $tipotelefono = 'CON';

                                    if($largo == 7){
                                        $data[21] = '02' . $data[21];
                                    }

                                    if($largo == 8){
                                        $data[21] = '0' . $data[21];
                                    }
                                    
                                break;
                            }

                            $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?)";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute(array(0,$cedeid,$personaid,0,$data[21],$tipotelefono,$tipocliente,0,
                                                        'A',$userid,$host));                      
                        }
                    }

                    if($data[22] != ''){

                        $primervalor = substr($data[22], 0, 1);
                        $segvalor = substr($data[22], 0, 2);
                        $largo = strlen($data[21]);
        
                        if(strlen($data[22]) > 8 || strlen($data[22]) < 11){
                        
                            switch($segvalor){
                                case "09":
                                    $tipotelefono = 'CEL';
                                break; 
                                case "02":
                                case "03":
                                case "04":
                                case "05":
                                case "06":
                                case "07":
                                case "08":
                                    $tipotelefono = 'CON';
                                break;   
        
                            }
                        }
        
                        if(strlen($data[22]) > 6 || strlen($data[22]) < 11){
        
                            switch($primervalor){
                                case "9":
                                    $tipotelefono = 'CEL';
                                    if($largo == 9){
                                        $data[22] = '0' . $data[22];
        
                                    }
                                    break;
                                    
                                case "2":
                                case "3":
                                case "4":
                                case "5":
                                case "6":
                                case "7":
                                case "8":
                                    $tipotelefono = 'CON';
        
                                    if($largo == 7){
                                        $data[22] = '02' . $data[22];
                                    }
        
                                    if($largo == 8){
                                        $data[22] = '0' . $data[22];
                                    }
                                    
                                break;
                            }
        
                        }    
        
                            $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute(array(0,$cedeid,$personaid,0,$data[22],$tipotelefono,$tipocliente,0,
                                                        'A',$userid,$host));
                    }
                    
                    if($data[23] != ''){

                        $primervalor = substr($data[23], 0, 1);
                        $segvalor = substr($data[23], 0, 2);
                        $largo = strlen($data[23]);
        
                        if(strlen($data[23]) > 8 || strlen($data[23]) < 11){
                        
                            switch($segvalor){
                                case "09":
                                    $tipotelefono = 'CEL';
                                break; 
                                case "02":
                                case "03":
                                case "04":
                                case "05":
                                case "06":
                                case "07":
                                case "08":
                                    $tipotelefono = 'CON';
                                break;   
        
                            }
                        }
        
                        if(strlen($data[23]) > 6 || strlen($data[23]) < 11){
        
                            switch($primervalor){
                                case "9":
                                    $tipotelefono = 'CEL';
                                    if($largo == 9){
                                        $data[23] = '0' . $data[23];
        
                                    }
                                    break;
                                    
                                case "2":
                                case "3":
                                case "4":
                                case "5":
                                case "6":
                                case "7":
                                case "8":
                                    $tipotelefono = 'CON';
        
                                    if($largo == 7){
                                        $data[23] = '02' . $data[23];
                                    }
        
                                    if($largo == 8){
                                        $data[23] = '0' . $data[23];
                                    }
                                    
                                break;
                            }
        
                        }    
        
                            $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute(array(0,$cedenteid,$personaid,0,$data[23],$tipotelefono,$tipocliente,0,
                                                        $newestado,$currentdate,$userid,$host));
                    }
                    
                    if($data[24] != ''){

                        $primervalor = substr($data[24], 0, 1);
                        $segvalor = substr($data[24], 0, 2);
                        $largo = strlen($data[24]);
        
                        if(strlen($data[24]) > 8 || strlen($data[24]) < 11){
                        
                            switch($segvalor){
                                case "09":
                                    $tipotelefono = 'CEL';
                                break; 
                                case "02":
                                case "03":
                                case "04":
                                case "05":
                                case "06":
                                case "07":
                                case "08":
                                    $tipotelefono = 'CON';
                                break;   
        
                            }
                        }
        
                        if(strlen($data[24]) > 6 || strlen($data[24]) < 11){
        
                            switch($primervalor){
                                case "9":
                                    $tipotelefono = 'CEL';
                                    if($largo == 9){
                                        $data[24] = '0' . $data[24];
        
                                    }
                                    break;
                                    
                                case "2":
                                case "3":
                                case "4":
                                case "5":
                                case "6":
                                case "7":
                                case "8":
                                    $tipotelefono = 'CON';
        
                                    if($largo == 7){
                                        $data[24] = '02' . $data[24];
                                    }
        
                                    if($largo == 8){
                                        $data[24] = '0' . $data[24];
                                    }
                                    
                                break;
                            }
        
                        }  
                    
        
                        $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
                        $resultado = $conexion->prepare($consulta);
                        $resultado->execute(array(0,$cedenteid,$personaid,0,$data[24],$tipotelefono,$tipocliente,0,
                                                    $newestado,$currentdate,$userid,$host));
                    }
                    
                    if($data[25] != ''){

                        $primervalor = substr($data[25],0,1);
                        $segvalor = substr($data[25], 0, 2);
                        $largo = strlen($data[25]);
        
                        if(strlen($data[25]) > 8 || strlen($data[25]) < 11){
                        
                            switch($segvalor){
                                case "09":
                                    $tipotelefono = 'CEL';
                                break; 
                                case "02":
                                case "03":
                                case "04":
                                case "05":
                                case "06":
                                case "07":
                                case "08":
                                    $tipotelefono = 'CON';
                                break;   
        
                            }
                        }
        
                        if(strlen($data[25]) > 6 || strlen($data[25]) < 11){
        
                            switch($primervalor){
                                case "9":
                                    $tipotelefono = 'CEL';
                                    if($largo == 9){
                                        $data[25] = '0' . $data[25];
        
                                    }
                                    break;
                                    
                                case "2":
                                case "3":
                                case "4":
                                case "5":
                                case "6":
                                case "7":
                                case "8":
                                    $tipotelefono = 'CON';
        
                                    if($largo == 7){
                                        $data[25] = '02' . $data[25];
                                    }
        
                                    if($largo == 8){
                                        $data[25] = '0' . $data[25];
                                    }
                                    
                                break;
                            }
        
                        }  

                        $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
                        $resultado = $conexion->prepare($consulta);
                        $resultado->execute(array(0,$cedenteid,$personaid,0,$data[25],$tipotelefono,$tipocliente,0,
                                                    $newestado,$currentdate,$userid,$host));
                    }
                    
                    if($data[26] != ''){

                        $primervalor = substr($data[26],0,1);
                        $segvalor = substr($data[26], 0, 2);
                        $largo = strlen($data[26]);
        
                        if(strlen($data[26]) > 8 || strlen($data[26]) < 11){
                        
                            switch($segvalor){
                                case "09":
                                    $tipotelefono = 'CEL';
                                break; 
                                case "02":
                                case "03":
                                case "04":
                                case "05":
                                case "06":
                                case "07":
                                case "08":
                                    $tipotelefono = 'CON';
                                break;   
        
                            }
                        }
        
                        if(strlen($data[26]) > 6 || strlen($data[26]) < 11){
        
                            switch($primervalor){
                                case "9":
                                    $tipotelefono = 'CEL';
                                    if($largo == 9){
                                        $data[26] = '0' . $data[26];
        
                                    }
                                    break;                                    
                                case "2":
                                case "3":
                                case "4":
                                case "5":
                                case "6":
                                case "7":
                                case "8":
                                    $tipotelefono = 'CON';
        
                                    if($largo == 7){
                                        $data[26] = '02' . $data[26];
                                    }
        
                                    if($largo == 8){
                                        $data[26] = '0' . $data[26];
                                    }
                                    
                                break;
                            }
        
                        }  
                            
                        $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
                        $resultado = $conexion->prepare($consulta);
                        $resultado->execute(array(0,$cedenteid,$personaid,0,$data[26],$tipotelefono,$tipocliente,0,
                                                    $newestado,$currentdate,$userid,$host));
                    }
                    
                    if($data[27] != ''){

                        $primervalor = substr($data[27],0,1);
                        $segvalor = substr($data[27], 0, 2);
                        $largo = strlen($data[27]);
        
                        
                        if(strlen($data[27]) > 8 || strlen($data[27]) < 11){
                        
                            switch($segvalor){
                                case "09":
                                    $tipotelefono = 'CEL';
                                break; 
                                case "02":
                                case "03":
                                case "04":
                                case "05":
                                case "06":
                                case "07":
                                case "08":
                                    $tipotelefono = 'CON';
                                break;   
        
                            }
                        }
        
                        if(strlen($data[27]) > 6 || strlen($data[27]) < 11){
        
                            switch($primervalor){
                                case "9":
                                    $tipotelefono = 'CEL';
                                    if($largo == 9){
                                        $data[27] = '0' . $data[27];
        
                                    }
                                    break;
                                    
                                case "2":
                                case "3":
                                case "4":
                                case "5":
                                case "6":
                                case "7":
                                case "8":
                                    $tipotelefono = 'CON';
        
                                    if($largo == 7){
                                        $data[27] = '02' . $data[27];
                                    }
        
                                    if($largo == 8){
                                        $data[27] = '0' . $data[27];
                                    }
                                    
                                break;
                            }
        
                        }  

                        $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
                        $resultado = $conexion->prepare($consulta);
                        $resultado->execute(array(0,$cedenteid,$personaid,0,$data[27],$tipotelefono,$tipocliente,0,
                                                    $newestado,$currentdate,$userid,$host));
                    }
                    
                    if($data[28] != ''){

                        $primervalor = substr($data[28],0,1);
                        $segvalor = substr($data[28], 0, 2);
                        $largo = strlen($data[28]);
        
                        if(strlen($data[28]) > 8 || strlen($data[28]) < 11){
                        
                            switch($segvalor){
                                case "09":
                                    $tipotelefono = 'CEL';
                                break; 
                                case "02":
                                case "03":
                                case "04":
                                case "05":
                                case "06":
                                case "07":
                                case "08":
                                    $tipotelefono = 'CON';
                                break;   
        
                            }
                        }
        
                        if(strlen($data[28]) > 6 || strlen($data[28]) < 11){
        
                            switch($primervalor){
                                case "9":
                                    $tipotelefono = 'CEL';
                                    if($largo == 9){
                                        $data[28] = '0' . $data[28];
        
                                    }
                                    break;
                                    
                                case "2":
                                case "3":
                                case "4":
                                case "5":
                                case "6":
                                case "7":
                                case "8":
                                    $tipotelefono = 'CON';
        
                                    if($largo == 7){
                                        $data[28] = '02' . $data[28];
                                    }
        
                                    if($largo == 8){
                                        $data[28] = '0' . $data[28];
                                    }
                                    
                                break;
                            }
        
                        }  
                    
        
                        $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
                        $resultado = $conexion->prepare($consulta);
                        $resultado->execute(array(0,$cedenteid,$personaid,0,$data[28],$tipotelefono,$tipocliente,0,
                                                    $newestado,$currentdate,$userid,$host));
                    }
                    
                    if($data[29] != ''){

                        $primervalor = substr($data[29],0,1);
                        $segvalor = substr($data[29], 0, 2);
                        $largo = strlen($data[29]);
        
                        
                        if(strlen($data[29]) > 8 || strlen($data[29]) < 11){
                        
                            switch($segvalor){
                                case "09":
                                    $tipotelefono = 'CEL';
                                break; 
                                case "02":
                                case "03":
                                case "04":
                                case "05":
                                case "06":
                                case "07":
                                case "08":
                                    $tipotelefono = 'CON';
                                break;   
        
                            }
                        }
        
                        if(strlen($data[29]) > 6 || strlen($data[29]) < 11){
        
                            switch($primervalor){
                                case "9":
                                    $tipotelefono = 'CEL';
                                    if($largo == 9){
                                        $data[29] = '0' . $data[29];
        
                                    }
                                    break;
                                    
                                case "2":
                                case "3":
                                case "4":
                                case "5":
                                case "6":
                                case "7":
                                case "8":
                                    $tipotelefono = 'CON';
        
                                    if($largo == 7){
                                        $data[29] = '02' . $data[29];
                                    }
        
                                    if($largo == 8){
                                        $data[29] = '0' . $data[29];
                                    }
                                    
                                break;
                            }
        
                        }  
        
                        $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
                        $resultado = $conexion->prepare($consulta);
                        $resultado->execute(array(0,$cedenteid,$personaid,0,$data[29],$tipotelefono,$tipocliente,0,
                                                    $newestado,$currentdate,$userid,$host));
                    }
                    
                    if($data[30] != ''){

                        $primervalor = substr($data[30],0,1);
                        $segvalor = substr($data[30], 0, 2);
                        $largo = strlen($data[30]);
        
                        if(strlen($data[30]) > 8 || strlen($data[30]) < 11){
                        
                            switch($segvalor){
                                case "09":
                                    $tipotelefono = 'CEL';
                                break; 
                                case "02":
                                case "03":
                                case "04":
                                case "05":
                                case "06":
                                case "07":
                                case "08":
                                    $tipotelefono = 'CON';
                                break;   
        
                            }
                        }
        
                        if(strlen($data[30]) > 6 || strlen($data[30]) < 11){
        
                            switch($primervalor){
                                case "9":
                                    $tipotelefono = 'CEL';
                                    if($largo == 9){
                                        $data[30] = '0' . $data[30];
        
                                    }
                                    break;
                                    
                                case "2":
                                case "3":
                                case "4":
                                case "5":
                                case "6":
                                case "7":
                                case "8":
                                    $tipotelefono = 'CON';
        
                                    if($largo == 7){
                                        $data[30] = '02' . $data[30];
                                    }
        
                                    if($largo == 8){
                                        $data[30] = '0' . $data[30];
                                    }
                                    
                                break;
                            }
        
                        }  
                    
                        $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
                        $resultado = $conexion->prepare($consulta);
                        $resultado->execute(array(0,$cedenteid,$personaid,0,$data[30],$tipotelefono,$tipocliente,0,
                                                    $newestado,$currentdate,$userid,$host));
                    }
                    
                    //INSERTAR DIRECCION Y CORREO DEUDOR   
                    $direcciondom = safe($data[6]);
                    $referenciadom = safe($data[7]);
                    if($direcciondom != ''){
                        $tipodireccion = 'DIRECCION';
                        $definicion = 'DOM';
        
                        $consulta = "CALL sp_New_Direccion_Correos(?,?,?,?,?,?,?,?,?,?,?,?)";
                        $resultado = $conexion->prepare($consulta);
                        $resultado->execute(array(0,$cedula,'',$tipodireccion,$tipocliente,$definicion,
                                                $direcciondom,$referenciadom,'',$currentdate,$userid,$host));
                    
                    }
                                 
                    $direcciondom = safe($data[8]);
                    if($direcciontra != ''){
                        $tipodireccion = 'DIRECCION';
                        $definicion = 'TRA';
                        
                        $consulta = "CALL sp_New_Direccion_Correos(?,?,?,?,?,?,?,?,?,?,?,?)";
                        $resultado = $conexion->prepare($consulta);
                        $resultado->execute(array(0,$cedula,'',$tipodireccion,$tipocliente,$definicion,
                                                $direcciontra,$referenciatra,'',$currentdate,$userid,$host));
                    } 
                    
                    
                    if($email != ''){
                        $tipodireccion = 'CORREO';
                        $definicion = 'PER';
        
                        $consulta = "CALL sp_New_Direccion_Correos(?,?,?,?,?,?,?,?,?,?,?,?)";
                        $resultado = $conexion->prepare($consulta);
                        $resultado->execute(array(0,$cedula,'',$tipodireccion,$tipocliente,$definicion,
                                                '','',$email,$currentdate,$userid,$host));
                    
                    }  
                    
                    














                }

            }
            $MostarData = 111;
            fclose($handle);
        }
        
        






        //AL FINAL DE TODO RECARGAR LA PAGINA NUEVAMENTE
        header("Location: http://localhost:8080/softcobplus/herramientas/subircartera.php");
    }

?>
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <input type="hidden" id="subircartera" value="<?php echo $subiocartera ?>">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Subir Cartera</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <br />
                        <form method="post" class="form-horizontal col-md-12" enctype="multipart/form-data">
<?php    if($MostarData == 0) {  ?>
                            <br/>                            
                            <div class="form-group row">
                                <label for="ciudad" class="control-label col-md-1">Ciudad:</label>
                                <div class="col-md-4 col-sm-8">
                                    <select class="form-control" id="cboCiudad" name="cbociudad" style="width: 100%;">
                                        <option value="0">--Seleccione Cuidad--</option>
                                        <?php foreach ($dataciu as $fila) : ?>
                                            <option value="<?= $fila['Codigo'] ?>"><?= $fila['Descripcion'] ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <label for="espacio" class="control-label col-md-1"></label>
                                <label for="cedente" class="control-label col-md-1">Cedente:</label>
                                <div class="col-md-4 col-sm-8">
                                    <select class="form-control" id="cboCedente" name="cbocedente" style="width: 100%;">
                                        <option value="0">--Seleccione Cedente--</option>
                                    </select>
                                </div>
                            </div>
                            <br/>
                            <br/>
                            <div class="form-group row">
                                <label for="producto" class="control-label col-md-1">Producto:</label>
                                <div class="col-md-4 col-sm-8">
                                    <select class="form-control" id="cboProducto" name="cboproducto" style="width: 100%;">
                                        <option value="0">--Seleccione Producto--</option>
                                    </select>
                                </div>
                                <label for="espacio" class="control-label col-md-1"></label>
                                <label for="catalogo" class="control-label col-md-1">Catalogo:</label>
                                <div class="col-md-4 col-sm-8">
                                    <select class="form-control" id="cboCatalogo" name="cbocatalogo" style="width: 100%;">
                                        <option value="0">--Seleccione Catalogo--</option>
                                    </select>
                                </div>
                            </div>
                            <br />
                            <br />
                            <br />
                            <div class="form-group row">
                                <label for="espacio" class="control-label col-md-3"></label>
                                <div class="wrapper" id="container">
                                    <input type="file" accept=".csv" id="file_input" name="file_input" class="file" hidden>
                                    <i class="fa fa-cloud-upload"></i>
                                    <p>Browse File to Upload</p>
                                    <span>
                                        <strong>Archivo Seleccionado:</strong>
                                        <span id="file_name">Ninguno</span>
                                    </span>
                                </div>
                            </div>

                            <label for="espacio" class="control-label col-md-3"></label>
                            <div class="btn-group" role="group" aria-label="Basic example">                                
                                <input type='submit' class='btn btn-outline-info' name='Enviar' value='Enviar' id="btnEnviar"  />
                            </div>
                            <br />
                            <br />
                            <label for="espacio" class="control-label col-md-3"></label>
                            <div id="progressBar">
                                <div id="progressbar">
                                </div>
                            </div>
<?php   } elseif($MostarData == 1) { ?>
                        <div>
                            <h1>HOLA</h1>
                        </div>

                <?php    }  ?>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../dashmenu/panel_footer.php'; ?>
<script src="../codejs/herramientas.js" type="text/javascript"></script>

<script></script>
</body>

</html>