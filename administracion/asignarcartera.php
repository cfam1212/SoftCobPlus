<?php

require_once '../dashmenu/panel_menu.php';

$consulta = "CALL sp_New_Cartera(?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(1, 0, 0, 0, 0, '', '', '', '', '', 0, 0, 0));
$dataciu = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "CALL sp_New_Cartera(?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(3, 0, 0, 0, 0, '', '', '', '', '', 0, 0, 0));
$datapro = $resultado->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Asignar Cartera</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <br />
                        <form class="form-horizontal col-md-10 offset-md-1">
                            <div class="form-group row">
                                <div class="col-md-5 col-sm-8">
                                    <select class="form-control" id="cboCiudad" name="cbociudad" style="width: 100%;">
                                        <option value="0">--Seleccione Cuidad--</option>
                                        <?php foreach ($dataciu as $fila) : ?>
                                            <option value="<?= $fila['Codigo'] ?>"><?= $fila['Descripcion'] ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <label for="espacio" class="control-label col-md-1"></label>
                                <div class="col-md-5 col-sm-8">
                                    <select class="form-control" id="cboCedente" name="cbocedente" style="width: 100%;">
                                        <option value="0">--Seleccione Cedente--</option>
                                    </select>
                                </div>
                            </div>
                            <br />
                            <div class="form-group row">
                                <div class="col-md-5 col-sm-8">
                                    <select class="form-control" id="cboProducto" name="cboproducto" style="width: 100%;">
                                        <option value="0">--Seleccione Producto--</option>
                                        <?php foreach ($datapro as $fila) : ?>
                                            <option value="<?= $fila['Codigo'] ?>"><?= $fila['Descripcion'] ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <label for="espacio" class="control-label col-md-1"></label>
                                <div class="col-md-5 col-sm-8">
                                <select class="form-control" id="cboCatalogo" name="cbocatalogo" style="width: 100%;">
                                        <option value="0">--Seleccione Catalogo--</option>
                                        <?php foreach ($datapro as $fila) : ?>
                                            <option value="<?= $fila['Codigo'] ?>"><?= $fila['Descripcion'] ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <br />
                            <br />
                            <div class="form-group row">
                                <label for="registro" class="control-label col-md-2">Total Registros:</label>
                            </div>
                            <br />
                            <div class="form-group row">
                                <div class="checkbox">
                                    <input type="checkbox" id="chkTodosGest"> Todos los Gestores:
                                </div>
                            </div>
                            <br />
                            <div class="form-group row">
                                <div class="checkbox">
                                    <input type="checkbox" id="chkPorGest"> Por Gestor:
                                </div>
                            </div>
                            <br />
                            <div class="form-group row">
                                <label for="gestor" class="control-label col-md-2"></label>
                                <div class="form-group col-md-6">
                                    <select class="form-control" id="cboGestor" name="cboGestor" style="width:100%;">
                                        <option value="0">--Seleccione Gestor--</option>
                                        <?php foreach ($gestor as $fila) : ?>
                                            <option value="<?= $fila['Codigo'] ?>"><?= $fila['Descripcion'] ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <button type="button" class="btn btn-outline-info ml-3" id="btnPorGestor" data-toggle="tooltip" title="agregar gestor"><i class='fa fa-plus'></i></button>
                                </div>
                            </div>
                            <br />
                            <br />
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="col-md-1 col-sm-1">
                                    </div>
                                    <div class="col-md-10 col-sm-10">
                                        <div class="table-responsive">
                                            <table id="tblagestor" class="table table-striped table-condensed jambo_table bulk_action table-borderless" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th style="display: none;">Id</th>
                                                        <th>Gestor</th>
                                                        <th style="width:12% ; text-align: center">Opciones</th>
                                                        <th style="width:10% ; text-align: center">Estado</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-sm-1">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="container">
                            <div class="form-group col-md-2">
                                <button type="button" class="btn btn-outline-info" id="btnContacto">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../dashmenu/panel_footer.php'; ?>
<script src="../codejs/asigcartera.js" type="text/javascript"></script>
</body>

</html>