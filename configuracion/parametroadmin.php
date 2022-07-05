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

$mensaje = (isset($_POST['mensaje'])) ? $_POST['mensaje'] : '';

$consulta = "CALL sp_consulta_datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(31, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 0));
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="right_col" role="main">
    <input type="hidden" id="mensaje" value="<?php echo $mensaje ?>">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Registro de Parámetros</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <button type="button" class="btn btn-outline-info" id="btnNuevo" data-toggle="tooltip" data-placement="top" title="nuevo parametro" style="margin-bottom:10px"><i class="fa fa-plus"></i></button>
                    <div class="x_content">
                        <br />
                        <table id="tabledata" class="table table-striped jambo_table bulk_action" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Parámetro</th>
                                    <th>Descipción</th>
                                    <th style="text-align: center;">Opciones</th>
                                    <th style="text-align: center;">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data as $datos) {
                                ?>
                                    <?php
                                    $disabledit = '';
                                    if ($datos['Estado'] == 'Inactivo') {
                                        $disabledit = 'disabled';
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $datos['ParaId'] ?></td>
                                        <td><?php echo $datos['Parametro'] ?></td>
                                        <td><?php echo $datos['Descripcion'] ?></td>
                                        <td>
                                            <div class="text-center">
                                                <div class="btn-group">
                                                    <button class="btn btn-outline-info btn-sm ml-3 btnEditar" <?php echo $disabledit ?> id="btnEditar<?php echo $datos['ParaId']; ?>" data-toggle="tooltip" data-placement="top" title="editar">
                                                        <i class="fa fa-pencil-square-o"></i></button>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="text-align: center">
                                            <input type="checkbox" class="form-check-input chkEstadoPa" id="chk<?php echo $datos['ParaId']; ?>" name="check[]" <?php if ($datos['Estado'] == 'Activo') {
                                                                                                                                                                    echo "checked";
                                                                                                                                                                } ?> value="<?php echo $datos['ParaId']; ?>" />
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
<div class="modal fade" id="modalNewParametro" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="myModalBg">
            <div class="modal-header" id="header">
                <h5 class="modal-title" id="modalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>    
            </div>
            <div class="modal-body">
                <div class="x_content">
                    <br />
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Parametro</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Detalle</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <form class="form-horizontal col-md-10 offset-md-2" role="form">
                                <fieldset>
                                    <div class="row">
                                        <label for="parametro" class="control-label col-md-1">Parametro:</label>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-10 col-sm-6  form-group has-feedback">
                                            <input autofocus type="text" class="form-control has-feedback-left" id="txtParametro" placeholder="nombre del parametro" maxlength="80">
                                            <span class="fa fa-bookmark form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                    <br />
                                    <div class="row">
                                        <label for="parametro" class="control-label col-md-1">Descripcion:</label>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-10 col-sm-6 form-group has-feedback">
                                            <textarea name="observa" id="txtDescripcion" class="form-control" placeholder="ingrese una descripcion" maxlength="255" onkeydown="return (event.keyCode!=13);"></textarea>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <br />
                            <div class="col-md-12 col-sm-12">
                                <div class="col-md-1 col-sm-1">
                                </div>
                                <div class="col-md-10 col-sm-10">
                                    <button type="button" class="btn btn-outline-info float-right" id="btnAdd" data-toggle="tooltip" data-placement="top" title="agregar detalle" style="margin-bottom:10px"><i class="fa fa-plus"></i></button>
                                    <form method="post" id="user_form">
                                        <div class="table-responsive">
                                            <table id="tblparameter" class="table table-striped jambo_table table-condensed bulk_action table-borderless" style="width: 100%;">
                                                <thead class="text-center">
                                                    <tr>
                                                        <th style="display: none;">NOrden</th>
                                                        <th>Detalle</th>
                                                        <th>Valor Texto</th>
                                                        <th>Valor Entero</th>
                                                        <th>Opciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-1 col-sm-1">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-info" id="btnSave"><i class='fa fa-save'></i> Guardar</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalDETALLE" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 35%" role="document">
        <div class="modal-content" id="myModalBg">
            <div class="modal-header" id="headerDet">
                <h5 class="modal-titleDet" id="modalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>    
            </div>
            <form id="formParam">
                <div class="modal-body">
                    <div class="row">
                       <label for="detalle" class="control-label col-md-2">Detalle:</label>
                        <div class="col-md-12 col-sm-12 form-group has-feedback">
                            <input type="text" class="form-control has-feedback-left" id="txtDetalle" placeholder="nombre del detalle" maxlength="80">
                            <span class="fa fa-list-ul form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <label for="valor" class="control-label col-md-3">Valor Texto:</label>
                        <div class="col-md-12 col-sm-12 form-group has-feedback">
                            <input type="text" class="form-control has-feedback-left" id="txtValorv" placeholder="valor texto" maxlength="255">
                            <span class="fa fa-list-ul form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <label for="valor" class="control-label col-md-3">Valor Entero:</label>
                        <div class="col-md-12 col-sm-12 form-group has-feedback">
                            <input type="text" id="txtValori" class="form-control has-feedback-left" placeholder="valor entero" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" maxlength="5">
                            <span class="fa fa-slack form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="row_id" id="hidden_row_id" />
                    <button type="button" id="btnAgregar" class="btn btn-outline-primary"><i class='fa fa-plus'></i>Agregar</button>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once '../dashmenu/panel_footer.php'; ?>
<script src="../codejs/parametros.js" type="text/javascript"></script>
</body>

</html>