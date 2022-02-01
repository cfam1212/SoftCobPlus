<?php

require_once '../dashmenu/panel_menu.php'; 

$consulta = "CALL sp_consulta_datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(0,$_SESSION["i_emprid"],'','','','','','',0,0,0,0,0,0));
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="right_col" role="main"> 
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Registro de tareas</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                                                
                      <button type="button" class="btn btn-outline-info" data-toggle="tooltip" data-placement="top" title="nueva tarea" id="btnNuevo" style="margin-bottom:10px"><i class="fa fa-plus"></i></button>
                      
                    <div class="x_content">
                        <br />
                        <table id="tabledata" class="table table-striped jambo_table table-borderless" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Tarea</th>
                                        <th>Acción</th>
                                        <th>Icono</th>
                                        <th>Estado</th>
                                        <th style="text-align: center;">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach($data as $datos){
                                    ?>  
                                        <?php
                                            if($datos['TareaId']=='100001' || $datos['TareaId'] == "100002" || $datos['TareaId'] == "100003" 
                                                || $datos['TareaId'] == "100004" && $datos['Estado'] == "Inactivo"){
                                                $disabledel = 'disabled';
                                                $disabledit = 'disabled';
                                                $chkestado = 'disabled';
                                            }else{
                                                $disabledel = '';
                                                $disabledit = '';
                                                $chkestado = '';
                                            }
                                        ?>
                                        <tr>
                                            <td><?php echo $datos['TareaId'] ?></td>
                                            <td><?php echo $datos['Tarea'] ?></td>
                                            <td><?php echo $datos['Ruta'] ?></td>
                                            <td><?php echo $datos['Icono'] ?></td>
                                            <td style="text-align: center">
                                            <input type="checkbox" class="form-check-input chkEstadoTa" <?php echo $chkestado; ?> id="chk<?php echo $datos['TareaId']; ?>" name="check[]" <?php if ($datos['Estado'] == 'Activo') {
                                             echo "checked";} else {'';} ?> value="<?php echo $datos['TareaId']; ?>" />                                            
                                            </td>    
                                            <td>
                                                <div class="text-center">
                                                    <div class="btn-group">
                                                        <button class="btn btn-outline-info btn-sm ml-3 btnEditar" <?php echo $disabledit ?> id="btnEditar<?php echo $datos['TareaId']; ?>" data-toggle="tooltip" data-placement="top" title="editar" >
                                                        <i class="fa fa-pencil-square-o"></i></button>
                                                        <button class="btn btn-outline-danger btn-sm ml-3" <?php echo $disabledel ?> id="btnEliminar" data-toggle="tooltip" data-placement="top" title="eliminar">
                                                        <i class="fa fa-trash-o"></i>
                                                        </button>
                                                    </div>
                                                </div> 
                                            </td>
                                        </tr>
                                    <?php }
                                    ?>                          
                                </tbody>  
                            </table>                        
                    </div>
                </div>
            </div>
        </div>
    </div>   
</div>
<div class="modal fade" id="modalTAREA" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="myModalBg">
            <div class="modal-header" id="header">
                <h5 class="modal-title" id="modalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formTarea">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tarea" class="col-form-label">Tarea:</label>
                        <input type="text" required class="form-control" id="txtTarea">
                    </div>
                    <div class="form-group">
                        <label for="ruta" class="col-form-label">Ruta:</label>
                        <input type="text" required class="form-control" id="txtRuta" placeholder="ej: ../seguridad/usuario.php">
                    </div>
                    <div class="form-group">
                        <label for="icono" class="col-form-label">Icono:</label>
                        <input type="text" class="form-control" id="txtIcono" placeholder="ej: fa fa-user">
                    </div>                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-info ml-3" id="btnSave"><i class="fa fa-save"></i> Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>     
     <?php require_once '../dashmenu/panel_footer.php'; ?>
     <script src="../codejs/tareas.js" type="text/javascript"></script>
   </body>
</html> 