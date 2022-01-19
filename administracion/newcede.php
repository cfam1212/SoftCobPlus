<?php

require_once '../dashmenu/panel_menu.php';

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
                        <h2>NUEVO CEDENTE</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="cedente-tab" data-toggle="tab" href="#cedente" role="tab" aria-controls="cedente" aria-selected="true">Datos Cedente</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contacto-tab" data-toggle="tab" href="#contacto" role="tab" aria-controls="contacto" aria-selected="false">Contactos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="producto-tab" data-toggle="tab" href="#producto" role="tab" aria-controls="producto" aria-selected="false">Productos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="agencia-tab" data-toggle="tab" href="#agencia" role="tab" aria-controls="agencia" aria-selected="false">Agencias</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="cedente" role="tabpanel" aria-labelledby="cedente-tab">
                                <form class="form-horizontal" role="form">
                                    <fieldset>
                                        <br>
                                        <div class="row">
                                            <label for="espacio" class="control-label col-md-1"></label>
                                            <label for="cboprovincia" class="control-label col-md-1">Provincia</label>
                                            <div class="form-group col-md-3">

                                                <select class="form-control" id="cboProvincia" name="cboprovincia">
                                                    <option value="0">--Seleccione Provincia--</option>
                                                    <?php foreach ($dataprov as $fila) : ?>
                                                        <option value="<?= $fila['Codigo'] ?>"><?= $fila['Descripcion'] ?>
                                                        </option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                            <label for="espacio" class="control-label col-md-1"></label>
                                            <label for="cbocuidad" class="control-label col-md-1">Cuidad</label>
                                            <div class="form-group col-md-3">
                                                <select class="form-control" id="cboCiudad" name="cbociudad">
                                                    <option value="0">--Seleccione Ciudad--</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label for="espacio" class="control-label col-md-1"></label>
                                            <label for="menuname" class="control-label col-md-1">Cedente</label>
                                            <div class="form-group col-md-3">
                                                <input type="text" required class="form-control" id="txtCedente" name="menuname" maxlength="150" onKeyUp="this.value=this.value.toUpperCase();">
                                            </div>
                                            <label for="espacio" class="control-label col-md-1"></label>
                                            <label for="iconome" class="control-label col-md-1">Ruc</label>
                                            <div class="form-group col-md-3">
                                                <input id="txtRuc" name="iconome" type="text" class="form-control" maxlength="13" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="espacio" class="control-label col-md-1"></label>
                                            <label for="menuname" class="control-label col-md-1">Direccion</label>
                                            <div class="form-group col-md-10">
                                                <textarea name="observa" id="txtDireccion" class="form-control col-md-8" maxlength="200" onKeyUp="this.value=this.value.toUpperCase();" onkeydown="return (event.keyCode!=13);"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="espacio" class="control-label col-md-1"></label>
                                            <label for="menuname" class="control-label col-md-1">Telefono 1</label>
                                            <div class="form-group col-md-3">
                                                <input type="text" required class="form-control" id="txtTel1" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" name="telefono1" maxlength="15">
                                            </div>
                                            <label for="espacio" class="control-label col-md-1"></label>
                                            <label for="iconome" class="control-label col-md-1">Telefono 2</label>
                                            <div class="form-group col-md-3">
                                                <input id="txtTel2" name="iconome" type="text" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" class="form-control" maxlength="15">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="espacio" class="control-label col-md-1"></label>
                                            <label for="menuname" class="control-label col-md-1">Fax</label>
                                            <div class="form-group col-md-3">
                                                <input type="text" required class="form-control" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" id="txtFax" name="fax" maxlength="10">
                                            </div>
                                            <label for="espacio" class="control-label col-md-1"></label>
                                            <label for="iconome" class="control-label col-md-1">Url</label>
                                            <div class="form-group col-md-3">
                                                <input id="txtUrl" name="iconome" type="text" class="form-control" maxlength="80">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="espacio" class="control-label col-md-1"></label>
                                            <label for="cboArbol" class="control-label col-md-1">Nivel Arbol</label>
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
                                        <br>
                                        <br>
                                        <br>
                                    </fieldset>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="contacto" role="tabpanel" aria-labelledby="contacto-tab">
                                <br>
                                <div class="row">
                                    <label for="espacio" class="control-label col-md-1"></label>
                                    <label for="menuname" class="control-label col-md-1">Contacto</label>
                                    <div class="form-group col-md-3">
                                        <input type="text" required class="form-control" id="txtContacto" name="contacto" maxlength="150" onKeyUp="this.value=this.value.toUpperCase();">
                                    </div>
                                    <label for="espacio" class="control-label col-md-1"></label>
                                    <label for="cbomenupadre" class="control-label col-md-1">Cargo</label>
                                    <div class="form-group col-md-3">
                                        <select class="form-control" id="cboCargo" name="cbocargo" style="width: 100%;">
                                            <option value="0">--Seleccione Cargo--</option>
                                            <?php foreach ($cargo as $fila) : ?>
                                                <option value="<?= $fila['Codigo'] ?>"><?= $fila['Descripcion'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <button type="button" class="btn btn-outline-success" id="btnContacto" data-toggle="tooltip" data-placement="top" title="agregar contacto" style="margin-bottom:10px"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="espacio" class="control-label col-md-1"></label>
                                    <label for="ext" class="control-label col-md-1">Ext</label>
                                    <div class="form-group col-md-3">
                                        <input type="text" required class="form-control" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" id="txtExt" name="ext" maxlength="10">
                                    </div>
                                    <label for="espacio" class="control-label col-md-1"></label>
                                    <label for="celular" class="control-label col-md-1">Celular</label>
                                    <div class="form-group col-md-3">
                                        <input id="txtCelular" name="iconome" type="tel" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" class="form-control" maxlength="10">
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="espacio" class="control-label col-md-1"></label>
                                    <label for="email" class="control-label col-md-1">Email 1</label>
                                    <div class="form-group col-md-3">
                                        <input type="text" required class="form-control" id="txtEmail1" maxlength="80" onKeyUp="this.value=this.value.toLowerCase();">
                                    </div>
                                    <label for="espacio" class="control-label col-md-1"></label>
                                    <label for="email" class="control-label col-md-1">Email 2</label>
                                    <div class="form-group col-md-3">
                                        <input id="txtEmail2" name="email" type="text" class="form-control" maxlength="80" onKeyUp="this.value=this.value.toLowerCase();">
                                    </div>
                                </div>
                                <br>
                                <br>
                                <br>
                                <div class="col-md-12 col-sm-12">
                                    <div class="col-md-1 col-sm-1">
                                    </div>
                                    <div class="col-md-10 col-sm-10">
                                        <form method="post" id="user_form">
                                            <div class="table-responsive">
                                                <table id="tblcontacto" class="table table-striped jambo_table table-condensed table-dark table-borderless" style="width: 100%;">
                                                    <thead class="text-center">
                                                        <tr>
                                                            <th style="display: none;">Id</th>
                                                            <th>Contacto</th>
                                                            <th>Cargo</th>
                                                            <th style="display: none;">CodigoCargo</th>
                                                            <th>Celular</th>
                                                            <th>Ext</th>
                                                            <th>Email</th>
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

                            <div class="tab-pane fade" id="producto" role="tabpanel" aria-labelledby="producto-tab">
                                <br>
                                <div class="row">
                                    <label for="espacio" class="control-label col-md-2"></label>
                                    <label for="producto" class="control-label col-md-1">Producto</label>
                                    <div class="form-group col-md-7">
                                        <input type="text" required class="form-control" id="txtProducto" name="producto" maxlength="150" onKeyUp="this.value=this.value.toUpperCase();">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <button type="button" class="btn btn-outline-success" id="btnProducto" data-toggle="tooltip" data-placement="top" title="agregar producto" style="margin-bottom:10px"><i class="fa fa-plus"></i></button>
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
                                                    <thead class="text-center">
                                                        <tr>
                                                            <th style="display: none;">Id</th>
                                                            <th>Producto</th>
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
                                <br>
                                <div class="col-md-12 col-sm-12">
                                    <div class="col-md-1 col-sm-1">
                                    </div>
                                    <div class="col-md-10 col-sm-10">
                                        <form method="post" id="user_form">
                                            <div class="table-responsive">
                                                <table id="tblcatalogo" class="table table-striped jambo_table table-condensed table-dark table-borderless" style="width: 100%;">
                                                    <thead class="text-center">
                                                        <tr>
                                                            <th style="display: none;">Id</th>
                                                            <th>Producto</th>
                                                            <th>Cod.Catalogo</th>
                                                            <th>Catalogo</th>
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

                            <div class="tab-pane fade" id="agencia" role="tabpanel" aria-labelledby="agencia-tab">
                                <br>
                                <div class="row">
                                    <label for="espacio" class="control-label col-md-1"></label>
                                    <label for="menuname" class="control-label col-md-1">Codigo</label>
                                    <div class="form-group col-md-3">
                                        <input type="text" required class="form-control" id="txtCodigoAge" name="codagencia" maxlength="10" onKeyUp="this.value=this.value.toUpperCase();">
                                    </div>
                                    <label for="espacio" class="control-label col-md-1"></label>
                                    <label for="cbomenupadre" class="control-label col-md-1">Agencia</label>
                                    <div class="form-group col-md-3">
                                        <input type="text" required class="form-control" id="txtAgencia" name="agencia" maxlength="250" onKeyUp="this.value=this.value.toUpperCase();">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <button type="button" class="btn btn-outline-success" id="btnAgencia" data-toggle="tooltip" data-placement="top" title="agregar agencia" style="margin-bottom:10px"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="espacio" class="control-label col-md-1"></label>
                                    <label for="menuname" class="control-label col-md-1">Sucursal</label>
                                    <div class="form-group col-md-3">
                                        <select class="form-control" id="cboSucursal" name="cbosucursal" style="width: 100%;">
                                            <option value="0">--Seleccione Sucursal--</option>
                                            <?php foreach ($sucursal as $fila) : ?>
                                                <option value="<?= $fila['Codigo'] ?>"><?= $fila['Descripcion'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <label for="espacio" class="control-label col-md-1"></label>
                                    <label for="cbomenupadre" class="control-label col-md-1">Zona</label>
                                    <div class="form-group col-md-3">
                                        <select class="form-control" id="cboZona" name="cbozona" style="width: 100%;">
                                            <option value="0">--Seleccione Zona--</option>
                                            <?php foreach ($zona as $fila) : ?>
                                                <option value="<?= $fila['Codigo'] ?>"><?= $fila['Descripcion'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="col-md-12 col-sm-12">
                                    <div class="col-md-1 col-sm-1">
                                    </div>
                                    <div class="col-md-10 col-sm-10">
                                        <form method="post" id="user_form">
                                            <div class="table-responsive">
                                                <table id="tblagencia" class="table table-striped jambo_table table-condensed table-dark table-borderless" style="width: 100%;">
                                                    <thead class="text-center">
                                                        <tr>
                                                            <th style="display: none;">Id</th>
                                                            <th>Agencia</th>
                                                            <th>Codigo</th>
                                                            <th>Sucursal</th>
                                                            <th>Zona</th>
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
                                <br>
                                <br>
                                <br>

                            </div>
                        </div>

                        <div class="container">
                            <div class='btn-group'>
                                <button class="btn btn-outline-primary" id="btnRegresar"><i class='fa fa-undo'></i> Regresar</button>
                                <button class="btn btn-outline-success ml-3" id="btnSave"><i class='fa fa-save'></i> Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
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
                    <div class="form-group">
                        <label for="contacto" class="col-form-label">Contacto</label>
                        <input type="text" id="txtContactoMo" required class="form-control" maxlength="150" onKeyUp="this.value=this.value.toUpperCase();">
                    </div>
                    <div class="form-group">
                        <label for="cbocargo" class="control-label">Cargo</label>
                        <select class="form-control" id="cboCargoMo" name="cboCargo1" style="width: 100%;">
                            <option value="0">--Seleccione Cargo--</option>
                            <?php foreach ($cargo as $fila) : ?>
                                <option value="<?= $fila['Codigo'] ?>"><?= $fila['Descripcion'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="valorv" class="col-form-label">Celular</label>
                        <input type="text" id="txtCelularMo" class="form-control" maxlength="10" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;">
                    </div>
                    <div class="form-group">
                        <label for="valori" class="col-form-label">Ext</label>
                        <input type="text" id="txtExtMo" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" class="form-control" maxlength="10">
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-form-label">Email</label>
                        <input type="text" id="txtEmail1Mo" required class="form-control" maxlength="80">
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
                        <label for="menuname" class="control-label col-md-2">Producto</label>
                        <input type="text" required class="form-control" id="txtProductoMo" name="catalogo" maxlength="80">
                    </div> -->
                    <div class="form-group">
                        <label for="menuname" class="control-label col-md-4">Codigo Catalogo</label>
                        <input type="text" required class="form-control" id="txtCodigoMo" name="catalogo" maxlength="10" onKeyUp="this.value=this.value.toUpperCase();">
                    </div>
                    <div class="form-group">
                        <label for="catalogo" class="control-label col-md-2">Catalogo</label>
                        <input id="txtCatalogoMo" name="txtcatalogo" type="text" class="form-control" maxlength="250" onKeyUp="this.value=this.value.toUpperCase();">
                    </div>
                    <!-- <div class="form-check" id="divcheck">
                        <input type="checkbox" id="chkEstado" class="form-check-input">
                        <label for="estadolabel" class="form-check-label" id="lblEstado">Activo</label>
                    </div> -->
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="row_id" id="hidden_row_id" />
                    <button type="button" id="btnAddCatalogo" class="btn btn-outline-info ml-3"><i class='fa fa-plus'></i> Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalAGENCIA" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 35%" role="document">
        <div class="modal-content" id="myModalBg">
            <div class="modal-header" id="headeragencia">
                <h5 class="modal-title" id="modalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formAgencia">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="agencia" class="control-label col-md-2">Agencia</label>
                        <input type="text" required class="form-control" id="txtAgenciaMo" name="agencia" maxlength="250" onKeyUp="this.value=this.value.toUpperCase();">
                    </div>
                    <div class="form-group">
                        <label for="codigo" class="control-label col-md-4">Codigo</label>
                        <input type="text" required class="form-control" id="txtCodigoAgeMo" name="codigo" maxlength="10" onKeyUp="this.value=this.value.toUpperCase();">
                    </div>
                    <div class="form-group">
                        <label for="cbosucursal" class="control-label">Sucursal</label>
                        <select class="form-control" id="cboSucursalMo" name="cboSucursal" style="width: 100%;">
                            <option value="0">--Seleccione Sucursal--</option>
                            <?php foreach ($sucursal as $fila) : ?>
                                <option value="<?= $fila['Codigo'] ?>"><?= $fila['Descripcion'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cbocargo" class="control-label">Zona</label>
                        <select class="form-control" id="cboZonaMo" name="cboZona" style="width: 100%;">
                            <option value="0">--Seleccione Zona--</option>
                            <?php foreach ($zona as $fila) : ?>
                                <option value="<?= $fila['Codigo'] ?>"><?= $fila['Descripcion'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-check" id="divcheck">
                        <input type="checkbox" id="chkEstadoAg" class="form-check-input">
                        <label for="estadolabel" class="form-check-label" id="lblEstadoAg">Activo</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="row_id" id="hidden_row_id" />
                    <button type="button" id="btnEditAgencia" class="btn btn-outline-info ml-3">Modificar</button>
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
                    <div class="form-group">
                        <label for="produc" class="control-label col-md-4">Producto</label>
                        <input type="text" required class="form-control" id="txtProductoMo" name="producto" maxlength="150" onKeyUp="this.value=this.value.toUpperCase();">
                    </div>
                    <div class="form-check" id="divcheck">
                        <input type="checkbox" id="chkEstadoPro" class="form-check-input">
                        <label for="estadolabel" class="form-check-label" id="lblEstadoPro">Activo</label>
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
                    <div class="form-group">
                        <label for="produc" class="control-label col-md-4">Cod.Catalogo</label>
                        <input type="text" required class="form-control" id="txtCodMo" name="producto" maxlength="10" onKeyUp="this.value=this.value.toUpperCase();">
                    </div>
                    <div class="form-group">
                        <label for="produc" class="control-label col-md-4">Catalogo</label>
                        <input type="text" required class="form-control" id="txtCatMo" name="producto" maxlength="250" onKeyUp="this.value=this.value.toUpperCase();">
                    </div>
                    <div class="form-check" id="divcheck">
                        <input type="checkbox" id="chkEstadoCat" class="form-check-input">
                        <label for="estadolabel" class="form-check-label" id="lblEstadoCat">Activo</label>
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