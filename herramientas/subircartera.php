<?php

require_once '../dashmenu/panel_menu.php';

$consulta = "CALL sp_New_Cartera(?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(1, 0, 0, 0, 0, '', '', '', '', '', 0, 0, 0));
$dataciu = $resultado->fetchAll(PDO::FETCH_ASSOC);


?>
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Subir Cartera</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <br />
                        <form class="form-horizontal col-md-10 offset-md-2">
                            <div class="form-group row">
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
                                <div class="col-md-4 col-sm-8">
                                    <select class="form-control" id="cboCedente" name="cbocedente" style="width: 100%;">
                                        <option value="0">--Seleccione Cedente--</option>
                                    </select>
                                </div>
                            </div>
                            <br />
                            <div class="form-group row">
                                <div class="col-md-4 col-sm-8">
                                    <select class="form-control" id="cboProducto" name="cboproducto" style="width: 100%;">
                                        <option value="0">--Seleccione Producto--</option>
                                    </select>
                                </div>
                                <label for="espacio" class="control-label col-md-1"></label>
                                <div class="col-md-4 col-sm-8">
                                    <select class="form-control" id="cboCatalogo" name="cbocatalogo" style="width: 100%;">
                                        <option value="0">--Seleccione Catalogo--</option>
                                    </select>
                                </div>
                            </div>
                            <br />
                            <br />
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" accept=".txt" id="txtArchivo" name="txtArchivo">
                                </div>
                                <h3>Contenido del archivo:</h3>
                                <pre id="contenido-archivo"></pre>                                
                            </div>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" id="btnProcesar" class="btn btn-info">Procesar</button>
                            </div>
                            <br />
                            <br />
                            <div class="progress col-md-9">
                                <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../dashmenu/panel_footer.php'; ?>
<script src="../codejs/herramientas.js" type="text/javascript"></script>
</body>

</html>