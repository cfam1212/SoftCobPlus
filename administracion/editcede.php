<?php

require_once '../dashmenu/panel_menu.php';

@session_start();

if (isset($_SESSION["s_usuario"])) {
    if ($_SESSION["s_login"] != "loged") {
        header("Location: ./logout.php");
        exit();
    } else {
    }
} else {
    header("Location: ./logout.php");
    exit();
}

$mensaje = (isset($_POST['mensaje'])) ? $_POST['mensaje'] : '';
$cedeid = (isset($_POST['id'])) ? $_POST['id'] : '';


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
$resultado->execute(array(43, $_SESSION["i_emprid"], '', '', '', '', '', '', $cedeid, 0, 0, 0, 0, 0));
$datacede = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(30, 0, '', '', '', '', '', '', $datacede[0]['CodigoPro'], 0, 0, 0, 0, 0));
$dataciudad = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(44, $_SESSION["i_emprid"], '', '', '', '', '', '', $cedeid, 0, 0, 0, 0, 0));
$cedecon = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(36, $_SESSION["i_emprid"], 'CARGOS', '', '', '', '', '', 0, 0, 0, 0, 0, 0));
$cargo = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(45, $_SESSION["i_emprid"], '', '', '', '', '', '', $cedeid, 0, 0, 0, 0, 0));
$producto = $resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="right_col" role="main">
    <input type="hidden" id="cedeid" value="<?php echo $cedeid ?>">
    <input type="hidden" id="mensaje" value="<?php echo $mensaje ?>">
    <input type="hidden" id="provid" value="<?php echo $datacede[0]['CodigoPro']; ?> ">
    <input type="hidden" id="ciudid" value="<?php echo $datacede[0]['CodigoCiu']; ?> ">
    <input type="hidden" id="nivelid" value="<?php echo $datacede[0]['Nivel']; ?> ">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Editar Cedente</h2>
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
                                <form class="form-horizontal col-md-10 offset-md-1" role="form">
                                    <fieldset>
                                        <br>
                                        <div class="form-group row">
                                            <label for="provincia" class="control-label col-md-2">Provincia:</label>
                                            <div class="col-md-4 col-sm-6 form-group">
                                                <select class="form-control" id="cboProvincia" name="cboprovincia">
                                                    <option value="0">--Seleccione Provincia--</option>
                                                    <?php foreach ($dataprov as $fila) : ?>
                                                        <option value="<?= $fila['Codigo'] ?>"><?= $fila['Descripcion'] ?>
                                                        </option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                            <label for="espacio" class="control-label col-md-1"></label>
                                            <label for="cuidad" class="control-label col-md-1">Cuidad:</label>
                                            <div class="col-md-4 col-sm-6 form-group">
                                                <select class="form-control" id="cboCiudad" name="cbociudad" style="width: 100%;">
                                                    <option value="0">--Seleccione Ciudad--</option>
                                                    <?php foreach ($dataciudad as $fila) : ?>
                                                        <option value="<?= $fila['Codigo'] ?>"><?= $fila['Descripcion'] ?>
                                                        </option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>

                                        </div>

                                        <div class="form-group row">
                                            <label for="espacio" class="control-label col-md-2">Cedente:</label>
                                            <div class="col-md-4 col-sm-6 form-group">
                                                <input autofocus type="text" class="form-control has-feedback-left" id="txtCedente" maxlength="150" value="<?php echo $datacede[0]['Cedente']; ?>">
                                                <span class="fa fa-pie-chart form-control-feedback left" aria-hidden="true"></span>
                                            </div>
                                            <label for="espacio" class="control-label col-md-1"></label>
                                            <label for="ruc" class="control-label col-md-1">Ruc:</label>
                                            <div class="col-md-4 col-sm-6 form-group">
                                                <input type="text" class="form-control has-feedback-left" id="txtRuc" maxlength="13" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" value="<?php echo $datacede[0]['Ruc']; ?>">
                                                <span class="fa fa-slack form-control-feedback left" aria-hidden="true"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="direccion" class="control-label col-md-2">Direccion:</label>
                                            <div class="form-group col-md-10 col-sm-6">
                                                <textarea name="direccion" id="txtDireccion" class="form-control" maxlength="200" onkeydown="return (event.keyCode!=13);" style="width: 100%;"><?php echo $datacede[0]['Direccion']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="fono1" class="control-label col-md-2">fono1:</label>
                                            <div class="col-md-4 col-sm-6  form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="txtTel1" maxlength="9" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" maxlength="15" value="<?php echo $datacede[0]['Telefono1']; ?>">
                                                <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                                            </div>
                                            <label for="espacio" class="control-label col-md-1"></label>
                                            <label for="fono2" class="control-label col-md-1">fono2:</label>
                                            <div class="col-md-4 col-sm-6  form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="txtTel2" maxlength="9" placeholder="ej: 022630922" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" maxlength="15" value="<?php echo $datacede[0]['Telefono2']; ?>">
                                                <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="espacio" class="control-label col-md-2">Fax</label>
                                            <div class="col-md-4 col-sm-6  form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="txtFax" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" name="fax" maxlength="10" value="<?php echo $datacede[0]['Fax']; ?>">
                                                <span class="fa fa-fax form-control-feedback left" aria-hidden="true"></span>
                                            </div>
                                            <label for="espacio" class="control-label col-md-1"></label>
                                            <label for="url" class="control-label col-md-1">Url:</label>
                                            <div class="col-md-4 col-sm-6  form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="txtUrl" maxlength="80" value="<?php echo $datacede[0]['Link']; ?>">
                                                <span class="fa fa-link form-control-feedback left" aria-hidden="true"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="arbol" class="control-label col-md-2">Nivel Arbol:</label>
                                            <div class="col-md-4 col-sm-6 form-group">
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
                                <div class="float-right">
                                    <button type="button" class="btn btn-outline-info ml-3 float-end" id="btnSave"><i class='fa fa-save'></i> Guardar</button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                <br />
                                <form class="form-horizontal col-md-10 offset-md-1" role="form">
                                    <label for="espacio" class="control-label col-md-1">Contacto:</label>
                                    <div class="form-group row">
                                        <div class="col-md-5 col-sm-8 form-group">
                                            <input type="tel" class="form-control has-feedback-left" id="txtContacto" class="form-control" placeholder="nombre del contacto" maxlength="150" autofocus>
                                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                        <label for="espacio" class="control-label col-md-1"></label>
                                        <label for="espacio" class="control-label col-md-1">Cargo: </label>
                                        <div class="form-group col-md-5">
                                            <select class="form-control" id="cboCargo" name="cbocargo" style="width: 100%;">
                                                <option value="0">--Seleccione Cargo--</option>
                                                <?php foreach ($cargo as $fila) : ?>
                                                    <option value="<?= $fila['Codigo'] ?>"><?= $fila['Descripcion'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>

                                    </div>
                                    <label for="espacio" class="control-label col-md-1">Telefono:</label>
                                    <div class="form-group row">
                                        <div class="col-md-5 col-sm-8 form-group">
                                            <input type="tel" class="form-control has-feedback-left" id="txtExt" placeholder="022222222" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" name="ext" maxlength="9">
                                            <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                        <label for="espacio" class="control-label col-md-1"></label>
                                        <label for="espacio" class="control-label col-md-1">Celular:</label>
                                        <div class="col-md-5 col-sm-8 form-group">
                                            <input type="tel" class="form-control has-feedback-left" id="txtCelular" placeholder="0999999999" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" class="form-control" maxlength="10">
                                            <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                    <label for="espacio" class="control-label col-md-1">email-1:</label>
                                    <div class="form-group row">
                                        <div class="col-md-5 col-sm-8 form-group">
                                            <input type="email" class="form-control has-feedback-left" id="txtEmail1" placeholder="e-mail" maxlength="80" onKeyUp="this.value=this.value.toLowerCase();">
                                            <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                        <label for="espacio" class="control-label col-md-1"></label>
                                        <label for="espacio" class="control-label col-md-1">email-2:</label>
                                        <div class="col-md-5 col-sm-8 form-group">
                                            <input type="email" class="form-control has-feedback-left" id="txtEmail2" placeholder="example@gmail.com" maxlength="80" onKeyUp="this.value=this.value.toLowerCase();">
                                            <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="form-group col-md-2">
                                            <button type="button" class="btn btn-outline-info" id="btnContacto" data-toggle="tooltip" data-placement="top" title="agregar contacto" style="margin-bottom:10px"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </form>
                                <br />
                                <div class="col-md-12">
                                    <form method="post" id="user_form">
                                        <div class="table-responsive">
                                            <table id="tblcontacto" class="table table-striped jambo_table table-condensed bulk_action table-borderless" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th style="width:5%;">Id</th>
                                                        <th style="width:10%;">Contacto</th>
                                                        <th style="width:40%; text-align: center">Cargo</th>
                                                        <th style="width:5%; display: none;">CodigoCargo</th>
                                                        <th style="width:10%; text-align: center">Celular</th>
                                                        <th style="width:10%;text-align: center">Telefono</th>
                                                        <th style="width:10%; text-align: center;">Email</th>
                                                        <th style="width:10%; display: none;">Email2</th>
                                                        <th style="width:5%; text-align: center">Opciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($cedecon as $dat) {
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $dat['Id']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $dat['Contacto']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $dat['Cargo']; ?>
                                                            </td>
                                                            <td style="display: none;">
                                                                <?php echo $dat['CodCargo']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $dat['Celular']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $dat['Extension']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $dat['Email1']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $dat['Email2']; ?>
                                                            </td>
                                                            <td>
                                                                <div class="text-center">
                                                                    <div class="btn-group">
                                                                        <button type="button" class="btn btn-outline-info btn-sm ml-2 btnEditConMo" data-toggle="tooltip" data-placement="top" title="editar" id="btnEdit"><i class="fa fa-pencil-square-o"></i></button>
                                                                        <button type="button" class="btn btn-outline-danger btn-sm ml-2" id="btnDelete"><i class="fa fa-trash-o"></i></button>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                                <form class="form-horizontal col-md-10 offset-md-2" role="form">
                                    <label for="espacio" class="control-label col-md-2">Producto:</label>
                                    <div class="row">
                                        <div class="col-md-10 col-sm-6 form-group">
                                            <input type="text" class="form-control has-feedback-left" id="txtProducto" placeholder="nombre del producto" maxlength="150">
                                            <span class="fa fa-briefcase form-control-feedback left" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                    <br />
                                    <label for="espacio" class="control-label col-md-2">Descripcion:</label>
                                    <div class="row">
                                        <div class="form-group col-md-10 col-sm-6">
                                            <textarea name="observa" id="txtDescripcion" class="form-control" maxlength="250" placeholder="ingrese descripcion" onkeydown="return (event.keyCode!=13);"></textarea>
                                        </div>
                                    </div>
                                    <dic class="row">
                                        <div class="form-group col-md-2">
                                            <button type="button" class="btn btn-outline-info" id="btnProducto" data-toggle="tooltip" data-placement="top" title="agregar producto" style="margin-bottom:10px"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </dic>
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
                                                        <th style="width:10% ; text-align: center">Estado</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($producto as $dat) {
                                                    ?>
                                                        <?php

                                                        $disabledit = '';
                                                        $disableaddcat = '';

                                                        if ($dat['Estado'] == 'Inactivo') {
                                                            $disabledit = 'disabled';
                                                            $disableaddcat = 'disabled';
                                                        } else {
                                                            $disabledit = '';
                                                            $disableaddcat = '';
                                                        }
                                                        ?>
                                                        <tr id="rowpro_<?php echo $dat['IdPro']; ?>">
                                                            <td style="display: none;">
                                                                <?php echo $dat['IdPro']; ?>
                                                                <input type="hidden" name="hidden_idpro[]" id="idpro" value="<?php echo $dat['IdPro']; ?>" />
                                                            </td>
                                                            <td>
                                                                <?php echo $dat['Producto']; ?>
                                                                <input type="hidden" name="hidden_producto[]" id="txtProducto<?php echo $dat['IdPro']; ?>" value="<?php echo $dat['Producto']; ?>" />
                                                            </td>
                                                            <td>
                                                                <?php echo $dat['Descripcion']; ?>
                                                                <input type="hidden" name="hidden_descripcion[]" id="txtDescripcion<?php echo $dat['IdPro']; ?>" value="<?php echo $dat['Descripcion']; ?>" />
                                                            </td>
                                                            <td>
                                                                <div class="text-center">
                                                                    <div class="btn-group">
                                                                        <button type="button" class="btn btn-outline-primary btn-sm ml-2 btnProCat" <?php echo $disableaddcat; ?> data-toggle="tooltip" data-placement="top" title="catalogos" id="btnProCat<?php echo $dat['IdPro']; ?>"><i class="fa fa-upload"></i></button>
                                                                        <button type="button" class="btn btn-outline-info btn-sm ml-2 btnEditPro" <?php echo $disabledit; ?> data-toggle="tooltip" data-placement="top" title="editar" id="btnEditPro<?php echo $dat['IdPro']; ?>"><i class="fa fa-pencil-square-o"></i></button>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td style="text-align: center">
                                                                <input type="checkbox" class="form-check-input chkEstadoPro" id="chk<?php echo $dat['IdPro']; ?>" name="check[]" <?php if ($dat['Estado'] == 'Activo') {
                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                    } else {
                                                                                                                                                                                        '';
                                                                                                                                                                                    } ?> value="<?php echo $dat['IdPro']; ?>" />
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </form>
                                </div>
                                <br />
                                <div class="col-md-10 offset-md-1">
                                    <form method="post" id="user_form">
                                        <div class="table-responsive">
                                            <table id="tblcatalogo" class="table table-striped jambo_table table-condensed bulk_action table-borderless" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th style="display: none;">Id</th>
                                                        <th>Producto</th>
                                                        <th>Cod.Catalogo</th>
                                                        <th>Catalogo</th>
                                                        <th style="text-align: center;">Opciones</th>
                                                        <th style="width:10% ; text-align: center">Estado</th>
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
                <div class='btn-group'>
                    <button type="button" class="btn btn-outline-secondary" id="btnRegresar"><i class='fa fa-undo'></i> Regresar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalEDITPRODUCTO" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 35%" role="document">
        <div class="modal-content" id="myModalBg">
            <div class="modal-header" id="headerpro">
                <h5 class="modal-titlepro" id="modalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formProducto">
                <div class="modal-body">
                    <label for="producto" class="col-form-label">Producto:</label>
                    <div class="row">
                        <div class="col-md-12 col-sm-6 form-group">
                            <input type="text" class="form-control has-feedback-left" id="txtProductoEdit" maxlength="80">
                            <span class="fa fa-briefcase form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <label for="detalleedit" class="col-form-label">Descripci??n:</label>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <textarea name="observa" id="txtDescripcionEdit" class="form-control" maxlength="250" onkeydown="return (event.keyCode!=13);"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="row_id" id="hidden_row_id" />
                    <button type="button" id="btnprodedit" class="btn btn-outline-info">Modificar</button>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalEDITCONTACTO" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="" role="document">
        <div class="modal-content" id="myModalBg">
            <div class="modal-header" id="headercon">
                <h5 class="modal-title" id="modalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formEditContacto">
                <div class="modal-body">
                    <div class="col-md-12">
                        <br/>
                        <div class="form-group row">
                            <label for="contacto" class="control-label col-md-1">Contacto:</label>
                            <div class="col-md-5 col-sm-9  form-group has-feedback">
                                <input type="tel" class="form-control has-feedback-left" id="txtContactoMo" placeholder="" maxlength="150">
                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <label for="cargo" class="control-label col-md-1">Cargo </label>
                            <div class="col-md-5 col-sm-9">
                                <select class="form-control" id="cboCargoMo" name="cboCargo1" style="width: 100%;">
                                    <option value="0">--Seleccione Cargo--</option>
                                    <?php foreach ($cargo as $fila) : ?>
                                        <option value="<?= $fila['Codigo'] ?>"><?= $fila['Descripcion'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <br/>
                        <div class="form-group row">
                            <label for="telefono" class="control-label col-md-1">Telefono:</label>
                            <div class="col-md-5 col-sm-9  form-group has-feedback">
                                <input type="tel" class="form-control has-feedback-left" id="txtExtMo" placeholder="" maxlength="9" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;">
                                <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <label for="celular" class="control-label col-md-1">Celular:</label>
                            <div class="col-md-5 col-sm-9  form-group has-feedback">
                                <input type="tel" class="form-control has-feedback-left" id="txtCelularMo" placeholder="" maxlength="10" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;">
                                <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        </div>
                        <br/>
                        <div class="form-group row">
                            <label for="email1" class="control-label col-md-1">Email1:</label>
                            <div class="col-md-5 col-sm-9  form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" id="txtEmail1Mo" placeholder="" maxlength="80">
                                <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <label for="email2" class="control-label col-md-1">Email2:</label>
                            <div class="col-md-5 col-sm-9  form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" id="txtEmail2Mo" placeholder="" maxlength="80">
                                <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <input type="hidden" name="conid" id="conid">
                <button type="button" id="btnEditarCon" class="btn btn-outline-info"> Modificar</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalCATALOGOEDIT" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 35%" role="document">
        <div class="modal-content" id="myModalBg">
            <div class="modal-header" id="headercat">
                <h5 class="modal-title" id="modalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formCatalogoEdit">
                <div class="modal-body">
                    <br />
                    <div class="row">
                        <label for="codigo" class="control-label col-md-2">Codigo:</label>
                        <div class="col-md-8 col-sm-8  form-group has-feedback">
                            <input type="tel" class="form-control has-feedback-left" id="txtCodigoMo" placeholder="0" maxlength="10" onKeyUp="this.value=this.value.toUpperCase();">
                            <span class="fa fa-slack form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="row">
                        <label for="catalogo" class="control-label col-md-2">Catalogo:</label>
                        <div class="col-md-8 col-sm-8  form-group has-feedback">
                            <input type="text" class="form-control has-feedback-left" id="txtCatalogoMo" placeholder="nombre del catalogo" maxlength="250">
                            <span class="fa fa-file-text form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="row_id" id="hidden_row_id" />
                    <button type="button" id="btnAddCatalogo" class="btn btn-outline-primary"><i class='fa fa-plus-circle'></i> Agregar</button>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalEDITCATALOGO" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 35%" role="document">
        <div class="modal-content" id="myModalBg">
            <div class="modal-header" id="headercatalogo">
                <h5 class="modal-titlecat" id="modalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formEdit">
                <div class="modal-body">
                    <br />
                    <div class="row">
                        <label for="codigo" class="control-label col-md-2">Codigo:</label>
                        <div class="col-md-8 col-sm-8  form-group has-feedback">
                            <input type="tel" readonly class="form-control has-feedback-left" id="txtCodigo" placeholder="codigo" maxlength="10">
                            <span class="fa fa-slack form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="row">
                        <label for="catalogo" class="control-label col-md-2">Catalogo:</label>
                        <div class="col-md-8 col-sm-8  form-group has-feedback">
                            <input type="text" class="form-control has-feedback-left" id="txtCatalogo" placeholder="nombre del catalogo" maxlength="250">
                            <span class="fa fa-file-text form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="row_id" id="hidden_row_id" />
                    <button type="button" id="btnEditCatalogo" class="btn btn-outline-info"><i class='fa fa-plus'></i></button>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php require_once '../dashmenu/panel_footer.php'; ?>
<script src="../codejs/editcede.js" type="text/javascript"></script>

</body>

</html>