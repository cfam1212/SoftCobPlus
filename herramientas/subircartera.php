<?php

    require_once '../dashmenu/panel_menu.php';

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
    $subiocartera = (isset($_POST['subiocartera'])) ? $_POST['subiocartera'] : '';

    if (isset($_POST['Enviar'])) {

        if (is_uploaded_file($_FILES['file_input']['tmp_name'])) {
            //echo "<h1>" . "File ". $_FILES['file_input']['name'] ." subido." . "</h1>";
            //echo "<h2>Datos subidos:</h2>";
            //readfile($_FILES['file_input']['tmp_name']);
        }
    
        //Import uploaded file to Database
        $handle = fopen($_FILES['file_input']['tmp_name'], "r");
    
        while (($data = fgetcsv($handle, 2000, ";")) !== FALSE) {
            if($data[0] == 'Cedula' )
            {
                
            }else{        

                $consulta = "CALL sp_Subir_Cartera_Persona(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute(array(0,'C',$data[0],$data[1],$data[2],'',$data[3],'M',$data[4],
                $data[5],'S','A',$userid,$host));
                
                $personaid = $resultado->fetchColumn(); 
            }
        }
        $subiocartera = 'SI';
        fclose($handle);    
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
                                    <input type="file" accept=".txt" id="file_input" name="file_input" class="file" hidden>
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