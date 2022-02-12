<?php

require_once '../dashmenu/panel_menu.php';

$mensaje = (isset($_POST['mensaje'])) ? $_POST['mensaje'] : '';

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(28, $_SESSION["i_emprid"], '', '', '', '', '', '', 0, 0, 0, 0, 0, 0));
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

?>

<input type="hidden" id="mensaje" value="<?php echo $mensaje ?>">

<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>CEDENTES</h2>
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
                    <div class="accordion" id="accordion1" role="tablist" aria-multiselectable="true">
                        <div class="panel">
                            <a class="panel-heading" role="tab" id="headingOne1" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne1" aria-expanded="true" aria-controls="collapseOne">
                                <h4 class="panel-title">Datos Cedente</h4>
                            </a>
                            <div id="collapseOne1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <div class="row">
                                        <label for="espacio" class="control-label col-md-1"></label>
                                        <label for="cboprovincia" class="control-label col-md-1">Provincia</label>
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
                                        <label for="cbocuidad" class="control-label col-md-1">Cuidad</label>
                                        <div class="form-group col-md-3">
                                            <select class="form-control" id="cboCiudad" name="cbociudad" style="width: 100%;">
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
                                </div>
                            </div>
                        </div>
                        <div class="panel">
                            <a class="panel-heading collapsed" role="tab" id="headingTwo1" data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo1" aria-expanded="false" aria-controls="collapseTwo">
                                <h4 class="panel-title">Contactos</h4>
                            </a>
                            <div id="collapseTwo1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    <br/>
                                    <form class="form-label-left input_mask">
                                        <div class="col-md-6 col-sm-6  form-group has-feedback">
                                            <input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="First Name">
                                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                        </div>

                                        <div class="col-md-6 col-sm-6  form-group has-feedback">
                                            <input type="text" class="form-control" id="inputSuccess3" placeholder="Last Name">
                                            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                        </div>

                                        <div class="col-md-6 col-sm-6  form-group has-feedback">
                                            <input type="email" class="form-control has-feedback-left" id="inputSuccess4" placeholder="Email">
                                            <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                                        </div>

                                        <div class="col-md-6 col-sm-6  form-group has-feedback">
                                            <input type="tel" class="form-control" id="inputSuccess5" placeholder="Phone">
                                            <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="panel">
                            <a class="panel-heading collapsed" role="tab" id="headingThree1" data-toggle="collapse" data-parent="#accordion1" href="#collapseThree1" aria-expanded="false" aria-controls="collapseThree">
                                <h4 class="panel-title">Agencias</h4>
                            </a>
                            <div id="collapseThree1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
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
                                        <button type="button" class="btn btn-outline-info" id="btnAgencia" data-toggle="tooltip" data-placement="top" title="agregar agencia" style="margin-bottom:10px"><i class="fa fa-plus"></i></button>
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end of accordion -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-info ml-3" id="btnSave"><i class='fa fa-save'></i> Guardar</button>
            </div>
        </div>
    </div>
</div>

<?php require_once '../dashmenu/panel_footer.php'; ?>
<script src="../codejs/cedente.js" type="text/javascript"></script>

</body>

</html>