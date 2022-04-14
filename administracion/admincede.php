<?php

require_once '../dashmenu/panel_menu.php';

$mensaje = (isset($_POST['mensaje'])) ? $_POST['mensaje'] : '';

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(28, $_SESSION["i_emprid"], '', '', '', '', '', '', 0, 0, 0, 0, 0, 0));
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(29, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 0));
$dataprov = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(36, $_SESSION["i_emprid"], 'NIVEL ARBOL', '', '', '', '', '', 1, 0, 0, 0, 0, 0));
$nivelarbol = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(36, $_SESSION["i_emprid"], 'SUCURSAL', '', '', '', '', '', 0, 0, 0, 0, 0, 0));
$sucursal = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(36, $_SESSION["i_emprid"], 'ZONAS', '', '', '', '', '', 0, 0, 0, 0, 0, 0));
$zona = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(36, $_SESSION["i_emprid"], 'CARGOS', '', '', '', '', '', 0, 0, 0, 0, 0, 0));
$cargo = $resultado->fetchAll(PDO::FETCH_ASSOC);

?>

<input type="hidden" id="mensaje" value="<?php echo $mensaje ?>">

<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Cedentes</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <button type="button" class="btn btn-outline-info" id="btnNuevo" data-toggle="tooltip" data-placement="top" title="nuevo cedente" style="margin-bottom:10px"><i class="fa fa-plus"></i></button>

                    <div class="x_content">
                        <br />
                        <table id="tabledata" class="table table-striped jambo_table table-condensed bulk_action table-borderless" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th style="width:30%">Cedente</th>
                                    <th style="width:15%">Provincia</th>
                                    <th style="width:20%">Cuidad</th>
                                    <th style="width:10% ; text-align: center">Telefono</th>
                                    <th style="width:10% ; text-align: center">Opciones</th>
                                    <th style="width:10% ; text-align: center">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data as $datos) {
                                ?>
                                    <?php
                                    if ($datos['Estado'] == 'Inactivo') {
                                        $disabledit = 'disabled';
                                    } else {
                                        $disabledit = '';
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $datos['CedeId'] ?></td>
                                        <td><?php echo $datos['Cedente'] ?></td>
                                        <td><?php echo $datos['Provincia'] ?></td>
                                        <td><?php echo $datos['Ciudad'] ?></td>
                                        <td><?php echo $datos['Telefono'] ?></td>
                                        <td>
                                            <div class="text-center">
                                                <div class="btn-group">
                                                    <button class="btn btn-outline-info btn-sm ml-2 btnEditar" <?php echo $disabledit; ?> id="btnEditar<?php echo $datos['CedeId']; ?>" data-toggle="tooltip" data-placement="top" title="editar">
                                                        <i class="fa fa-pencil-square-o"></i></button>
                                                    <button class="btn btn-outline-danger btn-sm ml-2" id="btnEliminar">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="text-align: center">
                                            <input type="checkbox" class="form-check-input chkEstado" id="chk<?php echo $datos['CedeId']; ?>" name="check[]" <?php if ($datos['Estado'] == 'Activo') {
                                               echo "checked";    } ?> value="<?php echo $datos['CedeId']; ?>" />                                                                                                                  
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
<div class="modal fade" id="modalNewCedente" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="myModalBg">
            <div class="modal-header" id="header">
                <h5 class="modal-title" id="modalLabel"></h5>
            </div>
            <div class="modal-body">
                <div class="x_content">
                    <br />
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Datos Cedente</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Contactos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Producto-Catalogo</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <form class="form-horizontal col-md-12" role="form">
                                <fieldset>
                                    <br>
                                    <div class="form-group row">
                                        <div class="col-md-6 col-sm-8 form-group">
                                            <select class="form-control" id="cboProvincia" name="cboprovincia" style="width: 100%;">
                                                <option value="0">--Seleccione Provincia--</option>
                                                <?php foreach ($dataprov as $fila) : ?>
                                                    <option value="<?= $fila['Codigo'] ?>"><?= $fila['Descripcion'] ?>
                                                    </option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-sm-8 form-group">
                                            <select class="form-control" id="cboCiudad" name="cbociudad" style="width: 100%;">
                                                <option value="0">--Seleccione Ciudad--</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6 col-sm-8 form-group">
                                            <input autofocus type="text" class="form-control has-feedback-left" id="txtCedente" placeholder="nombre del cedente" maxlength="150">
                                            <span class="fa fa-pie-chart form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                        <div class="col-md-6 col-sm-8 form-group">
                                            <input type="text" class="form-control has-feedback-left" id="txtRuc" maxlength="13" placeholder="ruc" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;">
                                            <span class="fa fa-slack form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12 col-sm-6  form-group has-feedback">
                                            <textarea name="observa" id="txtDireccion" class="form-control" maxlength="200" placeholder="direccion" onKeyUp="this.value=this.value.toUpperCase();" onkeydown="return (event.keyCode!=13);"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6 col-sm-8  form-group has-feedback">
                                            <input type="text" class="form-control has-feedback-left" id="txtTel1" maxlength="9" placeholder="telefono 1" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" name="telefono1" maxlength="15">
                                            <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                        <div class="col-md-6 col-sm-8  form-group has-feedback">
                                            <input type="text" class="form-control has-feedback-left" id="txtTel2" maxlength="9" placeholder="ej: 022222222" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" name="telefono1" maxlength="15">
                                            <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6 col-sm-8  form-group has-feedback">
                                            <input type="text" class="form-control has-feedback-left" id="txtFax" placeholder="fax" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" name="fax" maxlength="10">
                                            <span class="fa fa-fax form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                        <div class="col-md-6 col-sm-8  form-group has-feedback">
                                            <input type="text" class="form-control has-feedback-left" id="txtUrl" placeholder="Url" maxlength="80">
                                            <span class="fa fa-link form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6 col-sm-8 form-group">
                                            <select class="form-control" id="cboArbol" name="cboarbol" style="width: 100%;">
                                                <option value="0">--Seleccione Nivel--</option>
                                                <?php foreach ($nivelarbol as $fila) : ?>
                                                    <option value="<?= $fila['Codigo'] ?>"><?= $fila['Descripcion'] ?>
                                                    </option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <form class="form-horizontal col-md-10 offset-md-1" role="form">
                                <div class="form-group row">
                                    <div class="col-md-6 col-sm-8 form-group">
                                        <input type="tel" class="form-control has-feedback-left" id="txtContacto" placeholder="nombre del contacto" class="form-control" maxlength="150">
                                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <select class="form-control" id="cboCargo" name="cbocargo" style="width: 100%;">
                                            <option value="0">--Seleccione Cargo--</option>
                                            <?php foreach ($cargo as $fila) : ?>
                                                <option value="<?= $fila['Codigo'] ?>"><?= $fila['Descripcion'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6 col-sm-8 form-group">
                                        <input type="tel" class="form-control has-feedback-left" id="txtExt" placeholder="022222222" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" name="ext" maxlength="9">
                                        <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                    <div class="col-md-6 col-sm-8 form-group">
                                        <input type="tel" class="form-control has-feedback-left" id="txtCelular" maxlength="10" placeholder="0999999999" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" class="form-control" maxlength="10">
                                        <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6 col-sm-8 form-group">
                                        <input type="email" class="form-control has-feedback-left" id="txtEmail1" placeholder="e-mail" maxlength="80" onKeyUp="this.value=this.value.toLowerCase();">
                                        <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                    <div class="col-md-6 col-sm-8 form-group">
                                        <input type="email" class="form-control has-feedback-left" id="txtEmail2" placeholder="example@gmail.com" maxlength="80" onKeyUp="this.value=this.value.toLowerCase();">
                                        <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-2 col-sm-4 float-end">
                                        <button type="button" class="btn btn-outline-info" id="btnContacto" data-toggle="tooltip" data-placement="top" title="agregar contacto" style="margin-bottom:10px"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </form>
                            <br />
                            <br />
                            <div class="col-md-12 col-sm-12">
                                <form method="post" id="user_form">
                                    <div class="table-responsive">
                                        <table id="tblcontactonew" class="table table-striped jambo_table table-condensed bulk_action table-borderless" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th style="display: none;">Id</th>
                                                    <th style="text-align: center;">Contacto</th>
                                                    <th style="text-align: center;">Cargo</th>
                                                    <th style="display: none;">CodigoCargo</th>
                                                    <th style="text-align: center;">Teléfono</th>
                                                    <th style="text-align: center;">Celular</th>
                                                    <th style="text-align: center;">Email</th>
                                                    <th style="display: none;">Email2</th>
                                                    <th style="text-align: center;">Opciones</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <form class="form-horizontal col-md-10 offset-md-2" role="form">
                                <div class="row">
                                    <div class="col-md-10 col-sm-6 form-group">
                                        <input type="text" class="form-control has-feedback-left" id="txtProducto" placeholder="nombre del producto" maxlength="150">
                                        <span class="fa fa-briefcase form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-10 col-sm-6">
                                        <textarea name="observa" id="txtDescripcion" class="form-control" maxlength="250" placeholder="descripcion" onkeydown="return (event.keyCode!=13);"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-10">
                                        <button type="button" class="btn btn-outline-info" id="btnProducto" data-toggle="tooltip" data-placement="top" title="agregar producto" style="margin-bottom:10px"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </form>
                            <br />
                            <div class="col-md-10 offset-md-1">
                                <form method="post" id="user_form">
                                    <div class="table-responsive">
                                        <table id="tblproducto" class="table table-striped jambo_table table-condensed bulk_action table-borderless" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th style="display: none;">Id</th>
                                                    <th>Producto</th>
                                                    <th>Descripcion</th>
                                                    <th style="width:13% ; text-align: center">Opciones</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </form>
                            </div>
                            <br />
                            <div class="col-md-10 offset-md-1">
                                <form method="post" id="user_form">
                                    <div class="table-responsive">
                                        <table id="tblcatalogo" class="table table-striped jambo_table table-condensed bulk_action   table-borderless" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th style="display: none;">Id</th>
                                                    <th>Producto</th>
                                                    <th>Cod.Catalogo</th>
                                                    <th>Catalogo</th>
                                                    <th style="text-align: center;">Opciones</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </form>
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
<div class="modal fade" id="modalCONTACTO" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 35%" role="document">
        <div class="modal-content" id="myModalBg">
            <div class="modal-header" id="headercon">
                <h5 class="modal-title" id="modalLabel"></h5>
            </div>
            <form id="formContacto">
                <div class="modal-body">
                    <br />
                    <div class="row">
                        <label for="cbocargo" class="control-label col-md-2">Cargo </label>
                        <select class="form-control" id="cboCargoMo" name="cboCargo1" style="width: 75%;">
                            <option value="0">--Seleccione Cargo--</option>
                            <?php foreach ($cargo as $fila) : ?>
                                <option value="<?= $fila['Codigo'] ?>"><?= $fila['Descripcion'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <br />
                    <div class="row">
                        <label for="menuname" class="control-label col-md-2">Contacto</label>
                        <div class="col-md-9 col-sm-9  form-group has-feedback">
                            <input type="tel" class="form-control has-feedback-left" id="txtContactoMo" placeholder="" maxlength="150">
                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <label for="menuname" class="control-label col-md-2">Celular</label>
                        <div class="col-md-9 col-sm-9  form-group has-feedback">
                            <input type="tel" class="form-control has-feedback-left" id="txtCelularMo" placeholder="" maxlength="10" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;">
                            <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <label for="menuname" class="control-label col-md-2">Ext</label>
                        <div class="col-md-9 col-sm-9  form-group has-feedback">
                            <input type="tel" class="form-control has-feedback-left" id="txtExtMo" placeholder="" maxlength="10" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;">
                            <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <label for="menuname" class="control-label col-md-2">Email</label>
                        <div class="col-md-9 col-sm-9  form-group has-feedback">
                            <input type="text" class="form-control has-feedback-left" id="txtEmail1Mo" placeholder="" maxlength="80">
                            <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="row_id" id="hidden_row_id" />
                    <button type="button" id="btnEditarCon" class="btn btn-outline-info ml-3">Modificar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalPRODUCTO" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 35%" role="document">
        <div class="modal-content" id="myModalBg">
            <div class="modal-header" id="headerpro">
                <h5 class="modal-title" id="modalLabel"></h5>
            </div>
            <form id="formProducto">
                <div class="modal-body">
                    <br />
                    <div class="row">
                        <label for="menuname" class="control-label col-md-2">Producto</label>
                        <div class="col-md-10 col-sm-10  form-group has-feedback">
                            <input type="tel" class="form-control has-feedback-left" id="txtProductoMo" placeholder="" maxlength="150" onKeyUp="this.value=this.value.toUpperCase();">
                            <span class="fa fa-briefcase form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="row_id" id="hidden_row_id" />
                    <button type="button" id="btnModProduc" class="btn btn-outline-info ml-3">Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalCATALOGO" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 35%" role="document">
        <div class="modal-content" id="myModalBg">
            <div class="modal-header" id="headercat">
                <h5 class="modal-title" id="modalLabel"></h5>
            </div>
            <form id="formCatalogo">
                <div class="modal-body">
                    <br/>
                    <div class="row">
                        <label for="menuname" class="control-label col-md-2"></label>
                        <div class="col-md-8 col-sm-8  form-group has-feedback">
                            <input type="tel" class="form-control has-feedback-left" id="txtCodigoMo" placeholder="codigo" maxlength="10">
                            <span class="fa fa-slack form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="row">
                        <label for="menuname" class="control-label col-md-2"></label>
                        <div class="col-md-8 col-sm-8  form-group has-feedback">
                            <input type="text" class="form-control has-feedback-left" id="txtCatalogoMo" placeholder="nombre del catalogo" maxlength="250">
                            <span class="fa fa-file-text form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="row_id" id="hidden_row_id" />
                    <button type="button" id="btnAddCatalogo" class="btn btn-outline-primary"><i class='fa fa-plus'></i> Agregar</button>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalEDITCATALOGO" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 35%" role="document">
        <div class="modal-content" id="myModalBg">
            <div class="modal-header" id="headercatalog">
                <h5 class="modal-title" id="modalLabel"></h5>
            </div>
            <form id="formEditCatalogo">
                <div class="modal-body">
                    <div class="row">
                        <label for="menuname" class="control-label col-md-2">Codigo</label>
                        <div class="col-md-8 col-sm-8  form-group has-feedback">
                            <input type="tel" class="form-control has-feedback-left" id="txtCodMo" placeholder="" maxlength="10" onKeyUp="this.value=this.value.toUpperCase();">
                            <span class="fa fa-slack form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="row">
                        <label for="menuname" class="control-label col-md-2">Catalogo</label>
                        <div class="col-md-8 col-sm-8  form-group has-feedback">
                            <input type="text" class="form-control has-feedback-left" id="txtCatMo" placeholder="" maxlength="250" onKeyUp="this.value=this.value.toUpperCase();">
                            <span class="fa fa-file-text form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="row_id" id="hidden_row_id" />
                    <button type="button" id="btnEditCat" class="btn btn-outline-info ml-3">Modificar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once '../dashmenu/panel_footer.php'; ?>
<script src="../codejs/cedente.js" type="text/javascript"></script>

</body>

</html>