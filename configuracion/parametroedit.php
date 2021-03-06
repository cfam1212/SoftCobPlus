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
$paraid = (isset($_POST['id'])) ? $_POST['id'] : '';

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(32, $_SESSION["i_emprid"], '', '', '', '', '', '', $paraid, 0, 0, 0, 0, 0));
$datapara = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(33, $_SESSION["i_emprid"], '', '', '', '', '', '', $paraid, 0, 0, 0, 0, 0));
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="right_col" role="main">
    <input type="hidden" id="paraid" value="<?php echo $paraid ?>">
    <input type="hidden" id="mensaje" value="<?php echo $mensaje ?>">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Editar Parametro</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>

                        </ul>
                        <div class="clearfix"></div>
                    </div>
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
                                <form class="form-horizontal col-md-10 offset-md-1" role="form">
                                    <fieldset>
                                        <div class="form-group row">
                                            <label for="espacio" class="control-label col-md-1"></label>
                                            <label for="menuname" class="control-label col-md-1">Par??metro:</label>
                                        </div>
                                        <div class="row">
                                            <label for="espacio" class="control-label col-md-1"></label>
                                            <div class="col-md-9 col-sm-4  form-group has-feedback">
                                                <input autofocus type="text" class="form-control has-feedback-left" id="txtParametro" maxlength="80" value="<?php echo $datapara[0]['Parametro']; ?>">
                                                <span class="fa fa-bookmark form-control-feedback left" aria-hidden="true"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="espacio" class="control-label col-md-1"></label>
                                            <label for="menuname" class="control-label col-md-1">Descripci??n:</label>
                                        </div>
                                        <div class="row">
                                            <label for="espacio" class="control-label col-md-1"></label>
                                            <div class="form-group col-md-9">
                                                <textarea name="observa" id="txtDescripcion" class="form-control"><?php echo $datapara[0]['Descripcion']; ?></textarea>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                                <br />
                                <div class="float-right">
                                    <button class="btn btn-outline-info ml-3 float-end" id="btnSave"><i class='fa fa-save'></i> Guardar</button>
                                </div>
                                <br />
                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                <div class="col-md-12 col-sm-12">
                                    <div class="col-md-1 col-sm-1">
                                    </div>
                                    <div class="col-md-10 col-sm-10">
                                        <button type="button" class="btn btn-outline-info float-right" id="btnAdd" data-toggle="tooltip" data-placement="top" title="nuevo detalle" style="margin-bottom:10px"><i class="fa fa-plus"></i></button>
                                        <form method="post" id="user_form">
                                            <div class="table-responsive">
                                                <table id="tblparameter" class="table table-striped table-condensed jambo_table bulk_action table-borderless" style="width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th style="display: none;">Id</th>
                                                            <th style="display: none;">NOrden</th>
                                                            <th>Detalle</th>
                                                            <th style="text-align: center">Valor Texto</th>
                                                            <th style="text-align: center">Valor Entero</th>
                                                            <th style="width:13% ; text-align: center">Opciones</th>
                                                            <th style="width:10% ; text-align: center">Estado</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($data as $dat) {
                                                        ?>
                                                            <tr id="row_<?php echo $dat['Orden']; ?>">
                                                                <td style="display: none;">
                                                                    <?php echo $dat['Padeid']; ?>
                                                                    <input type="hidden" name="hidden_padeid[]" id="padeid<?php echo $dat['Orden']; ?>" value="<?php echo $dat['Padeid']; ?>" />
                                                                </td>
                                                                <td style="display: none;">
                                                                    <?php echo $dat['Orden']; ?>
                                                                    <input type="hidden" name="hidden_orden[]" id="orden<?php echo $dat['Orden']; ?>" value="<?php echo $dat['Orden']; ?>" />
                                                                </td>
                                                                <td>
                                                                    <?php echo $dat['Detalle']; ?>
                                                                    <input type="hidden" name="hidden_detalle[]" id="txtDetalle<?php echo $dat['Orden']; ?>" value="<?php echo $dat['Detalle']; ?>" />
                                                                </td>
                                                                <td class="text-center">
                                                                    <?php echo $dat['ValorV']; ?>
                                                                    <input type="hidden" name="hidden_valorv[]" id="txtValorv<?php echo $dat['Orden']; ?>" value="<?php echo $dat['ValorV']; ?>" />
                                                                </td>
                                                                <td class="text-center">
                                                                    <?php echo $dat['ValorI']; ?>
                                                                    <input type="hidden" name="hidden_valori[]" id="txtValori<?php echo $dat['Orden']; ?>" value="<?php echo $dat['ValorI']; ?>" />
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    if ($dat['Orden'] == '1') {
                                                                        $desactivar = "disabled";
                                                                    } else {
                                                                        $desactivar = '';
                                                                    }
                                                                        $disabledit = '';

                                                                      if($dat['Estado'] == 'Inactivo'){
                                                                        $disabledit = 'disabled';
                                                                      }else{
                                                                        $disabledit = '';
                                                                      }
                                                                    ?>
                                                                    <div class="text-center">
                                                                        <div class="btn-group">
                                                                            <button type="button" name="btnUp" class="btn btn-outline-primary btn-sm btnUp" data-toggle="tooltip" data-placement="top" title="subir" id="btnUp<?php echo $dat['Orden']; ?>" <?php echo $desactivar; ?>><i class="fa fa-arrow-up"></i></button>
                                                                            <button type="button" name="btnEdit" class="btn btn-outline-info btn-sm ml-2 btnEdit"<?php echo $disabledit; ?> data-toggle="tooltip" data-placement="top" title="editar" id="btnEdit<?php echo $dat['Orden']; ?>"><i class="fa fa-pencil-square-o"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td style="text-align: center">
                                                                    <input type="checkbox" class="form-check-input chkEstadoDe" id="chk<?php echo $dat['Orden']; ?>" name="check[]" <?php if ($dat['Estado'] == 'Activo') {
                                                                            echo "checked";  } ?> value="<?php echo $dat['Padeid']; ?>" />                                                                                                                 
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
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
                <div class='btn-group'>
                    <button class="btn btn-outline-secondary" id="btnRegresar"><i class='fa fa-undo'></i> Regresar</button>
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
                    <div class="row">
                        <label for="detalle" class="control-label col-md-2">Detalle:</label>
                        <div class="col-md-12 col-sm-12 form-group has-feedback">
                            <input type="text" class="form-control has-feedback-left" id="txtDetalle" placeholder="nombre del detalle" maxlength="80">
                            <span class="fa fa-list-ul form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <label for="valor" class="control-label col-md-3">Valor Texto:</label>
                        <div class="col-md-12 col-sm-12 form-group has-feedback">
                            <input type="text" class="form-control has-feedback-left" id="txtValorv" placeholder="valor texto" maxlength="255">
                            <span class="fa fa-list-ul form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <br/>
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
                    <button type="button" id="btnBoton" class="btn btn-outline-info"><i class="fa fa-save"></i></button>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php require_once '../dashmenu/panel_footer.php'; ?>
<script src="../codejs/paraedit.js" type="text/javascript"></script>

</body>

</html>