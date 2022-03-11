<?php

require_once '../dashmenu/panel_menu.php';

$consulta = "CALL sp_New_Departamento(?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(0, $_SESSION["i_emprid"], '', '', '', '', '', 0, 0, 0, 0, 0, ''));
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Departamentos</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <button type="button" class="btn btn-outline-info" id="btnNuevo" data-toggle="tooltip" data-placement="top" title="nuevo departamento" style="margin-bottom:10px"><i class="fa fa-plus"></i></button>

                    <div class="x_content">
                        <br />
                        <table id="tabledatadepa" class="table table-striped jambo_table bulk_action table-dark table-borderless" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Departamento</th>
                                    <th style="width:13% ; text-align: center">Opciones</th>
                                    <th style="width:10% ; text-align: center">Estado</th>
                                    <th style="display: none;">EstadoOculto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data as $datos) {
                                ?>
                                    <?php
                                    $disabledel = '';
                                    $disableedit = '';
                                    $chkestado = '';

                                    if ($datos['Depaid'] == '1') {
                                        $disabledel = 'disabled';
                                        $disableedit = 'disabled';
                                        $chkestado = 'disabled';
                                    }

                                    if ($datos['Depaid'] != '1' && $datos['Estado'] == 'Inactivo') {

                                        $disableedit = 'disabled';
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $datos['Depaid'] ?></td>
                                        <td><?php echo $datos['Departamento'] ?></td>
                                        <td>
                                            <div class="text-center">
                                                <div class="btn-group">
                                                    <button class="btn btn-outline-info btn-sm ml-2 btnEditar" <?php echo $disableedit; ?> id="btnEditar<?php echo $datos['Depaid']; ?>" data-toggle="tooltip" data-placement="top" title="editar">
                                                        <i class="fa fa-pencil-square-o"></i></button>
                                                    <button class="btn btn-outline-danger btn-sm ml-2" <?php echo $disabledel; ?> id="btnEliminar">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="text-align: center">
                                            <input type="checkbox" class="form-check-input chkEstadoDe" <?php echo $chkestado; ?> id="chk<?php echo $datos['Depaid']; ?>" name="check[]" <?php if ($datos['Estado'] == 'Activo') {
                                               echo "checked";  } else {''; } ?> value="<?php echo $datos['Depaid']; ?>" />                                                                                                                                                                                                                                                                                                                                                                                                                                               
                                        </td>
                                        <td style="display: none;" id="tdestado<?php echo $datos['Depaid']; ?>">
                                            <?php echo $datos['Estado'] ?>
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
<div class="modal fade" id="modalDEPARTAMENTO" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="myModalBg">
            <div class="modal-header" id="header">
                <h5 class="modal-title" id="modalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formDepartamento">
                <div class="modal-body">
                    <label for="menuname" class="control-label">Departamento:</label>
                    <div class="row">
                        <div class="col-md-12 col-sm-12  form-group has-feedback">
                            <input type="tel" class="form-control has-feedback-left" id="txtDepa" maxlength="80" autocomplete="off">
                            <span class="fa fa-home form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-info ml-3" id="btnSave"><i class='fa fa-save'></i> Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require_once '../dashmenu/panel_footer.php'; ?>
<script src="../codejs/departamento.js" type="text/javascript"></script>
</body>

</html>