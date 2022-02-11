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
                    <br>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="well well-sm">
                                    <form class="form-horizontal" method="post">
                                        <fieldset>
                                            <legend class="text-center header">Actualizar Contraseña</legend>
                                            <div class="form-group">
                                                <i class="fa fa-user bigicon"></i>
                                                <div class="col-md-8">
                                                    <input type="password" id="txtcontactual" placeholder="Contraseña Actual" class="form-control" autocomplete="off">
                                                </div>
                                            </div>
                                            <br />
                                            <div class="form-group">
                                                <i class="fa fa-pencil-square-o bigicon"></i>
                                                <div class="col-md-8">
                                                    <input type="password" id="txtcontnueva" placeholder="Nueva Contraseña" class="form-control" autocomplete="off">
                                                </div>
                                            </div>
                                            <br />
                                            <div class="form-group">
                                                <i class="fa fa-user bigicon"></i>
                                                <div class="col-md-8">
                                                    <input type="password" id="txtconfcont" placeholder="Confirme Contraseña" class="form-control" autocomplete="off">
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class='btn-group'>
                            <button class="btn btn-outline-info ml-3" id="btnSave"><i class='fa fa-save'></i> Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require_once '../dashmenu/panel_footer.php'; ?>
<script src="../codejs/seguridad.js" type="text/javascript"></script>

</body>

</html>