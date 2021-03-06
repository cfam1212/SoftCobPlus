<?php

require_once '../dashmenu/panel_menu.php';

@session_start();

if (isset($_SESSION["s_usuario"])) {
    if ($_SESSION["s_login"] != "loged") {
        header("Location: ./logout.php");
        exit();
    } else {
    }
} else {
    header("Location: ./logout.php");
    exit();
}

$consulta = "CALL sp_New_Cartera(?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(1, 0, 0, 0, 0, '', '', '', '', '', 0, 0, 0));
$dataciu = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "CALL sp_New_Cartera(?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(3, 0, 0, 0, 0, '', '', '', '', '', 0, 0, 0));
$datapro = $resultado->fetchAll(PDO::FETCH_ASSOC);

$mensaje = (isset($_POST['mensaje'])) ? $_POST['mensaje'] : '';

?>


<div class="right_col" role="main">
    <input type="hidden" id="mensaje" value="<?php echo $mensaje ?>">
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
                        <form class="form-horizontal col-md-12">
                            <br/>
                            <div class="form-group row">
                                <label for="ciudad" class="control-label col-md-1">Ciudad:</label>
                                <div class="col-md-4 col-sm-8">
                                    <select class="form-control" id="cboCiudad" name="cbociudad" style="width: 100%;">
                                        <option value="0">--Seleccione Cuidad--</option>
                                        <?php foreach ($dataciu as $fila) : ?>
                                            <option value="<?= $fila['Codigo'] ?>"><?= $fila['Descripcion'] ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <label for="espacio" class="control-label col-md-1"></label>
                                <label for="cedente" class="control-label col-md-1">Cedente:</label>
                                <div class="col-md-4 col-sm-8">
                                    <select class="form-control" id="cboCedente" name="cbocedente" style="width: 100%;">
                                        <option value="0">--Seleccione Cedente--</option>
                                    </select>
                                </div>
                            </div>
                            <br/>
                            <br/>    
                            <div class="form-group row">
                                <label for="producto" class="control-label col-md-1">Producto:</label>
                                <div class="col-md-4 col-sm-8">
                                    <select class="form-control" id="cboProducto" name="cboproducto" style="width: 100%;">
                                        <option value="0">--Seleccione Producto--</option>
                                    </select>
                                </div>
                                <label for="espacio" class="control-label col-md-1"></label>
                                <label for="catalogo" class="control-label col-md-1">Catalogo:</label>
                                <div class="col-md-4 col-sm-8">
                                    <select class="form-control" id="cboCatalogo" name="cbocatalogo" style="width: 100%;">
                                        <option value="0">--Seleccione Catalogo--</option>
                                    </select>
                                </div>
                            </div>
                            <br />
                            <br />
                            <div class="form-group row">
                                <label for="espacio" class="control-label col-md-1"></label>
                                <label for="registro" class="control-label col-md-2">Total Registros:</label>
                                <div class="input-group mb-3 col-md-2">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1">#</span>
                                    </div>
                                        <input type="text" class="form-control" id="txttotalreg" name="txttotalreg" disabled aria-label="Username" aria-describedby="basic-addon1" placeholder="0000">
                                        <br/>
                                        <br/>
                                </div>
                                <input type="hidden" class="form-control" id="txtTemReg" name="txtTemReg">
                            </div>
                            <br />
                            <div class="form-group row">
                                <label for="espacio" class="control-label col-md-1"></label>
                                <div class="checkbox">
                                    <input type="radio" id="chkTodosGest"> Todos los Gestores:
                                </div>
                            </div>
                            <br />
                            <div class="form-group row">
                                <label for="espacio" class="control-label col-md-1"></label>
                                <div class="checkbox">
                                    <input type="radio" id="chkPorGest"> Por Gestor:
                                </div>
                            </div>
                            <br />
                            <div class="form-group row" id="divGestor" style="display: none;">
                                <label for="gestor" class="control-label col-md-3"></label>
                                <div class="form-group col-md-5">
                                    <select class="form-control" id="cboGestor" name="cboGestor" style="width:100%;">
                                        <option value="0">--Seleccione Gestor--</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <button type="button" class="btn btn-outline-info ml-3" id="btnPorGestor" data-toggle="tooltip" title="agregar gestor"><i class='fa fa-plus'></i></button>
                                </div>
                            </div>
                            <div class="form-group row" id="divRegistro" style="display: none;">
                               <label for="espacio" class="control-label col-md-4"></label>
                                <label for="espacio" class="control-label col-md-1">Registros:</label>
                                <div class="col-md-2 form-group has-feedback">
                                    <input type="text" class="form-control has-feedback-left" id="txtNumReg" maxLength="4" placeholder="0000" required onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;">
                                    <span class="fa fa-slack form-control-feedback left" aria-hidden="true"></span>
                                </div>
                            </div>
                            <br />
                            <br />
                            <div class="form-group row">
                                <label for="espacio" class="control-label col-md-1"></label>
                                <div class="col-md-9 col-sm-10">
                                    <div class="table-responsive">
                                        <table id="tblagestor" class="table table-striped table-condensed jambo_table bulk_action table-borderless" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th style="display: none;">Id</th>
                                                    <th>Gestor</th>
                                                    <th>Registro</th>
                                                    <th style="width:12% ; text-align: center">Opciones</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="container">
                                <label for="espacio" class="control-label col-md-1"></label>
                                <div class="form-group col-md-3">
                                    <button type="button" class="btn btn-outline-info" id="btnProcesar"><i class="fa fa-gears"></i>Procesar</button>
                                </div>
                            </div>
                            <div id="progressBar">
                                <div id="progressbar">

                                </div>
                            </div>
                        </form>
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