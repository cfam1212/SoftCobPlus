<?php 

require_once '../dashmenu/panel_menu.php'; 

$idperfil = (isset($_POST['idperfil'])) ? $_POST['idperfil'] : '0';

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(16,$_SESSION["i_emprid"],'','','','','','',$idperfil,0,0,0,0,0));
$datos = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(13,$_SESSION["i_emprid"],'','','','','','',$idperfil,0,0,0,0,0));
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

?>
<input type="hidden" id="mensaje">
<div class="right_col" role="main"> 
    <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Editar Perfil</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>                   
                    <div class="x_content"> 
                        <form class="form-horizontal" role="form">      
                            <fieldset>
                              <div class="form-group row">
                                    <label for="perfilname" class="control-label col-md-2">Perfi:</label>
                                    <input type="text" required class="form-control col-md-4" id="txtPerfil" name="perfilname" maxlength="80" placeholder="Nombre del Perfil" value="<?php echo $datos[0]['Perfil'] ?>">                    
                                    <label for="descrip" class="control-label col-md-2">Descripción:</label>
                                    <textarea name="descrip" id="txtDescripcion" class="form-control col-md-4" maxlength="255" onkeydown = "return (event.keyCode!=13);"><?php echo $datos[0]['Observacion'] ?></textarea>                          
                                </div>
                                <div class="form-group row">
                                    <label for="chkcrear" class="control-label col-md-2">Crear Parámetro:</label>
                                    <div class="checkbox col-md-4">
                                        <input type="checkbox" id="chkCrear"></input>
                                        <label class="form-check-label" id="lblCrear"><?php echo $datos[0]['Crear'] ?></label>
                                    </div>   
                                    <label for="chkmodificar" class="control-label col-md-2">Modificar Parámetro:</label> 
                                    <div class="checkbox col-md-4">
                                        <input type="checkbox" id="chkModificar"></input>
                                        <label class="form-check-label" id="lblModificar"><?php echo $datos[0]['Modificar'] ?></label>
                                    </div>                
                                </div>
                                <div class="form-group row">
                                    <label for="chkeliminar" class="control-label col-md-2">Eliminar Parámetro:</label>
                                    <div class="checkbox col-md-4">
                                        <input type="checkbox" id="chkEliminar"></input>
                                        <label class="form-check-label" id="lblEliminar"><?php echo $datos[0]['Eliminar'] ?></label>
                                    </div>
                                    <label for="chkestado" class="control-label col-md-2">Estado:</label>
                                    <div class="checkbox col-md-4">
                                        <input type="checkbox" id="chkEstado" checked></input>
                                        <label class="form-check-label" id="lblEstado"><?php echo $datos[0]['Estado'] ?></label>
                                    </div>
                                    <div class="form-group col-md-2" style="display:none">
                                        <input id="idPerfil" name="perfid" type="text" class="form-control" value="<?php echo $idperfil ?>">
                                    </div>                                       
                                </div>
                            </fieldset>
                        </form>    
                    </div>                 
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Opciones Menu</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>      
                        <div class="x_content">                    
                            <table id="tabledata" class="table table-striped jambo_table bulk_action table-info" style="width: 100%;">
                               <thead class="text-center">
                                    <tr>
                                        <th>Id</th>
                                        <th>Seleccionar</th>
                                        <th>Menú</th>
                                        <th>Tarea</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>                        
                                <tbody>
                                    <?php
                                    foreach($data as $dat){
                                    ?>
                                    <tr>
                                        <td><?php echo $dat['MentId']; ?></td>
                                        <td style="text-align: center">
                                            <input type="checkbox" id="recs" name="check[]" <?php if ($dat['Ckeck'] == 'SI') {echo "checked='checked'"; } ?> value="<?php echo $dat['MentId'];?>"/>
                                        </td>                              
                                        <td><?php echo $dat['Menu']; ?></td>
                                        <td><?php echo $dat['Tarea']; ?></td>
                                        <td><?php echo $dat['Estado']; ?></td>
                                    </tr>
                                    <?php } ?>         
                                </tbody>
                            </table>  
                        </div>                          
                    </div>
                </div>
            </div>
        </div>  

        <div class="container">
            <div class='btn-group'>
                <button class="btn btn-outline-primary" id = "btnRegresar" ><i class='fa fa-undo'></i> Regresar</button>
                <button class="btn btn-outline-success ml-3" id="btnSave"><i class='fa fa-save'></i> Guardar</button>
            </div>
        </div>
    </div>
</div>


<?php require_once '../dashmenu/panel_footer.php'; ?>
<script src="../codejs/perfiledit.js" type="text/javascript"></script>

</body>

</html>