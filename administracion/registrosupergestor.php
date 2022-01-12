<?php

require_once '../dashmenu/panel_menu.php';

$mensaje = (isset($_POST['mensaje'])) ? $_POST['mensaje'] : '';

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(37, $_SESSION["i_emprid"], 'Gestor', '', '', '', '', '', 0, 0, 0, 0, 0, 0));
$gestor = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(37, $_SESSION["i_emprid"], 'Supervisor', '', '', '', '', '', 0, 0, 0, 0, 0, 0));
$super = $resultado->fetchAll(PDO::FETCH_ASSOC);

?>

<input type="hidden" id="mensaje" value="<?php echo $mensaje ?>">

<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>REGISTRO SUPERVISORES Y GESTORES</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <br />
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Registrar Supervisores
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <br />
                                        <fieldset>
                                            <div class="row">
                                                <label for="espacio" class="control-label col-md-1"></label>
                                                <label for="cboprovincia" class="control-label col-md-1">Cedente</label>
                                                <div class="form-group col-md-3">
                                                    <select class="form-control" id="cboCedente" name="cbocedente" style="width:100%;" >
                                                        <option value="0">--Seleccione Cedente--</option>
                                                        <?php foreach ($dataprov as $fila) : ?>
                                                            <option value="<?= $fila['Codigo'] ?>"><?= $fila['Descripcion'] ?>
                                                            </option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                                <label for="espacio" class="control-label col-md-1"></label>
                                                <label for="cbocuidad" class="control-label col-md-1">Supervisor</label>
                                                <div class="form-group col-md-3">
                                                    <select class="form-control" id="cboSupervisor" name="cbosupervisor" style="width:100%;">
                                                        <option value="0">--Seleccione Supervisor--</option>
                                                        <?php foreach ($super as $fila) : ?>
                                                            <option value="<?= $fila['Codigo'] ?>"><?= $fila['Descripcion'] ?>
                                                            </option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <button type="button" class="btn btn-outline-success" id="btnNuevoSuper" data-toggle="tooltip" data-placement="top" title="agregar supervisor" style="margin-bottom:10px"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Registrar Gestores
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <br />
                                        <fieldset>
                                            <div class="row">
                                                <label for="espacio" class="control-label col-md-1"></label>
                                                <label for="cboprovincia" class="control-label col-md-1">Cedente</label>
                                                <div class="form-group col-md-3">

                                                    <select class="form-control" id="cboCedente2" name="cbocedente" style="width:100%;">
                                                        <option value="0">--Seleccione Cedente--</option>
                                                        <?php foreach ($dataprov as $fila) : ?>
                                                            <option value="<?= $fila['Codigo'] ?>"><?= $fila['Descripcion'] ?>
                                                            </option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                                <label for="espacio" class="control-label col-md-1"></label>
                                                <label for="cbocuidad" class="control-label col-md-1">Supervisor</label>
                                                <div class="form-group col-md-3">
                                                    <select class="form-control" id="cboSupervisor2" name="cbosupervisor" style="width:100%;">
                                                        <option value="0">--Seleccione Supervisor--</option>
                                                        <?php foreach ($super as $fila) : ?>
                                                            <option value="<?= $fila['Codigo'] ?>"><?= $fila['Descripcion'] ?>
                                                            </option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <label for="espacio" class="control-label col-md-1"></label>
                                                <label for="cboprovincia" class="control-label col-md-1">Gestor</label>
                                                <div class="form-group col-md-3">

                                                    <select class="form-control" id="cboGestor" name="cbogestor" style="width:100%;">
                                                        <option value="0">--Seleccione Gestor--</option>
                                                        <?php foreach ($gestor as $fila) : ?>
                                                            <option value="<?= $fila['Codigo'] ?>"><?= $fila['Descripcion'] ?>
                                                            </option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <button type="button" class="btn btn-outline-success" id="btnNuevoAgen" data-toggle="tooltip" data-placement="top" title="agregar gestor" style="margin-bottom:10px"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                            <br />
                                            <br />
                                            <div class="col-md-12 col-sm-12">
                                                <div class="col-md-1 col-sm-1">
                                                </div>
                                                <div class="col-md-10 col-sm-10">
                                                    <form method="post" id="user_form">
                                                        <div class="table-responsive">
                                                            <table id="tblgestor" class="table table-striped jambo_table table-condensed table-dark table-borderless" style="width: 100%;">
                                                                <thead class="text-center">
                                                                    <tr>
                                                                        <th style="display: none;">Id</th>
                                                                        <th>Gestor</th>
                                                                        <th>Estado</th>
                                                                        <th>Acciones</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody></tbody>
                                                            </table>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col-md-1 col-sm-1">
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class='btn-group'>
                    <button class="btn btn-outline-success ml-3" id="btnSave"><i class='fa fa-save'></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../dashmenu/panel_footer.php'; ?>
<script src="../codejs/registro.js" type="text/javascript"></script>

</body>

</html>