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
                    <h2>Perfiles de Calificacion</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                        <br />
                        <div class="col-xs-3">
                    
                            <div class="nav nav-tabs flex-column  bar_tabs" id="v-pills-tab" role="tablist" aria-orientation="horizontal">
                                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home1" role="tab" aria-controls="v-pills-home" aria-selected="true">Perfiles</a>
                                <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile1" role="tab" aria-controls="v-pills-profile" aria-selected="false">Descripcion</a>    
                            </div>
                
                        </div>

                        <div class="col-xs-9">
                        <!-- Tab panes -->
                        
                        <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-home1" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                        
                                        <div class="form-group col-md-12"> 
                                            <select class="form-control" id="cboProvincia" name="cboprovincia">
                                                    <option value="0">--Seleccione Perfil--</option>
                                                    <?php foreach($dataprov as $fila): ?>
                                                        <option value="<?=$fila['Codigo']?>"><?=$fila['Descripcion']?></option>
                                                    <?php endforeach ?>
                                            </select>
                                        </div>                                 
                                    
                                </div>
                                <div class="tab-pane fade" id="v-pills-profile1" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                        <input id="txtRuc" name="iconome" type="text" placeholder=" " class="form-control" maxlength="13">
                                    </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                    <div class="clearfix"></div>
                    <br>
                    <br>
                    <br> 
                        <div class="row">
                            <label for="espacio" class="control-label col-md-11"></label>
                            <button type="button" class="btn btn-outline-success" id="btnPerfiles" style="margin-bottom:10px"><i class="fa fa-plus"></i></button>
                        </div>                       
                </div>
               
                  <div class="container">
                        <div class='btn-group'>
                            <button class="btn btn-outline-primary" id = "btnRegresar" ><i class='fa fa-undo'></i> Regresar</button>
                            <button class="btn btn-outline-success ml-3" id="btnSave"><i class='fa fa-save'></i> Guardar</button>
                        </div>
                  </div>
            </div>
        </div>
    </div>    
</div>

<?php require_once '../dashmenu/panel_footer.php'; ?>
<script src="../codejs/perfilesca.js" type="text/javascript"></script>

</body>

</html>