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
                    <h2 style="text-align: center;">Ingrese Credenciales</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form class="form-horizontal col-md-10 offset-md-1">
                        <br />
                        <div class="form-group row">
                            <label for="espacio" class="control-label col-md-1"></label>
                            <div class="col-md-10 col-sm-9 col-xs-9">
                                <input type="password" id="txtcontactual" class="form-control has-feedback-left" autocomplete="off" placeholder="contraseña actual" maxlength="50">
                                <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        </div>
                        <br/>
                        <div class="form-group row">
                            <label for="espacio" class="control-label col-md-1"></label>
                            <div class="col-md-10 col-sm-9 col-xs-9">
                                <input type="password" id="txtcontnueva" class="form-control has-feedback-left" placeholder="nueva contraseña" autocomplete="off" maxlength="50">
                                <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        </div>
                        <br/>
                        <div class="form-group row">
                            <label for="espacio" class="control-label col-md-1"></label>    
                            <div class="col-md-10 col-sm-9 col-xs-9">
                                <input type="password" id="txtconfcont" class="form-control has-feedback-left" placeholder="confirmar" autocomplete="off" maxlength="50">
                                <span class="fa fa-check-square-o form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        </div>
                        <br/>
                        <div class="form-group row">
                            <label for="espacio" class="control-label col-md-1"></label>  
                            <div class="col-md-10">
                                <button type="button" id="btnSave" class="btn btn-info btn-lg btn-block">Guardar</button>
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