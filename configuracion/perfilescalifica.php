<?php

require_once '../dashmenu/panel_menu.php';

@session_start();
    
if(isset($_SESSION["s_usuario"])){
    if($_SESSION["s_login"] != "loged"){
        header("Location: ./logout.php");
        exit();
    } else{
    }
} else{
    header("Location: ./logout.php");
    exit();
}

$mensaje = (isset($_POST['mensaje'])) ? $_POST['mensaje'] : '';

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(36, $_SESSION["i_emprid"], 'TIPO PERFILES', '', '', '', '', '', 0, 0, 0, 0, 0, 0));
$datos = $resultado->fetchAll(PDO::FETCH_ASSOC);

?>

<input type="hidden" id="txtusuaid" value="<?php echo $_SESSION["i_usuaid"] ?>">
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Perfiles de Calificacion</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form class="form-horizontal" role="form">
                        <fieldset>
                           <div class="form-group row">
                                <label for="espacio" class="control-label col-md-3"></label>
                                <label for="menuname" class="control-label col-md-1">Perfil:</label>
                            </div>
                            <div class="row">
                                <label for="espacio" class="control-label col-md-3"></label>
                                <div class="form-group col-md-5">
                                    <select class="form-control" id="cboPerfil" name="cboperfil" style="width:100%">
                                        <option value="0">--Seleccione Tipo--</option>
                                        <?php foreach ($datos as $fila) : ?>
                                            <option value="<?= $fila['Codigo'] ?>"><?= $fila['Descripcion'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="espacio" class="control-label col-md-3"></label>
                                <label for="menuname" class="control-label col-md-1">Descripcion:</label>
                            </div>
                            <div class="row">
                                <label for="espacio" class="control-label col-md-3"></label>
                                <div class="col-md-5 col-sm-5  form-group has-feedback">
                                    <input type="tel" class="form-control has-feedback-left" id="txtDescripcion" maxlength="150">
                                    <span class="fa fa-male form-control-feedback left" aria-hidden="true"></span>
                                </div>
                                <button type="button" class="btn btn-outline-info" id="btnAgregar" data-toggle="tooltip" data-placement="top" title="agregar" style="margin-bottom:10px">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </fieldset>
                    </form>
                    <div class="clearfix"></div>
                    <br>
                    <br>
                    <div class="col-md-12 col-sm-12">
                        <div class="col-md-1 col-sm-1">
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <form method="post" id="user_form">
                                <div class="table-responsive">
                                    <table id="tblperfilcalifica" class="table table-striped jambo_table table-condensed bulk_action table-borderless" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>Descripcion</th>
                                                <th style="width:13% ; text-align: center">Opciones</th>
                                                <th style="width:10% ; text-align: center">Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-1 col-sm-1">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalPERFIL" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 35%" role="document">
        <div class="modal-content" id="myModalBg">
            <div class="modal-header" id="header">
                <h5 class="modal-title" id="modalLabel"></h5>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
            </div>
            <form id="formPerfil">
                <div class="modal-body">
                    <label for="detalle" class="col-form-label">Descripcion</label>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 form-group">
                            <input type="text" class="form-control has-feedback-left" id="txtDescripcionedit" maxlength="80">
                            <span class="fa fa-briefcase form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="row_id" id="hidden_row_id" />
                    <button type="button" id="btnModificar" class="btn btn-outline-info"><i class="fa fa-save"></i> Guardar</button>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once '../dashmenu/panel_footer.php'; ?>
<script src="../codejs/perfilesca.js" type="text/javascript"></script>

</body>

</html>