<?php

require_once '../dashmenu/panel_menu.php';

$mensaje = (isset($_POST['mensaje'])) ? $_POST['mensaje'] : '';

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(0, $_SESSION["i_emprid"], '', '', '', '', '', '', 0, 0, 0, 0, 0, 0));
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(2, $_SESSION["i_emprid"], '', '', '', '', '', '', 0, 0, 0, 0, 0, 0));
$menump = $resultado->fetchAll(PDO::FETCH_ASSOC);

?>

<input type="hidden" id="mensaje" value="<?php echo $mensaje ?>">

<div class="right_col" role="main">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Nuevo Menu</h2>
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
                                <label for="menuname" class="control-label col-md-1">Menu:</label>
                                <label for="espacio" class="control-label col-md-5"></label>
                                <label for="menuname" class="control-label col-md-1">Icono Menu:</label>
                            </div>
                            <div class="form-group row">
                                <label for="espacio" class="control-label col-md-1"></label>
                                <div class="col-md-4 col-sm-4 form-group has-feedback">
                                    <input type="text" class="form-control has-feedback-left" id="txtmenuname" placeholder="Nombre del Menu" autofocus>
                                    <span class="fa fa-bars form-control-feedback left" aria-hidden="true"></span>
                                </div>
                                <label for="espacio" class="control-label col-md-2"></label>
                                <div class="col-md-4 col-sm-4 form-group has-feedback">
                                    <input type="text" class="form-control has-feedback-left" id="txticonome" placeholder="Icono Menu">
                                    <span class="fa fa-smile-o form-control-feedback left" aria-hidden="true"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="espacio" class="control-label col-md-1"></label>
                                <label for="cbomenupadre" class="control-label col-md-1">Menu Padre:</label>
                            </div>
                            <div class="form-group row">
                                <label for="espacio" class="control-label col-md-1"></label>
                                <select id="cbomenupadre" class="form-control col-md-4">
                                    <?php foreach ($menump as $fila) : ?>
                                        <option value="<?= $fila['Codigo'] ?>"><?= $fila['MenuPadre'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="form-group col-md-6" id="divmp" style="display:none">
                                    <label for="menump" class="control-label">Nombre Menú Padre:</label>
                                    <input id="txtmenump" name="menump" type="text" placeholder="Menú Padre" class="form-control">
                                </div>

                                <div class="form-group col-md-6" id="divip" style="display:none">
                                    <label for="iconomp" class="control-label">Icono Menú Padre:</label>
                                    <input id="txtsiconomp" name="iconomp" type="text" placeholder="ej.: fas fa-user" class="form-control">
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Asignar Tarea</h2>
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
                                    <th>Tarea</th>
                                    <th>Ruta</th>
                                    <th style="display: none;">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data as $dat) {
                                ?>
                                    <tr>
                                        <td><?php echo $dat['TareaId']; ?></td>
                                        <td style="text-align: center">
                                            <input type="checkbox" id="recs" name="check[]" value="<?php echo $dat['TareaId']; ?>" />
                                        </td>
                                        <td><?php echo $dat['Tarea']; ?></td>
                                        <td><?php echo $dat['Ruta']; ?></td>
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
            <button class="btn btn-outline-secondary" id="btnRegresar"><i class='fa fa-undo'> Regresar</i></button>
            <button class="btn btn-outline-info ml-3" id="btnSave"><i class='fa fa-save'></i> Guardar</button>
        </div>
    </div>
</div>
</div>

<?php require_once '../dashmenu/panel_footer.php'; ?>
<script src="../codejs/menu.js" type="text/javascript"></script>
<!-- <script src="../vendors/select2/js/select2.min.js"></script> -->

<script>
    $(document).ready(function() {
        $('#cbomenupadre').select2();
    });

    $(document).ready(function() {
        $("#cbomenupadre").change(function() {
            $('#menump').val('');
            $opcionmp = $.trim($("#cbomenupadre").val());
            document.getElementById("divmp").style.display = "none";
            document.getElementById("divip").style.display = "none";
            if ($opcionmp == 2) {
                document.getElementById("divmp").style.display = "block";
                document.getElementById("divip").style.display = "block";
            }
        });
    });
</script>

</body>

</html>