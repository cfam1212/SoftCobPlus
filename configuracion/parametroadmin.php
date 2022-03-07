<?php

require_once '../dashmenu/panel_menu.php';

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
                        <table id="tabledata" class="table table-striped jambo_table bulk_action table-dark" style="width: 100%;">
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
                                                    <button class="btn btn-outline-danger btn-sm ml-3" id="btnEliminarEdit" data-toggle="tooltip" data-placement="top" title="eliminar">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
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
    <div class="modal-dialog" style="max-width: 65%" role="document">
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
                            <form class="form-horizontal" role="form">
                                <fieldset>
                                    <div class="row">
                                        <label for="espacio" class="control-label col-md-2"></label>
                                        <label for="parametro" class="control-label col-md-1">Parametro:</label>
                                        <div class="col-md-5 col-sm-5  form-group has-feedback">
                                            <input autofocus type="text" class="form-control has-feedback-left" id="txtParametro" maxlength="80" onKeyUp="this.value=this.value.toUpperCase();">
                                            <span class="fa fa-bookmark form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="espacio" class="control-label col-md-2"></label>
                                        <label for="descripcion" class="control-label col-md-1">Descripcion:</label>
                                        <div class="col-md-9 col-sm-9  form-group has-feedback">
                                            <textarea name="observa" id="txtDescripcion" class="form-control col-md-8" onKeyUp="this.value=this.value.toUpperCase();" maxlength="255" onkeydown="return (event.keyCode!=13);"></textarea>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <br />
                            <div class="row">
                                <label for="espacio" class="control-label col-md-1"></label>
                                <button type="button" class="btn btn-outline-info" id="btnAdd" data-toggle="tooltip" data-placement="top" title="agregar detalle" style="margin-bottom:10px"><i class="fa fa-plus"></i></button>
                            </div>
                            <br>
                            <br>
                            <div class="col-md-12 col-sm-12">
                                <div class="col-md-1 col-sm-1">
                                </div>
                                <div class="col-md-10 col-sm-10">
                                    <form method="post" id="user_form">
                                        <div class="table-responsive">
                                            <table id="tblparameter" class="table table-striped jambo_table table-condensed table-dark table-borderless" style="width: 100%;">
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
                <button type="button" class="btn btn-outline-info ml-3" id="btnSave"><i class='fa fa-save'></i> Guardar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalPARAMETER" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 35%" role="document">
        <div class="modal-content" id="myModalBg">
            <div class="modal-header" id="header">
                <h5 class="modal-title" id="modalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formParam">
                <div class="modal-body">
                    <br />
                    <!-- <div class="form-group">
                        <label for="detalle" class="col-form-label">Detalle</label>
                        <input type="text" id="txtDetalle" required class="form-control" maxlength="80">
                    </div> -->
                    <label for="tarea" class="col-form-label">Detalle:</label>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 form-group has-feedback">
                            <input type="text" class="form-control has-feedback-left" id="txtDetalle" placeholder="" maxlength="80">
                            <span class="fa fa-list-ul form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label for="valorv" class="col-form-label">Valor Text</label>
                        <input type="text" id="txtValorv" class="form-control" maxlength="255">
                    </div> -->
                    <label for="tarea" class="col-form-label">Valor Texto:</label>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 form-group has-feedback">
                            <input type="text" class="form-control has-feedback-left" id="txtValorv" maxlength="255">
                            <span class="fa fa-list-ul form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label for="valori" class="col-form-label">Valor Entero</label>
                        <input type="text" id="txtValori" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" class="form-control" maxlength="5">
                    </div> -->
                    <label for="tarea" class="col-form-label">Valor Entero:</label>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 form-group has-feedback">
                            <input type="text" id="txtValori" class="form-control has-feedback-left" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" maxlength="5">
                            <span class="fa fa-slack form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <!-- <div class="form-check" id="divcheck">
                        <input type="checkbox" id="chkEstado" class="form-check-input">
                        <label for="estadolabel" class="form-check-label" id="lblEstado">Activo</label>
                    </div> -->
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="row_id" id="hidden_row_id" />
                    <button type="button" id="btnAgregar" class="btn btn-outline-info ml-3"><i class='fa fa-plus'></i>
                        Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once '../dashmenu/panel_footer.php'; ?>
<script src="../codejs/parametros.js" type="text/javascript"></script>
</body>

</html>