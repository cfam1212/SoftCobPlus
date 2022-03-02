<?php

require_once '../dashmenu/panel_menu.php';

?>

<input type="hidden" id="txtusuaid" value="<?php echo $_SESSION["i_usuaid"] ?>">


<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-6">
        </div>
        <div class="col-md-6 col-sm-12">
            <br/>
            <div class="x_panel">
                <div class="x_title">
                    <h2 class="titulo">Ingrese Credenciales</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form class="form-horizontal form-label-left">
                        <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Contraseña Actual:</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="password" id="txtcontactual" class="form-control" autocomplete="off" maxlength="50">
                                <span class="fa fa-key form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Nueva Contraseña:</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="password" id="txtcontnueva" class="form-control" autocomplete="off" maxlength="50">
                                <span class="fa fa-key form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Confirmar:</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="password" id="txtconfcont" class="form-control" autocomplete="off" maxlength="50">
                                <span class="fa fa-check-square-o form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="ln_solid"></div>

                        <div class="form-group row">
                            <div class="col-md-9 offset-md-3">
                                <button type="button" id="btnSave" class="btn btn-outline-info">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require_once '../dashmenu/panel_footer.php'; ?>
<script src="../codejs/seguridad.js" type="text/javascript"></script>

</body>

</html>