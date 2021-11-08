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
                        <form class="form-horizontal" role="form">
                        <fieldset>
                        <div class="row">
                                <label for="espacio" class="control-label col-md-1"></label>    
                                <label for="cboprovincia" class="control-label col-md-1">Perfil</label>
                                <div class="form-group col-md-7"> 
                                    <select class="form-control" id="cboProvincia" name="cboprovincia">
                                            <option value="0">--Seleccione Perfil--</option>
                                            <?php foreach($dataprov as $fila): ?>
                                                <option value="<?=$fila['Codigo']?>"><?=$fila['Descripcion']?></option>
                                            <?php endforeach ?>
                                    </select>
                                </div>
                            </div>    
                        <div class="row">
                                <label for="espacio" class="control-label col-md-1"></label>
                                <label for="menuname" class="control-label col-md-1">Descripcion</label>
                                <div class="form-group col-md-7">
                                    <input type="text"  required class="form-control" id="txtDescripcion" name="menuname" placeholder="" maxlength="150">
                                </div>
                            </div>
                        </fieldset>
                            
                        </form>

                    <div class="clearfix"></div>
                    <br>
                    <br>
                    <br> 
                        <div class="row">
                            <label for="espacio" class="control-label col-md-11"></label>
                            <button type="button" class="btn btn-outline-success" id="btnPerfiles" style="margin-bottom:10px"><i class="fa fa-plus"></i></button>
                        </div>                       
                </div>
                <div class="col-md-10 col-sm-10">
                    <form method="post" id="user_form">
                        <div class="table-responsive">
                            <table id="tblparameter" class="table table-striped table-border table-condensed table-info"  style="width: 100%;">
                                <thead class="text-center">
                                    <tr> 
                                        <th style="display: none;">Id</th>
                                        <th>Descripcion</th>
                                        <th>Activo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach($data as $dat){
                                ?>
                                <tr id="row_<?php echo $dat['Orden']; ?>">
                                    <td style="display: none;">
                                    <?php echo $dat['Padeid']; ?> 
                                        <input type="hidden" name="hidden_codigo[]" id="codigo<?php echo $dat['Orden'];?>" value="<?php echo $dat['Padeid']; ?>"/>
                                    </td>                                          
                                    <td style="display: none;">
                                        <?php echo $dat['Orden']; ?>
                                        <input type="hidden" name="hidden_orden[]" id="orden<?php echo $dat['Orden'];?>" value="<?php echo $dat['Orden']; ?>"/>
                                    </td>
                                    <td style="display: none;">
                                        <?php echo $dat['Orden']; ?>
                                        <input type="hidden" name="hidden_orden[]" id="orden<?php echo $dat['Orden'];?>" value="<?php echo $dat['Orden']; ?>"/>
                                    </td>                                   
                                    <td>
                                        <div class="text-center">
                                            <div class="btn-group">
                                                <button type="button" name="btnEdit" class="btn btn-outline-info btn-sm ml-3 btnEdit" id="">><i class="fa fa-pencil-square-o"></i></button>
                                                <button type="button" name="btnDelete" class="btn btn-outline-danger btn-sm ml-3" id=""><i class="fa fa-trash-o"></i></button>                                                        
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                             <?php } ?>     
                                </tbody> 
                            </table>
                        </div> 
                    </form>                                 
                </div>
            </div>
        </div>
    </div>    
</div>

<?php require_once '../dashmenu/panel_footer.php'; ?>
<script src="../codejs/perfilesca.js" type="text/javascript"></script>

</body>

</html>