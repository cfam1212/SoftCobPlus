<?php
require_once '../dashmenu/panel_menu.php';

$mensaje = (isset($_POST['mensaje'])) ? $_POST['mensaje'] : '';

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(1, $_SESSION["i_emprid"], '', '', '', '', '', '', 0, 0, 0, 0, 0, 0));
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
                        <h2>Menu</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <button type="button" class="btn btn-outline-info" data-toggle="tooltip" data-placement="top" title="nuevo menu" id="btnNuevo" style="margin-bottom:10px"><i class="fa fa-plus"></i></button>

                    <div class="x_content">
                        <br />

                        <table id="tablenoorder" class="table table-striped table-condensed jambo_table bulk_action table-dark table-borderless" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Menu</th>
                                    <th>Icono</th>
                                    <th style="text-align: center;">Estado</th>
                                    <th style="text-align: center;">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (count($data) == 0) {
                                    $disablesub = 'disabled="disabled"';
                                } else {
                                    $disablesub = '';
                                }
                                foreach ($data as $datos) {
                                ?>
                                    <?php

                                        $disabledel = '';
                                        $disabledit = '';
                                        $deshabilitaSub = '';
                                        $chkestado = '';

                                        if ($datos['MenuId'] == '200001') {
                                            $disabledel = 'disabled';
                                            $disabledit = 'disabled';
                                            $deshabilitaSub = 'disabled';
                                            $chkestado = 'disabled';
                                        }

                                        if ($datos['MenuId'] != '200001') {
                                            if($datos['Estado'] == 'Inactivo'){
                                                $disabledit = 'disabled';
                                            }
                                        }

                                    ?>
                                    <tr>
                                        <td><?php echo $datos['MenuId'] ?></td>
                                        <td><?php echo $datos['Menu'] ?></td>
                                        <td><?php echo $datos['Icono'] ?></td>
                                        <td style="text-align: center">
                                            <input type="checkbox" class="form-check-input chkEstadoMe" <?php echo $chkestado; ?> id="chk<?php echo $datos['MenuId']; ?>" name="check[]" <?php if ($datos['Estado'] == 'Activo') {
                                             echo "checked";} else {'';} ?> value="<?php echo $datos['MenuId']; ?>" />                                            
                                        </td>  
                                        <td>
                                            <div class="text-center">
                                                <div class="btn-group">
                                                    <button class="btn btn-outline-primary btn-sm" <?php echo $deshabilitaSub ?> id="btnSubirNivel"><i class="fa fa-arrow-up"></i></button>                                                        
                                                    <button class="btn btn-outline-info btn-sm ml-3 btnEditar" <?php echo $disabledit ?> id="btnEditar<?php echo $datos['MenuId']; ?>" data-toggle="tooltip" data-placement="top" title="editar">
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


<?php require_once '../dashmenu/panel_footer.php'; ?>
<script src="../codejs/menu.js" type="text/javascript"></script>

</html>