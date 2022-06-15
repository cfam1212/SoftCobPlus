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

$idperfil = (isset($_POST['idperfil'])) ? $_POST['idperfil'] : '0';

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(16, $_SESSION["i_emprid"], '', '', '', '', '', '', $idperfil, 0, 0, 0, 0, 0));
$datos = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(13, $_SESSION["i_emprid"], '', '', '', '', '', '', $idperfil, 0, 0, 0, 0, 0));
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

?>
<input type="hidden" id="mensaje">
<div class="right_col" role="main">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Editar Perfil</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br/>
                    <form class="form-horizontal" role="form">
                        <fieldset>
                            <div class="form-group row">
                                <label for="espacio" class="control-label col-md-1"></label>
                                <label for="menuname" class="control-label col-md-1">Perfil:</label>
                                <label for="espacio" class="control-label col-md-4"></label>
                                <label for="menuname" class="control-label col-md-1">Descripcion:</label>
                            </div>
                            <div class="form-group row">
                                <label for="espacio" class="control-label col-md-1"></label>
                                <div class="col-md-4 col-sm-4  form-group has-feedback">
                                    <input type="tel" class="form-control has-feedback-left" id="txtPerfil" maxlength="80" placeholder="Nombre del Perfil" value="<?php echo $datos[0]['Perfil'] ?>">
                                    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                </div>
                                <label for="espacio" class="control-label col-md-1"></label>
                                <div class="col-md-5 col-sm-5 form-group">
                                    <textarea name="descrip" id="txtDescripcion" class="form-control" maxlength="255" onkeydown="return (event.keyCode!=13);"><?php echo $datos[0]['Observacion'] ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="espacio" class="control-label col-md-1"></label>
                                <label for="menuname" class="control-label col-md-2">Crear Parámetro:</label>
                                <label for="espacio" class="control-label col-md-3"></label>
                                <label for="menuname" class="control-label col-md-2">Modificar Parámetro:</label>
                            </div>
                            <div class="form-group row">
                                <label for="espacio" class="control-label col-md-1"></label>
                                <div class="checkbox col-md-4">
                                    <input type="checkbox" id="chkCrear"></input>
                                    <label class="form-check-label" id="lblCrear"><?php echo $datos[0]['Crear'] ?></label>
                                </div>
                                <label for="espacio" class="control-label col-md-1"></label>
                                <div class="checkbox col-md-4">
                                    <input type="checkbox" id="chkModificar"></input>
                                    <label class="form-check-label" id="lblModificar"><?php echo $datos[0]['Modificar'] ?></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="espacio" class="control-label col-md-1"></label>
                                <label for="menuname" class="control-label col-md-2">Eliminar Parámetro:</label>
                                <label for="espacio" class="control-label col-md-3"></label>
                            </div>
                            <div class="form-group row">
                                <label for="espacio" class="control-label col-md-1"></label>
                                <div class="checkbox col-md-4">
                                    <input type="checkbox" id="chkEliminar"></input>
                                    <label class="form-check-label" id="lblEliminar"><?php echo $datos[0]['Eliminar'] ?></label>
                                </div>
                                <div class="form-group col-md-2" style="display:none">
                                    <input id="idPerfil" name="perfid" type="text" class="form-control" value="<?php echo $idperfil ?>">
                                </div>
                            </div>
                        </fieldset>
                    </form>
                    <br/>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Opciones Menu</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br/>
                        <table id="tabledata" class="table table-striped jambo_table bulk_action table-borderless" style="width: 100%;">
                            <thead class="text-center">
                                <tr>
                                    <th>Id</th>
                                    <th>Seleccionar</th>
                                    <th>Menú</th>
                                    <th>Tarea</th>
                                    <th style="display: none;">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data as $dat) {
                                ?>
                                    <tr>
                                        <td><?php echo $dat['MentId']; ?></td>
                                        <td style="text-align: center">
                                            <input type="checkbox" id="recs" name="check[]" <?php if ($dat['Ckeck'] == 'SI') {
                                                echo "checked='checked'";   } ?> value="<?php echo $dat['MentId']; ?>" />                                              
                                        </td>
                                        <td><?php echo $dat['Menu']; ?></td>
                                        <td><?php echo $dat['Tarea']; ?></td>
                                        <td style="display: none;"><?php echo $dat['Estado']; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class='btn-group'>
            <button class="btn btn-outline-secondary" id="btnRegresar"><i class='fa fa-undo'></i> Regresar</button>
            <button class="btn btn-outline-info ml-3" id="btnSave"><i class='fa fa-save'></i> Guardar</button>
        </div>
    </div>
</div>
</div>


<?php require_once '../dashmenu/panel_footer.php'; ?>
<script src="../codejs/perfiledit.js" type="text/javascript"></script>

</body>

</html>