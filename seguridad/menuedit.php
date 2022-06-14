<?php

require_once '../dashmenu/panel_menu.php';

$mensaje = (isset($_POST['mensaje'])) ? $_POST['mensaje'] : '';
$menuid = (isset($_POST['id'])) ? $_POST['id'] : '';

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(5, $_SESSION["i_emprid"], '', '', '', '', '', '', $menuid, 0, 0, 0, 0, 0));
$datamenu = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(4, $_SESSION["i_emprid"], '', '', '', '', '', '', $menuid, 0, 0, 0, 0, 0));
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(2, $_SESSION["i_emprid"], '', '', '', '', '', '', 0, 0, 0, 0, 0, 0));
$menump = $resultado->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="right_col" role="main">
    <div class="clearfix"></div>
    <div class="row">
        <input type="hidden" id="menuid" value="<?php echo $menuid ?>">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Editar Menu</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form class="form-horizontal" role="form">
                        <fieldset>
                            <div class="form-group row">
                                    <label for="espacio" class="control-label col-md-1"></label>
                                    <label for="menuname" class="control-label col-md-1">Menu:</label>
                                    <label for="espacio" class="control-label col-md-5"></label>
                                    <label for="menuname" class="control-label col-md-1">Icono Menu:</label>
                            </div>
                            <div class="form-group row">
                                <label for="espacio" class="control-label col-md-1"></label>
                                <div class="col-md-4 col-sm-4  form-group has-feedback">
                                    <input type="tel" class="form-control has-feedback-left" id="txtMenuname" value="<?php echo $datamenu[0]['Menu'] ?>">
                                    <span class="fa fa-bars form-control-feedback left" aria-hidden="true"></span>
                                </div>
                                <label for="espacio" class="control-label col-md-2"></label>
                                <div class="col-md-4 col-sm-4  form-group has-feedback">
                                    <input type="tel" class="form-control has-feedback-left" id="txtIconome" value="<?php echo $datamenu[0]['Icono'] ?>">
                                    <span class="fa fa-smile-o form-control-feedback left" aria-hidden="true"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="espacio" class="control-label col-md-1"></label>
                                <label for="cbomenupadre" class="control-label col-md-2">Menu Padre:</label>
                            </div>
                            <div class="form-group row">
                                <label for="espacio" class="control-label col-md-1"></label>
                                <select name="cbomenupadre" id="cboMenupadre" class="form-control col-md-4">
                                    <?php foreach ($menump as $fila) : ?>
                                        <option <?php if ($datamenu[0]['CodMenuPadre'] == $fila['Codigo']) { ?> selected="<?php echo $fila['Codigo']; ?>" <?php } ?> value="<?= $fila['Codigo'] ?>"><?= $fila['MenuPadre'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <br/>
                            <div id="divmp" class="form-group row" style="display:none">
                                <label for="menump" class="control-label col-md-2">Nombre Menú Padre:</label>
                                <input type="text" name="menump" id="txtMenump" class="form-control col-md-4" placeholder="Menú Padre">
                                <label for="iconomp" class="control-label col-md-2">Icono Menú Padre:</label>
                                <input type="text" name="iconomp" id="txtIconomp" class="form-control col-md-4" placeholder="ej.: fa fa-user" value="<?php echo $datamenu[0]['IconoPadre']; ?>">
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
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
                        <br />
                        <table id="tableconorder" class="table table-striped jambo_table bulk_action table-borderless" style="width: 100%;">
                            <thead class="text-center">
                                <tr>
                                    <th>Id</th>
                                    <th>Check</th>
                                    <th>Seleccionar</th>
                                    <th>Tarea</th>
                                    <th>Ruta</th>
                                    <th style="display: none;">Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data as $dat) {
                                ?>
                                    <tr>
                                        <td><?php echo $dat['TareaId']; ?></td>
                                        <td><?php echo $dat['Ckeck']; ?></td>
                                        <td style="text-align: center">
                                            <input type="checkbox" id="chkTarea" name="check[]" <?php if ($dat['Ckeck'] == 'SI') {
                                                echo "checked='checked'"; } ?> value="<?php echo $dat['TareaId']; ?>" />                                                 
                                        </td>
                                        <td><?php echo $dat['Tarea']; ?></td>
                                        <td><?php echo $dat['Ruta']; ?></td>
                                        <td style="display: none;"><?php echo $dat['Estado']; ?></td>
                                        <td></td>
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
<?php require_once '../dashmenu/panel_footer.php'; ?>
<script src="../codejs/menuedit.js" type="text/javascript"></script>
<script src="../vendors/select2/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#cboMenupadre').select2();
    });

    $(document).ready(function() {
        $("#cboMenupadre").change(function() {
            $('#menump').val('');
            $opcionmp = $.trim($("#cboMenupadre").val());
            document.getElementById("divmp").style.display = "none";
            if ($opcionmp == 2) {
                document.getElementById("divmp").style.display = "";
            }
        });
    });
</script>

</body>

</html>