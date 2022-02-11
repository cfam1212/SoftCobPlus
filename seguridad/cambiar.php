<?php

require_once '../dashmenu/panel_menu.php';

?>

<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-6">
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Input Mask</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form class="form-horizontal form-label-left">
                        <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Contraseña Actual</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="password" id="txtcontactual" placeholder="Contraseña Actual" class="form-control" autocomplete="off" maxlength="20">
                                <span class="glyphicon glyphicon-tent form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">TaxID Mask</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="text" class="form-control" data-inputmask="'mask' : '99-99999999'">
                                <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Credit Card Mask</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="text" class="form-control" data-inputmask="'mask' : '9999-9999-9999-9999'">
                                <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="ln_solid"></div>

                        <div class="form-group row">
                            <div class="col-md-9 offset-md-3">
                                <button type="submit" class="btn btn-primary">Cancel</button>
                                <button type="submit" class="btn btn-success">Submit</button>
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