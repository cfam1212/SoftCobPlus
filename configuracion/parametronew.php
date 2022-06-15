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
$resultado->execute(array(0, $_SESSION["i_emprid"], '', '', '', '', '', '', 0, 0, 0, 0, 0, 0));
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="right_col" role="main">
    <input type="hidden" id="mensaje" value="<?php echo $mensaje ?>">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>NUEVO PARAMETRO</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>

                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="parametro-tab" data-toggle="tab" href="#parametro" role="tab" aria-controls="parametro" aria-selected="true">Datos Parámetro</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="detalle-tab" data-toggle="tab" href="#detalle" role="tab" aria-controls="detalle" aria-selected="false">Detalles</a>
                            </li>

                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="parametro" role="tabpanel" aria-labelledby="parametro-tab">
                                <br>
                                <form class="form-horizontal" role="form">
                                    <fieldset>
                                        <div class="row">
                                            <label for="espacio" class="control-label col-md-1"></label>
                                            <label for="menuname" class="control-label col-md-1">Parámetro:</label>
                                            <div class="form-group col-md-3">
                                                <input type="text" required class="form-control" id="txtParametro" name="parametro" placeholder="" maxlength="80" onKeyUp="this.value=this.value.toUpperCase();">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="espacio" class="control-label col-md-1"></label>
                                            <label for="menuname" class="control-label col-md-1">Descripción</label>
                                            <div class="form-group col-md-10">
                                                <textarea name="observa" id="txtDescripcion" class="form-control col-md-8" onKeyUp="this.value=this.value.toUpperCase();" maxlength="255" onkeydown="return (event.keyCode!=13);"></textarea>
                                            </div>
                                        </div>

                                    </fieldset>
                                </form>
                                <br>
                                <br>
                                <div class='btn-group'>
                                    <button class="btn btn-outline-secondary" id="btnRegresar"><i class='fa fa-undo'></i>
                                        Regresar</button>
                                    <button class="btn btn-outline-info ml-3 float-end" id="btnSave"><i class='fa fa-save'></i> Guardar</button>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="detalle" role="tabpanel" aria-labelledby="detalle-tab">
                                <br/>
                                <div class="row">
                                    <label for="espacio" class="control-label col-md-11"></label>
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
                                                <table id="tblparameter" class="table table-striped jambo_table table-condensed bulk_action table-borderless" style="width: 100%;">
                                                    <thead class="text-center">
                                                        <tr>
                                                            <th style="display: none;">NOrden</th>
                                                            <th>Detalle</th>
                                                            <th>Valor Texto</th>
                                                            <th>Valor Entero</th>
                                                            <th>Estado</th>
                                                            <th>Acciones</th>
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
                    <div class="form-group">
                        <label for="detalle" class="col-form-label">Detalle</label>
                        <input type="text" id="txtDetalle" required class="form-control" maxlength="80">
                    </div>
                    <div class="form-group">
                        <label for="valorv" class="col-form-label">Valor Text</label>
                        <input type="text" id="txtValorv" class="form-control" maxlength="255">
                    </div>
                    <div class="form-group">
                        <label for="valori" class="col-form-label">Valor Entero</label>
                        <input type="text" id="txtValori" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" class="form-control" maxlength="5">
                    </div>
                    <div class="form-check" id="divcheck">
                        <input type="checkbox" id="chkEstado" class="form-check-input">
                        <label for="estadolabel" class="form-check-label" id="lblEstado">Activo</label>
                    </div>
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