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
                        <table id="tabledata" class="table table-striped jambo_table table-condensed table-dark table-borderless" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th style="width:40%">Cedente</th>
                                    <th style="width:20%">Cuidad</th>
                                    <th style="width:12% ; text-align: center">Telefono</th>
                                    <th style="width:13% ; text-align: center">Opciones</th>
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
                                        <td><?php echo $datos['Ciudad'] ?></td>
                                        <td><?php echo $datos['Telefono'] ?></td>
                                        <td>
                                            <div class="text-center">
                                                <div class="btn-group">
                                                    <button class="btn btn-outline-info btn-sm ml-3 btnEditar" <?php echo $disabledit; ?> id="btnEditar<?php echo $datos['CedeId']; ?>" data-toggle="tooltip" data-placement="top" title="editar">
                                                        <i class="fa fa-pencil-square-o"></i></button>
                                                    <button class="btn btn-outline-danger btn-sm ml-3" id="btnEliminar" data-toggle="tooltip" data-placement="top" title="eliminar">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="text-align: center">
                                            <input type="checkbox" class="form-check-input chkEstado" id="chk<?php echo $datos['CedeId']; ?>" name="check[]" <?php if ($datos['Estado'] == 'Activo') {
                                                                                                                                                                    echo "checked";
                                                                                                                                                                } ?> value="<?php echo $datos['CedeId']; ?>" />
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
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
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
                            <form class="form-horizontal" role="form">
                                <fieldset>
                                    <br>
                                    <div class="row">
                                        <label for="espacio" class="control-label col-md-1"></label>
                                        <label for="cboprovincia" class="control-label col-md-1">Provincia:</label>
                                        <div class="form-group col-md-3">

                                            <select class="form-control" id="cboProvincia" name="cboprovincia" style="width: 100%;">
                                                <option value="0">--Seleccione Provincia--</option>
                                                <?php foreach ($dataprov as $fila) : ?>
                                                    <option value="<?= $fila['Codigo'] ?>"><?= $fila['Descripcion'] ?>
                                                    </option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <label for="espacio" class="control-label col-md-1"></label>
                                        <label for="cbocuidad" class="control-label col-md-1">Cuidad:</label>
                                        <div class="form-group col-md-3">
                                            <select class="form-control" id="cboCiudad" name="cbociudad" style="width: 100%;">
                                                <option value="0">--Seleccione Ciudad--</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label for="espacio" class="control-label col-md-1"></label>
                                        <label for="menuname" class="control-label col-md-1">Cedente:</label>
                                        <!-- <div class="form-group col-md-3">
                                            <input type="text" required class="form-control" id="txtCedente" name="menuname" maxlength="150" onKeyUp="this.value=this.value.toUpperCase();">
                                        </div> -->
                                        <div class="col-md-3 col-sm-3 form-group">
                                            <input autofocus type="text" class="form-control has-feedback-left" id="txtCedente" maxlength="150" onKeyUp="this.value=this.value.toUpperCase();">
                                            <span class="fa fa-pie-chart form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                        <label for="espacio" class="control-label col-md-1"></label>
                                        <label for="iconome" class="control-label col-md-1">Ruc:</label>
                                        <!-- <div class="form-group col-md-3">
                                            <input id="txtRuc" name="iconome" type="text" class="form-control" maxlength="13" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;">
                                        </div> -->
                                        <div class="col-md-3 col-sm-3 form-group">
                                            <input type="text" class="form-control has-feedback-left" id="txtRuc" maxlength="13" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;">
                                            <span class="fa fa-slack form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="espacio" class="control-label col-md-1"></label>
                                        <label for="menuname" class="control-label col-md-1">Direccion:</label>
                                        <div class="form-group col-md-10">
                                            <textarea name="observa" id="txtDireccion" class="form-control col-md-8" maxlength="200" onKeyUp="this.value=this.value.toUpperCase();" onkeydown="return (event.keyCode!=13);"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="espacio" class="control-label col-md-1"></label>
                                        <label for="menuname" class="control-label col-md-1">Telefono 1:</label>
                                        <!-- <div class="form-group col-md-3">
                                            <input type="text" required class="form-control" id="txtTel1" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" name="telefono1" maxlength="15">
                                        </div> -->
                                        <div class="col-md-3 col-sm-3  form-group has-feedback">
                                            <input type="text" class="form-control has-feedback-left" id="txtTel1" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" name="telefono1" maxlength="15">
                                            <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                        <label for="espacio" class="control-label col-md-1"></label>
                                        <label for="iconome" class="control-label col-md-1">Telefono 2:</label>
                                        <!-- <div class="form-group col-md-3">
                                            <input id="txtTel2" name="iconome" type="text" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" class="form-control" maxlength="15">
                                        </div> -->
                                        <div class="col-md-3 col-sm-3  form-group has-feedback">
                                            <input type="text" class="form-control has-feedback-left" id="txtTel2" placeholder="ej: 022630922" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" name="telefono1" maxlength="15">
                                            <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="espacio" class="control-label col-md-1"></label>
                                        <label for="fax" class="control-label col-md-1">Fax:</label>
                                        <!-- <div class="form-group col-md-3">
                                            <input type="text" required class="form-control" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" id="txtFax" name="fax" maxlength="10">
                                        </div> -->
                                        <div class="col-md-3 col-sm-3  form-group has-feedback">
                                            <input type="text" class="form-control has-feedback-left" id="txtFax" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" name="fax" maxlength="10">
                                            <span class="fa fa-fax form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                        <label for="espacio" class="control-label col-md-1"></label>
                                        <label for="iconome" class="control-label col-md-1">Url:</label>
                                        <!-- <div class="form-group col-md-3">
                                            <input id="txtUrl" name="iconome" type="text" class="form-control" maxlength="80">
                                        </div> -->
                                        <div class="col-md-3 col-sm-3  form-group has-feedback">
                                            <input type="text" class="form-control has-feedback-left" id="txtUrl" maxlength="80">
                                            <span class="fa fa-link form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="espacio" class="control-label col-md-1"></label>
                                        <label for="cboArbol" class="control-label col-md-1">Nivel Arbol:</label>
                                        <div class="form-group col-md-3">
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
                            <div class="row">
                                <label for="espacio" class="control-label col-md-1"></label>
                                <label for="contacto" class="control-label col-md-1">Contacto:</label>
                                <!-- <div class="form-group col-md-3">
                                    <input type="text" required class="form-control" id="txtContacto" name="contacto" maxlength="150" onKeyUp="this.value=this.value.toUpperCase();">
                                </div> -->
                                <div class="col-md-3 col-sm-3 form-group">
                                    <input type="tel" class="form-control has-feedback-left" id="txtContacto" class="form-control" maxlength="150" onKeyUp="this.value=this.value.toUpperCase();">
                                    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                </div>
                                <label for="espacio" class="control-label col-md-1"></label>
                                <label for="cbomenupadre" class="control-label col-md-1">Cargo:</label>
                                <div class="form-group col-md-3">
                                    <select class="form-control" id="cboCargo" name="cbocargo" style="width: 100%;">
                                        <option value="0">--Seleccione Cargo--</option>
                                        <?php foreach ($cargo as $fila) : ?>
                                            <option value="<?= $fila['Codigo'] ?>"><?= $fila['Descripcion'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <button type="button" class="btn btn-outline-info" id="btnContacto" data-toggle="tooltip" data-placement="top" title="agregar contacto" style="margin-bottom:10px"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="row">
                                <label for="espacio" class="control-label col-md-1"></label>
                                <label for="ext" class="control-label col-md-1">Ext:</label>
                                <!-- <div class="form-group col-md-3">
                                    <input type="text" required class="form-control" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" id="txtExt" name="ext" maxlength="10">
                                </div> -->
                                <div class="col-md-3 col-sm-3 form-group">
                                    <input type="tel" class="form-control has-feedback-left" id="txtExt" placeholder="" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" name="ext" maxlength="10">
                                    <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                                </div>
                                <label for="espacio" class="control-label col-md-1"></label>
                                <label for="celular" class="control-label col-md-1">Celular:</label>
                                <!-- <div class="form-group col-md-3">
                                    <input id="txtCelular" name="iconome" type="tel" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" class="form-control" maxlength="10">
                                </div> -->
                                <div class="col-md-3 col-sm-3 form-group">
                                    <input type="tel" class="form-control has-feedback-left" id="txtCelular" placeholder="" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" class="form-control" maxlength="10">
                                    <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                                </div>
                            </div>
                            <div class="row">
                                <label for="espacio" class="control-label col-md-1"></label>
                                <label for="email" class="control-label col-md-1">Email 1:</label>
                                <!-- <div class="form-group col-md-3">
                                    <input type="text" required class="form-control" id="txtEmail1" maxlength="80" onKeyUp="this.value=this.value.toLowerCase();">
                                </div> -->
                                <div class="col-md-3 col-sm-3 form-group">
                                    <input type="email" class="form-control has-feedback-left" id="txtEmail1" placeholder="" maxlength="80" onKeyUp="this.value=this.value.toLowerCase();">
                                    <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                                </div>
                                <label for="espacio" class="control-label col-md-1"></label>
                                <label for="email" class="control-label col-md-1">Email 2:</label>
                                <!-- <div class="form-group col-md-3">
                                    <input id="txtEmail2" name="email" type="text" class="form-control" maxlength="80" onKeyUp="this.value=this.value.toLowerCase();">
                                </div>  -->
                                <div class="col-md-3 col-sm-3 form-group">
                                    <input type="email" class="form-control has-feedback-left" id="txtEmail2" placeholder="example@gmail.com" maxlength="80" onKeyUp="this.value=this.value.toLowerCase();">
                                    <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                                </div>
                            </div>
                            <br />
                            <br />
                            <div class="col-md-12 col-sm-12">
                                <div class="col-md-1 col-sm-1">
                                </div>
                                <div class="col-md-10 col-sm-10">
                                    <form method="post" id="user_form">
                                        <div class="table-responsive">
                                            <table id="tblcontacto" class="table table-striped jambo_table table-condensed table-dark table-borderless" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th style="display: none;">Id</th>
                                                        <th>Contacto</th>
                                                        <th style="text-align: center;">Cargo</th>
                                                        <th style="display: none;">CodigoCargo</th>
                                                        <th style="text-align: center;">Celular</th>
                                                        <th>Ext</th>
                                                        <th style="text-align: center;">Email</th>
                                                        <th style="text-align: center;">Opciones</th>
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
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div class="row">
                                <label for="espacio" class="control-label col-md-2"></label>
                                <label for="producto" class="control-label col-md-1">Producto</label>
                                <!-- <div class="form-group col-md-7">
                                    <input type="text" required class="form-control" id="txtProducto" name="producto" maxlength="150" onKeyUp="this.value=this.value.toUpperCase();">
                                </div> -->
                                <div class="col-md-6 col-sm-6 form-group">
                                    <input type="text" class="form-control has-feedback-left" id="txtProducto" placeholder="" maxlength="150" onKeyUp="this.value=this.value.toUpperCase();">
                                    <span class="fa fa-briefcase form-control-feedback left" aria-hidden="true"></span>
                                </div>
                                <div class="form-group col-md-2">
                                    <button type="button" class="btn btn-outline-info" id="btnProducto" data-toggle="tooltip" data-placement="top" title="agregar producto" style="margin-bottom:10px"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="row">
                                <label for="espacio" class="control-label col-md-2"></label>
                                <label for="menuname" class="control-label col-md-1">Descripcion</label>
                                <div class="form-group col-md-9">
                                    <textarea name="observa" id="txtDescripcion" class="form-control col-md-9" maxlength="250" onkeydown="return (event.keyCode!=13);"></textarea>
                                </div>
                            </div>
                            <br>
                            <div class="col-md-12 col-sm-12">
                                <div class="col-md-1 col-sm-1">
                                </div>
                                <div class="col-md-10 col-sm-10">
                                    <form method="post" id="user_form">
                                        <div class="table-responsive">
                                            <table id="tblproducto" class="table table-striped jambo_table table-condensed table-dark table-borderless" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th style="display: none;">Id</th>
                                                        <th>Producto</th>
                                                        <th style="width:13% ; text-align: center">Opciones</th>
                                                        <!-- <th style="width:10% ; text-align: center">Estado</th> -->
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
                            <br>
                            <div class="col-md-12 col-sm-12">
                                <div class="col-md-1 col-sm-1">
                                </div>
                                <div class="col-md-10 col-sm-10">
                                    <form method="post" id="user_form">
                                        <div class="table-responsive">
                                            <table id="tblcatalogo" class="table table-striped jambo_table table-condensed table-dark table-borderless" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th style="display: none;">Id</th>
                                                        <th>Producto</th>
                                                        <th>Cod.Catalogo</th>
                                                        <th>Catalogo</th>
                                                        <!-- <th>Estado</th> -->
                                                        <th style="text-align: center;">Opciones</th>
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
<div class="modal fade" id="modalCONTACTO" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 35%" role="document">
        <div class="modal-content" id="myModalBg">
            <div class="modal-header" id="headercon">
                <h5 class="modal-title" id="modalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formContacto">
                <div class="modal-body">
                    <!-- <div class="form-group">
                        <label for="contacto" class="col-form-label">Contacto</label>
                        <input type="text" id="txtContactoMo" required class="form-control" maxlength="150" onKeyUp="this.value=this.value.toUpperCase();">
                    </div> -->
                 
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
                    <br/>
                    <div class="row">
                        <label for="menuname" class="control-label col-md-2">Contacto</label>
                        <div class="col-md-9 col-sm-9  form-group has-feedback">
                            <input type="tel" class="form-control has-feedback-left" id="txtContactoMo" placeholder="" maxlength="150" onKeyUp="this.value=this.value.toUpperCase();">
                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label for="valorv" class="col-form-label">Celular</label>
                        <input type="text" id="txtCelularMo" class="form-control" maxlength="10" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;">
                    </div> -->
                    <br />
                    <div class="row">
                        <label for="menuname" class="control-label col-md-2">Celular</label>
                        <div class="col-md-9 col-sm-9  form-group has-feedback">
                            <input type="tel" class="form-control has-feedback-left" id="txtCelularMo" placeholder="" maxlength="10" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;">
                            <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label for="valori" class="col-form-label">Ext</label>
                        <input type="text" id="txtExtMo" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" class="form-control" maxlength="10">
                    </div> -->
                    <br />
                    <div class="row">
                        <label for="menuname" class="control-label col-md-2">Ext</label>
                        <div class="col-md-9 col-sm-9  form-group has-feedback">
                            <input type="tel" class="form-control has-feedback-left" id="txtExtMo" placeholder="" maxlength="10" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;">
                            <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>

                    <!-- <div class="form-group">
                        <label for="email" class="col-form-label">Email</label>
                        <input type="text" id="txtEmail1Mo" required class="form-control" maxlength="80">
                    </div> -->
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formProducto">
                <div class="modal-body">
                    <br/>
                    <!-- <div class="form-group">
                        <label for="produc" class="control-label col-md-4">Producto</label>
                        <input type="text" required class="form-control" id="txtProductoMo" name="producto" maxlength="150" onKeyUp="this.value=this.value.toUpperCase();">
                    </div> -->
                    <div class="row">
                        <label for="menuname" class="control-label col-md-2">Producto</label>
                        <div class="col-md-10 col-sm-10  form-group has-feedback">
                            <input type="tel" class="form-control has-feedback-left" id="txtProductoMo" placeholder="" maxlength="150" onKeyUp="this.value=this.value.toUpperCase();">
                            <span class="fa fa-briefcase form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <!-- <div class="form-check" id="divcheck">
                        <input type="checkbox" id="chkEstadoPro" class="form-check-input">
                        <label for="estadolabel" class="form-check-label" id="lblEstadoPro">Activo</label>
                    </div> -->
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formCatalogo">
                <div class="modal-body">
                    <!-- <div class="form-group">
                        <label for="menuname" class="control-label col-md-4">Codigo Catalogo</label>
                        <input type="text" required class="form-control" id="txtCodigoMo" name="catalogo" maxlength="10" onKeyUp="this.value=this.value.toUpperCase();">
                    </div> -->
                    <div class="row">
                        <label for="menuname" class="control-label col-md-2">Codigo</label>
                        <div class="col-md-8 col-sm-8  form-group has-feedback">
                            <input type="tel" class="form-control has-feedback-left" id="txtCodigoMo" placeholder="" maxlength="10" onKeyUp="this.value=this.value.toUpperCase();">
                            <span class="fa fa-slack form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label for="catalogo" class="control-label col-md-2">Catalogo</label>
                        <input id="txtCatalogoMo" name="txtcatalogo" type="text" class="form-control" maxlength="250" onKeyUp="this.value=this.value.toUpperCase();">
                    </div> -->
                    <div class="row">
                        <label for="menuname" class="control-label col-md-2">Catalogo</label>
                        <div class="col-md-8 col-sm-8  form-group has-feedback">
                            <input type="text" class="form-control has-feedback-left" id="txtCatalogoMo" placeholder="" maxlength="250" onKeyUp="this.value=this.value.toUpperCase();">
                            <span class="fa fa-file-text form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="row_id" id="hidden_row_id" />
                    <button type="button" id="btnAddCatalogo" class="btn btn-outline-info ml-3"><i class='fa fa-plus'></i> Agregar</button>
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formEditCatalogo">
                <div class="modal-body">
                    <!-- <div class="form-group">
                        <label for="produc" class="control-label col-md-4">Cod.Catalogo</label>
                        <input type="text" required class="form-control" id="txtCodMo" name="producto" maxlength="10" onKeyUp="this.value=this.value.toUpperCase();">
                    </div> -->
                    <div class="row">
                        <label for="menuname" class="control-label col-md-2">Codigo</label>
                        <div class="col-md-8 col-sm-8  form-group has-feedback">
                            <input type="tel" class="form-control has-feedback-left" id="txtCodMo" placeholder="" maxlength="10" onKeyUp="this.value=this.value.toUpperCase();">
                            <span class="fa fa-slack form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label for="produc" class="control-label col-md-4">Catalogo</label>
                        <input type="text" required class="form-control" id="txtCatMo" name="producto" maxlength="250" onKeyUp="this.value=this.value.toUpperCase();">
                    </div> -->
                    <div class="row">
                        <label for="menuname" class="control-label col-md-2">Catalogo</label>
                        <div class="col-md-8 col-sm-8  form-group has-feedback">
                            <input type="text" class="form-control has-feedback-left" id="txtCatMo" placeholder="" maxlength="250" onKeyUp="this.value=this.value.toUpperCase();">
                            <span class="fa fa-file-text form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <!-- <div class="form-check" id="divcheck">
                        <input type="checkbox" id="chkEstadoCat" class="form-check-input">
                        <label for="estadolabel" class="form-check-label" id="lblEstadoCat">Activo</label>
                    </div> -->
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