<?php

require_once '../dashmenu/panel_menu.php';

$mensaje = (isset($_POST['mensaje'])) ? $_POST['mensaje'] : '';

$consulta = "CALL sp_consulta_datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(31, 0, '', '', '', '', '', '', 0, 0, 0, 0, 0, 0));
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="right_col" role="main">
    <input type="hidden" id="mensaje" value="<?php echo $mensaje ?>">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Registro de Parámetros</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <button type="button" class="btn btn-outline-info" id="btnNuevo" data-toggle="tooltip" data-placement="top" title="nuevo parametro" style="margin-bottom:10px"><i class="fa fa-plus"></i></button>

                    <div class="x_content">
                        <br />
                        <table id="tabledata" class="table table-striped jambo_table bulk_action table-dark" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Parámetro</th>
                                    <th>Descipción</th>
                                    <th style="text-align: center;">Opciones</th>
                                    <th style="text-align: center;">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data as $datos) {
                                ?>
                                    <tr>
                                        <td><?php echo $datos['ParaId'] ?></td>
                                        <td><?php echo $datos['Parametro'] ?></td>
                                        <td><?php echo $datos['Descripcion'] ?></td>  
                                        <td>
                                            <div class="text-center">
                                                <div class="btn-group">
                                                    <button class="btn btn-outline-info btn-sm ml-3" id="btnEditar" data-toggle="tooltip" data-placement="top" title="editar">
                                                        <i class="fa fa-pencil-square-o"></i></button>
                                                    <button class="btn btn-outline-danger btn-sm ml-3" id="btnEliminarEdit" data-toggle="tooltip" data-placement="top" title="eliminar">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="text-align: center">
                                            <input type="checkbox" class="form-check-input chkEstadoPa" id="chk<?php echo $datos['ParaId']; ?>" name="check[]" <?php if ($datos['Estado'] == 'Activo') {
                                             echo "checked";} ?> value="<?php echo $datos['ParaId']; ?>" />                                            
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


<?php require_once '../dashmenu/panel_footer.php'; ?>
<script src="../codejs/parametros.js" type="text/javascript"></script>
</body>

</html>