<?php



require_once '../dashmenu/panel_menu.php'; 

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
                    <h2>Cambio de Contraseña</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                        
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Contraseña Actual:
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="password" id="txtcontactual" required="required" class="form-control" maxlength="20">
                            </div>
                        </div>
                        
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Nueva Contraseña:
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="password" id="txtcontnueva" name="last-name" required="required" class="form-control" maxlength="10">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Confirmar Contraseña:</label>
                            <div class="col-md-6 col-sm-6 ">
                                <input id="txtconfcont" class="form-control" type="password" name="middle-name" maxlength="10">
                            </div>
                        </div>
      
                        <div class="ln_solid"></div>
                        <div class="col-md-6 col-sm-6 offset-md-3">
                            <div class='btn-group'>
                                <button class="btn btn-outline-primary" id = "btnRegresar" ><i class='fa fa-undo'></i> Regresar</button>
                                <button class="btn btn-outline-success ml-3 float-end" id="btnSave"><i class='fa fa-save'></i> Guardar</button>
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