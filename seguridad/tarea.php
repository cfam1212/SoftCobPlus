<?php

require_once '../dashmenu/panel_menu.php';

@session_start();
    
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

$consulta = "CALL sp_consulta_datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(0, $_SESSION["i_emprid"], '', '', '', '', '', '', 0, 0, 0, 0, 0, 0));
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Registro de Tareas</h2>
                        <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up float-right"></i></a>
                                </li>  
                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <button type="button" class="btn btn-outline-info" data-toggle="tooltip" data-placement="top" title="nueva tarea" id="btnNuevo" style="margin-bottom:10px"><i class="fa fa-plus"></i></button>

                    <div class="x_content">
                        <br />
                        <table id="tabledata" class="table table-striped jambo_table bulk_action table-borderless" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Tarea</th>
                                    <th>Acción</th>
                                    <th>Icono</th>
                                    <th style="width:13% ; text-align: center">Opciones</th>
                                    <th style="width:10% ; text-align: center">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data as $datos) {
                                ?>
                                    <?php
                                    $disabledel = '';
                                    $disabledit = '';
                                    $chkestado = '';

                                    if (
                                        $datos['TareaId'] == '100001' || $datos['TareaId'] == "100002" || $datos['TareaId'] == "100003"
                                        || $datos['TareaId'] == "100004"
                                    ) {
                                        $disabledel = 'disabled';
                                        $disabledit = 'disabled';
                                        $chkestado = 'disabled';
                                    }

                                    if (
                                        $datos['TareaId'] != '100001' || $datos['TareaId'] != "100002" || $datos['TareaId'] != "100003"
                                        || $datos['TareaId'] != "100004"
                                    ) {
                                        if ($datos['Estado'] == 'Inactivo') {
                                            $disabledit = 'disabled';
                                        }
                                    }

                                    ?>
                                    <tr>
                                        <td><?php echo $datos['TareaId'] ?></td>
                                        <td><?php echo $datos['Tarea'] ?></td>
                                        <td><?php echo $datos['Ruta'] ?></td>
                                        <td><?php echo $datos['Icono'] ?></td>
                                        <td>
                                            <div class="text-center">
                                                <div class="btn-group">
                                                    <button class="btn btn-outline-info btn-sm ml-3 btnEditar" <?php echo $disabledit ?> id="btnEditar" data-toggle="tooltip" data-placement="top" title="editar">
                                                        <i class="fa fa-pencil-square-o"></i></button>
                                                    <button class="btn btn-outline-danger btn-sm ml-2" <?php echo $disabledel ?> id="btnEliminar">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="text-align: center">
                                            <input type="checkbox" class="form-check-input chkEstadoTa" <?php echo $chkestado; ?> id="chk<?php echo $datos['TareaId']; ?>" name="check[]" <?php if ($datos['Estado'] == 'Activo') {
                                               echo "checked";} else { ''; } ?> value="<?php echo $datos['TareaId']; ?>" />                                                                                                                                                                                                                                                                                                                                                                                                                                                       
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
                    <br/>
                   
                    <div class="row">
                        <label for="tarea" class="control-label col-md-2">Tarea:</label>
                        <div class="col-md-12 col-sm-12 form-group has-feedback">
                            <input type="text" class="form-control has-feedback-left" id="txtTarea" placeholder="nombre de la tarea" maxlength="80">
                            <span class="fa fa-list-ul form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <label for="ruta" class="control-label col-md-2">Ruta:</label>
                        <div class="col-md-12 col-sm-12 form-group has-feedback">
                            <input type="text" class="form-control has-feedback-left" id="txtRuta" placeholder="ej: ../seguridad/usuario.php" maxlength="">
                            <span class="fa fa-sign-out form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <label for="tarea" class="control-label col-md-2">Icono:</label>
                        <div class="col-md-12 col-sm-12 form-group has-feedback">
                            <input type="text" class="form-control has-feedback-left" id="txtIcono" placeholder="ej: fa fa-user" maxlength="">
                            <span class="fa fa-smile-o form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-primary" id="btnSave"><i class="fa fa-plus-circle"></i> Agregar</button>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require_once '../dashmenu/panel_footer.php'; ?>
<script src="../codejs/tareas.js" type="text/javascript"></script>
</body>

</html>