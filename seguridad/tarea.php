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
                                                
                      <button type="button" class="btn btn-outline-primary" id="btnNuevo" style="margin-bottom:10px"><i class="fa fa-plus"></i></button>
                    
                    <div class="x_content">
                        <br />
                        <table id="tabledata" class="table table-striped jambo_table bulk_action" style="width: 100%;">
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
                                                || $datos['TareaId'] == "100004"){
                                                $disabledel = 'disabled="disabled"';
                                            }else{
                                                $disabledel = '';
                                            }
                                        ?>
                                        <tr>
                                            <td><?php echo $datos['TareaId'] ?></td>
                                            <td><?php echo $datos['Tarea'] ?></td>
                                            <td><?php echo $datos['Ruta'] ?></td>
                                            <td><?php echo $datos['Icono'] ?></td>
                                            <td><?php echo $datos['Estado'] ?></td>
                                            <td>
                                                <div class="text-center">
                                                    <div class="btn-group">
                                                        <button class="btn btn-outline-info btn-sm ml-3" id="btnEditar">
                                                        <i class="fa fa-pencil-square-o"></i></button>
                                                        <button class="btn btn-outline-danger btn-sm ml-3" <?php echo $disabledel ?> id="btnEliminar">
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
        <div class="modal-content">
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
                        <input type="text" class="form-control" id="txtIcono" placeholder="ej: fas fa-user">
                    </div>                    
                    <div class="form-check" id="divcheck">
                        <input type="checkbox" class="form-check-input" id="chkEstado">
                        <label for="estadolabel" class="form-check-label" id="lblEstado">Activo</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                    <!-- <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button> -->
                    <button type="submit" class="btn btn-outline-success ml-3" id="btnSave"><i class='<i class="fa fa-save"></i>'></i> Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>     
     <?php require_once '../dashmenu/panel_footer.php'; ?>
     <script src="../codejs/tareas.js" type="text/javascript"></script>
   </body>
</html> 