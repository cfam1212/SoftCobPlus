<?php

require_once '../dashmenu/panel_menu.php'; 

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(29,0,'','','','','','',0,0,0,0,0,0));
$dataprov = $resultado->fetchAll(PDO::FETCH_ASSOC);

?>

<input type="hidden" id="mensaje" value="<?php echo $mensaje ?>">

<div class="right_col" role="main"> 
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>NUEVO CEDENTE</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                   
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                                                                                   
                    <div class="x_content">
                    <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="cedente-tab" data-toggle="tab" href="#cedente" role="tab" aria-controls="cedente" aria-selected="true">Datos Cedente</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="contacto-tab" data-toggle="tab" href="#contacto" role="tab" aria-controls="contacto" aria-selected="false">Contactos</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="producto-tab" data-toggle="tab" href="#producto" role="tab" aria-controls="producto" aria-selected="false">Productos</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="catalogo-tab" data-toggle="tab" href="#catalogo" role="tab" aria-controls="catalogo" aria-selected="false">Catalogo-Productos</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="agencia-tab" data-toggle="tab" href="#agencia" role="tab" aria-controls="agencia" aria-selected="false">Agencias</a>
                      </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="cedente" role="tabpanel" aria-labelledby="cedente-tab">
                      <form class="form-horizontal" role="form">      
                            <fieldset>
                                </br>
                                <div class="row">
                                <label for="espacio" class="control-label col-md-1"></label>    
                                <label for="cboprovincia" class="control-label col-md-1">Provincia</label>
                                <div class="form-group col-md-3"> 
                                   
                                    <select class="form-control" id="cboProvincia" name="cboprovincia">
                                            <option value="0">--Seleccione Provincia--</option>
                                            <?php foreach($dataprov as $fila): ?>
                                                <option value="<?=$fila['Codigo']?>"><?=$fila['Descripcion']?></option>
                                            <?php endforeach ?>
                                    </select>
                                </div>
                                <label for="espacio" class="control-label col-md-1"></label>
                                <label for="cbocuidad" class="control-label col-md-1">Cuidad</label>
                                <div class="form-group col-md-3">                                     
                                    <select class="form-control" id="cboCiudad" name="cbociudad">
                                            <option value="0">--Seleccione Ciudad--</option>
                                    </select>
                                </div>
                                </div>             
                              
                                <div class="row">
                                    <label for="espacio" class="control-label col-md-1"></label>
                                    <label for="menuname" class="control-label col-md-1">Cedente</label>
                                    <div class="form-group col-md-3">
                                       
                                        <input type="text" required class="form-control" id="txtCedente" name="menuname" placeholder="" maxlength="150">
                                    </div>
                                    <label for="espacio" class="control-label col-md-1"></label>
                                    <label for="iconome" class="control-label col-md-1">Ruc</label>
                                    <div class="form-group col-md-3">
                                        
                                        <input id="txtRuc" name="iconome" type="text" placeholder=" " class="form-control" maxlength="13">
                                    </div>
                                  
                                </div>
                                <div class="row">
                                    <label for="espacio" class="control-label col-md-1"></label>
                                    <label for="menuname" class="control-label col-md-1">Direccion</label> 
                                    <div class="form-group col-md-10">                                    
                                        <textarea name="observa" id="txtDireccion" class="form-control col-md-10" maxlength="200" 
                                            onkeydown = "return (event.keyCode!=13);"></textarea>                                        
                                   </div> 

                                </div>
                             
                                <div class="row">
                                    <label for="espacio" class="control-label col-md-1"></label>
                                    <label for="menuname" class="control-label col-md-1">Telefono 1</label>
                                    <div class="form-group col-md-3">
                                        
                                        <input type="text" required class="form-control" id="txtCedente" name="menuname" placeholder="" maxlength="15">
                                    </div>
                                    <label for="espacio" class="control-label col-md-1"></label>
                                    <label for="iconome" class="control-label col-md-1">Telefono 2</label>
                                    <div class="form-group col-md-3">
                                        
                                        <input id="txtRuc" name="iconome" type="text" placeholder=" " class="form-control" maxlength="15">
                                    </div> 
                                </div>
                                <div class="row">
                                    <label for="espacio" class="control-label col-md-1"></label>
                                    <label for="menuname" class="control-label col-md-1">Fax</label>
                                    <div class="form-group col-md-3">
                                       
                                        <input type="text" required class="form-control" id="txtFax" name="menuname" placeholder="" maxlength="10">
                                    </div>
                                    <label for="espacio" class="control-label col-md-1"></label>
                                    <label for="iconome" class="control-label col-md-1">Url</label>
                                    <div class="form-group col-md-3">
                                        
                                        <input id="txtUrl" name="iconome" type="text" placeholder=" " class="form-control" maxlength="80">
                                    </div> 
                                </div>
                                <div class="row">
                                 <label for="espacio" class="control-label col-md-1"></label>   
                                 <label for="cbomenupadre" class="control-label col-md-1">Nivel Arbol</label>  
                                 <div class="form-group col-md-3"> 
                                    
                                    <select class="form-control" id="cboProvincia" name="cboprovincia">
                                            <?php foreach($menump as $fila): ?>
                                                <option value="<?=$fila['Codigo']?>"></option>
                                            <?php endforeach ?>
                                    </select>
                                  </div>
                                </div>
                                </br>
                                </br>
                                </br>    
                            </fieldset>
                        </form>    
                      </div>
                      <div class="tab-pane fade" id="contacto" role="tabpanel" aria-labelledby="contacto-tab">
                      </br>  
                      <div class="row">
                                <label for="espacio" class="control-label col-md-1"></label>
                                <label for="menuname" class="control-label col-md-1">Contacto</label>
                                <div class="form-group col-md-3">
                                   
                                    <input type="text" required class="form-control" id="txtCedente" name="menuname" placeholder="" maxlength="15">
                                </div>
                                <label for="espacio" class="control-label col-md-1"></label>
                                <label for="cbomenupadre" class="control-label col-md-1">Cargo</label>
                                <div class="form-group col-md-3"> 
                                   
                                    <select class="form-control" id="cboProvincia" name="cboprovincia">
                                            <?php foreach($menump as $fila): ?>
                                                <option value="<?=$fila['Codigo']?>"></option>
                                            <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                             <div class="row">
                                   <label for="espacio" class="control-label col-md-1"></label>
                                   <label for="menuname" class="control-label col-md-1">Ext</label>
                                    <div class="form-group col-md-3">
                                    
                                        <input type="text" required class="form-control" id="txtFax" name="menuname" placeholder="" maxlength="10">
                                    </div>
                                    <label for="espacio" class="control-label col-md-1"></label>
                                    <label for="iconome" class="control-label col-md-1">Celular</label>
                                    <div class="form-group col-md-3">
                                        
                                        <input id="txtUrl" name="iconome" type="text" placeholder=" " class="form-control" maxlength="10">
                                    </div> 
                              </div>
                              <div class="row">
                                   <label for="espacio" class="control-label col-md-1"></label>
                                   <label for="menuname" class="control-label col-md-1">Email 1</label>
                                    <div class="form-group col-md-3">
                                    
                                        <input type="text" required class="form-control" id="txtFax" name="menuname" placeholder="" maxlength="80">
                                    </div>
                                    <label for="espacio" class="control-label col-md-1"></label>
                                    <label for="iconome" class="control-label col-md-1">Email 2</label>
                                    <div class="form-group col-md-3">
                                        
                                        <input id="txtUrl" name="iconome" type="text" placeholder=" " class="form-control" maxlength="80">
                                    </div> 
                              </div>
                            </br>
                            </br>
                        </div>
                      <div class="tab-pane fade" id="producto" role="tabpanel" aria-labelledby="producto-tab">
                              </br>
                              <div class="row">
                                   <label for="espacio" class="control-label col-md-1"></label>
                                   <label for="menuname" class="control-label col-md-1">Producto</label>
                                    <div class="form-group col-md-8">
                                    
                                        <input type="text" required class="form-control" id="txtFax" name="menuname" placeholder="" maxlength="10">
                                    </div>                    
                              </div>
                              <div class="row">
                                   <label for="espacio" class="control-label col-md-1"></label>
                                   <label for="menuname" class="control-label col-md-1">Descripcion</label>
                                    <div class="form-group col-md-8">
                                    
                                        <input type="text" required class="form-control" id="txtFax" name="menuname" placeholder="" maxlength="10">
                                    </div>                    
                              </div>
                              </br>
                              </br>
                      </div>
                      <div class="tab-pane fade" id="catalogo" role="tabpanel" aria-labelledby="catalogo-tab">
                              </br>
                              <div class="row">
                                <label for="espacio" class="control-label col-md-1"></label>
                                <label for="cbomenupadre" class="control-label col-md-1">Producto</label>
                                <div class="form-group col-md-4"> 
                                   
                                    <select class="form-control" id="cboProvincia" name="cboprovincia">
                                            <?php foreach($menump as $fila): ?>
                                                <option value="<?=$fila['Codigo']?>"></option>
                                            <?php endforeach ?>
                                    </select>
                                </div>                  
                              </div>
                              <div class="row">
                              <label for="espacio" class="control-label col-md-1"></label>
                                   <label for="menuname" class="control-label col-md-2">Codigo Catalogo</label>
                                    <div class="form-group col-md-3">
                                    
                                        <input type="text" required class="form-control" id="txtFax" name="menuname" placeholder="" maxlength="80">
                                    </div>
                                    
                                    <label for="iconome" class="control-label col-md-2">Catalogo Producto</label>
                                    <div class="form-group col-md-3">
                                        
                                        <input id="txtUrl" name="iconome" type="text" placeholder=" " class="form-control" maxlength="80">
                                    </div>                
                              </div>
                              <div class="row">
                              <label for="espacio" class="control-label col-md-1"></label>    
                              <label for="menuname" class="control-label col-md-2">Codigo Familia</label>
                                    <div class="form-group col-md-3">
                                    
                                        <input type="text" required class="form-control" id="txtFax" name="menuname" placeholder="" maxlength="80">
                                    </div>
                                    
                                    <label for="iconome" class="control-label col-md-2">Familia</label>
                                    <div class="form-group col-md-3">
                                        
                                        <input id="txtUrl" name="iconome" type="text" placeholder=" " class="form-control" maxlength="80">
                                    </div>                  
                              </div>
                              </br>
                              </br>
                      </div>
                      <div class="tab-pane fade" id="agencia" role="tabpanel" aria-labelledby="agencia-tab">
                              </br>
                              <div class="row">
                              <label for="espacio" class="control-label col-md-1"></label>
                                <label for="menuname" class="control-label col-md-1">Codigo</label>
                                <div class="form-group col-md-3">
                                   
                                    <input type="text" required class="form-control" id="txtCedente" name="menuname" placeholder="" maxlength="15">
                                </div>
                                <label for="espacio" class="control-label col-md-1"></label>
                                <label for="cbomenupadre" class="control-label col-md-1">Agencia</label>
                                <div class="form-group col-md-3"> 
                                <input type="text" required class="form-control" id="txtCedente" name="menuname" placeholder="" maxlength="15">
                                  
                                </div>           
                              </div>
                              <div class="row">
                              <label for="espacio" class="control-label col-md-1"></label>
                                <label for="menuname" class="control-label col-md-1">Sucursal</label>
                                <div class="form-group col-md-3">
                                <select class="form-control" id="cboProvincia" name="cboprovincia">
                                            <?php foreach($menump as $fila): ?>
                                                <option value="<?=$fila['Codigo']?>"></option>
                                            <?php endforeach ?>
                                    </select>
                                </div>
                                <label for="espacio" class="control-label col-md-1"></label>
                                <label for="cbomenupadre" class="control-label col-md-1">Zona</label>
                                <div class="form-group col-md-3"> 
                                   
                                    <select class="form-control" id="cboProvincia" name="cboprovincia">
                                            <?php foreach($menump as $fila): ?>
                                                <option value="<?=$fila['Codigo']?>"></option>
                                            <?php endforeach ?>
                                    </select>
                                </div>       
                              </div>
                              </br>
                              </br>
                              </br>
                              <div class="container">
                                 <div class='btn-group'>
                                     <button class="btn btn-outline-primary" id = "btnRegresar" ><i class='fa fa-undo'></i> Regresar</button>
                                     <button class="btn btn-outline-success ml-3" id="btnSave"><i class='fa fa-bookmark'></i> Guardar</button>
                                 </div>
                              </div>
                        </div>
                    </div>                             
                </div>
             </div>
        </div>
    </div>
  </div>   
</div>


<?php require_once '../dashmenu/panel_footer.php'; ?>
<script src="../codejs/cedente.js" type="text/javascript"></script>

</body>

</html>