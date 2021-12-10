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

                    <button type="button" class="btn btn-outline-success" id="btnNuevo" data-toggle="tooltip" data-placement="top" title="nuevo departamento" style="margin-bottom:10px"><i class="fa fa-plus"></i></button>

                    <div class="x_content">
                        <br />
                        <table id="tabledata" class="table table-striped jambo_table bulk_action table-info" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Departamento</th>
                                    <th>Estado</th>
                                    <th style="text-align: center;">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data as $datos) {
                                ?>
                                    <?php
                                    if ($datos['Depaid'] == '1') {
                                        $disabledel = 'disabled="disabled"';
                                    } else {
                                        $disabledel = '';
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $datos['Depaid'] ?></td>
                                        <td><?php echo $datos['Departamento'] ?></td>
                                        <td><?php echo $datos['Estado'] ?></td>
                                        <td>
                                            <div class="text-center">
                                                <div class="btn-group">
                                                    <button class="btn btn-outline-info btn-sm ml-3" id="btnEditar" data-toggle="tooltip" data-placement="top" title="editar">
                                                        <i class="fa fa-pencil-square-o"></i></button>
                                                    <button class="btn btn-outline-danger btn-sm ml-3" <?php echo $disabledel ?> id="btnEliminar" data-toggle="tooltip" data-placement="top" title="eliminar">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                </div>
                                            </div>
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
<div class="modal fade" id="modalTAREA" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="myModalBg">
            <div class="modal-header" id="header">
                <h5 class="modal-title" id="modalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formTarea">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tarea" class="col-form-label">Departamento:</label>
                        <input type="text" required class="form-control" id="txtDepa" maxlength="80">
                    </div>

                    <div class="form-check" id="divcheck">
                        <input type="checkbox" class="form-check-input" id="chkEstado">
                        <label for="estadolabel" class="form-check-label" id="lblEstado">Activo</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success ml-3" id="btnSave"><i class='fa fa-save'></i> Guardar</button>
                    <!-- <button class="btn btn-outline-danger" data-dismiss="modal"><i class='fa fa-close'></i></button>                   -->
                </div>
            </form>
        </div>
    </div>
</div>
<?php require_once '../dashmenu/panel_footer.php'; ?>
<script src="../codejs/departamento.js" type="text/javascript"></script>
</body>

</html>