<?php

require_once '../dashmenu/panel_menu.php';

$mensaje = (isset($_POST['mensaje'])) ? $_POST['mensaje'] : '';

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(11, $_SESSION["i_emprid"], '', '', '', '', '', '', 0, 0, 0, 0, 0, 0));
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
                        <h2>Perfiles de Usuario</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <button type="button" class="btn btn-outline-info" id="btnNuevo" data-toggle="tooltip" data-placement="top" title="nuevo perfil" style="margin-bottom:10px"><i class="fa fa-plus"></i></button>

                    <div class="x_content">
                        <br />
                        <table id="tabledata" class="table table-striped jambo_table bulk_action table-borderless" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Perfil</th>
                                    <th>Descipción</th>
                                    <th style="width:13% ; text-align: center">Opciones</th>
                                    <th style="width:10% ; text-align: center">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (count($data) == 1) {
                                    $disablesub = 'disabled';
                                } else {
                                    $disablesub = '';
                                }
                                foreach ($data as $datos) {
                                ?>
                                    <?php

                                        $disabledel = '';
                                        $disabledit = '';
                                        $chkestado = '';

                                        if ($datos['PerfilId'] == '1') {
                                            $disabledel = 'disabled';
                                            // $disabledit = 'disabled';
                                            $chkestado = 'disabled';
                                        }

                                        if ($datos['PerfilId'] != '1' && $datos['Estado'] == 'Inactivo') {
                                            $disabledit = 'disabled';
                                        }

                                    ?>
                                    <tr>
                                        <td><?php echo $datos['PerfilId'] ?></td>
                                        <td><?php echo $datos['Perfil'] ?></td>
                                        <td><?php echo $datos['Descripcion'] ?></td>
                                        <td>
                                            <div class="text-center">
                                                <div class="btn-group">
                                                    <button class="btn btn-outline-info btn-sm ml-3 btnEditar" <?php echo $disabledit ?> id="btnEditar<?php echo $datos['PerfilId']; ?>" data-toggle="tooltip" data-placement="top" title="editar">
                                                        <i class="fa fa-pencil-square-o"></i></button>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="text-align: center">
                                            <input type="checkbox" class="form-check-input chkEstadoPe" <?php echo $chkestado; ?> id="chk<?php echo $datos['PerfilId']; ?>" name="check[]" <?php if ($datos['Estado'] == 'Activo') {
                                             echo "checked";} else {'';} ?> value="<?php echo $datos['PerfilId']; ?>" />                                            
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
<script src="../codejs/perfil.js" type="text/javascript"></script>

</body>

</html>