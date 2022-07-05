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

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(17, $_SESSION["i_emprid"], '', '', '', '', '', '', 0, 0, 0, 0, 0, 0));
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(19, $_SESSION["i_emprid"], '', '', '', '', '', '', 0, 0, 0, 0, 0, 0));
$cboperfil = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "CALL sp_New_Departamento(?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(5, $_SESSION["i_emprid"], '', '', '', '', '', 0, 0, 0, '', 0, ''));
$cbodepa = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(36, 0, 'TIPO USUARIOS', '--Seleccione Tipo Usuario--', '', '', '', '', 0, 0, 0, 0, 0, 0));
$cbotipouser = $resultado->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Registro de Usuarios</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up fa-1x"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <button type="button" class="btn btn-outline-info" id="btnNuevo" data-toggle="tooltip" data-placement="top" title="nuevo usuario" style="margin-bottom:10px"><i class="fa fa-plus"></i></button>

                    <div class="x_content">
                        <br />
                        <table id="tabledata" class="table table-striped jambo_table bulk_action table-borderless" style="width: 100%;">

                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Usuario</th>
                                    <th>Login</th>
                                    <th>Perfil</th>
                                    <th style="width:13% ; text-align: center">Opciones</th>
                                    <th style="width:10% ; text-align: center">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data as $dat) {
                                ?>
                                    <?php

                                    $disabledel = '';
                                    $disabledit = '';
                                    $chkestado = '';

                                    if ($dat['UserId'] == '1') {
                                        $disabledel = 'disabled';
                                        $disabledit = 'disabled';
                                        $chkestado = 'disabled';
                                    }

                                    if ($dat['UserId'] != '1' && $dat['Estado'] == 'Inactivo') {

                                        $disabledit = 'disabled';
                                    }

                                    ?>
                                    <tr>
                                        <td><?php echo $dat['UserId'] ?></td>
                                        <td><?php echo $dat['Usuario'] ?></td>
                                        <td><?php echo $dat['Namelogin'] ?></td>
                                        <td><?php echo $dat['Perfil'] ?></td>
                                        <td>
                                            <div class="text-center">
                                                <div class="btn-group">
                                                    <button class="btn btn-outline-info btn-sm ml-2 btnEditar" <?php echo $disabledit ?> id="btnEditar<?php echo $dat['UserId']; ?>" data-toggle="tooltip" data-placement="top" title="editar">
                                                        <i class="fa fa-pencil-square-o"></i></button>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="text-align: center">
                                            <input type="checkbox" class="form-check-input chkEstadoUs" <?php echo $chkestado; ?> id="chk<?php echo $dat['UserId']; ?>" name="check[]" <?php if ($dat['Estado'] == 'Activo') {
                                                                                                                                                                                            echo "checked";
                                                                                                                                                                                        } else {
                                                                                                                                                                                            '';
                                                                                                                                                                                        } ?> value="<?php echo $dat['UserId']; ?>" />
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
<div class="modal fade" id="modalNewUser" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="myModalBg">
            <div class="modal-header" id="header">
                <h5 class="modal-title" id="modalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>                
            </div>
            <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" id="frmUserNew">
                <br />
                <div class="modal-body">
                  <div class="x_content">
                    <div class="form-group row">
                        <label for="nombre" class="control-label col-md-1">Nombre:</label>
                        <label for="espacio" class="control-label col-md-3"></label>
                        <label for="menuname" class="control-label col-md-1">Apellido:</label>
                        <label for="espacio" class="control-label col-md-3"></label>
                        <label for="menuname" class="control-label col-md-1">Login:</label>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 col-sm-4 form-group has-feedback">
                            <input type="text" class="form-control has-feedback-left" id="txtUsername" placeholder="nombre usuario" maxlength="80" autofocus>
                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-4 col-sm-4 form-group has-feedback">
                            <input type="text" class="form-control has-feedback-left" id="txtLastname" placeholder="apellido usuario" maxlength="80">
                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-4 col-sm-4 form-group has-feedback">
                            <input type="text" class="form-control has-feedback-left" id="txtLogin" placeholder="login" maxlength="16" onKeyUp="this.value=this.value.toLowerCase();" autocomplete="off">
                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <br />
                    <div class="form-group row">
                        <label for="nombre" class="control-label col-md-1">Password:</label>
                        <label for="espacio" class="control-label col-md-3"></label>
                        <label for="menuname" class="control-label col-md-2">Perfil Usuario:</label>
                        <label for="espacio" class="control-label col-md-2"></label>
                        <label for="menuname" class="control-label col-md-2">Tipo Usuario:</label>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 col-sm-4 form-group has-feedback">
                            <input type="password" class="form-control has-feedback-left" id="txtPassword" placeholder="password" maxlength="50" autocomplete="off">
                            <span class="fa fa-eye-slash form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <select class="form-control col-md-4" id="cboPerfil" name="cboperfil" style="width: 100%;">
                                <?php
                                foreach ($cboperfil as $fila) {
                                    echo '<option value="' . $fila['Codigo'] . '">' . $fila['Descripcion'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <select class="form-control col-md-4" id="cboTipoUser" name="cbotipouser" style="width: 100%;">
                                <?php foreach ($cbotipouser as $fila) { ?>
                                    <option value="<?= $fila['Codigo'] ?>"><?= $fila['Descripcion'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <br />
                    <div class="form-group row">
                        <label for="usuario" class="control-label col-md-4">Departamento Usuario:</label>
                        <label for="usuario" class="control-label col-md-2">Cambiar Password:</label>
                        <label for="usuario" class="control-label col-md-3">Password Caduca:</label>
                        <label for="usuario" class="control-label col-md-2">Fecha Caduca:</label>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 col-sm-4">
                            <select class="form-control col-md-4" id="cboDepa" name="cbodepa" style="width: 100%;">
                                <?php foreach ($cbodepa as $fila) : ?>
                                    <option value="<?= $fila['Codigo'] ?>"><?= $fila['Descripcion'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="checkbox col-md-2">
                            <input type="checkbox" id="chkCambiar">
                            <label class="form-check-label" id="lblCambiar">NO</label>
                        </div>
                        <div class="checkbox col-md-2">
                            <input type="checkbox" id="chkCaduca">
                            <label class="form-check-label" id="lblCaduca">NO</label>
                        </div>
                        <input type="text" class="form-control col-md-4" id="txtFechacaduca" maxlength="50" disabled placeholder="MM/dd/yyyy ">
                    </div>
                    <br />
                    <div class="form-group row">
                        <label for="espacio" class="control-label col-md-1"></label>
                        <input type="file" accept="image/*" id="txtImagen" name="imagen">
                        <div class="col-md-4">
                            <div class="card shadow">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Imagen</h6>
                                </div>
                                <div class="card-body">
                                    <div class="text-center" id="image-preview">
                                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 10rem;" src="../images/sin-user.png">
                                    </div>
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
            </form>
        </div>
    </div>
</div>

<?php require_once '../dashmenu/panel_footer.php'; ?>
<script src="../codejs/usuarios.js" type="text/javascript"></script>

</body>

</html>