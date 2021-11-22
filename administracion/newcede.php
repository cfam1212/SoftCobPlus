<?php

require_once '../dashmenu/panel_menu.php'; 

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(29,0,'','','','','','',0,0,0,0,0,0));
$dataprov = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(36,$_SESSION["i_emprid"],'NIVEL ARBOL','','','','','',0,0,0,0,0,0));
$datos = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(36,$_SESSION["i_emprid"],'SUCURSAL','','','','','',0,0,0,0,0,0));
$sucursal = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(36,$_SESSION["i_emprid"],'ZONAS','','','','','',0,0,0,0,0,0));
$zona = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(36,$_SESSION["i_emprid"],'CARGOS','','','','','',0,0,0,0,0,0));
$cargo = $resultado->fetchAll(PDO::FETCH_ASSOC);



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
                        <a class="nav-link" id="agencia-tab" data-toggle="tab" href="#agencia" role="tab" aria-controls="agencia" aria-selected="false">Agencias</a>
                      </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="cedente" role="tabpanel" aria-labelledby="cedente-tab">
                      <form class="form-horizontal" role="form">      
                            <fieldset>
                                <br>
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
                                        <input id="txtRuc" name="iconome" type="text" class="form-control" maxlength="13" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;">
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="espacio" class="control-label col-md-1"></label>
                                    <label for="menuname" class="control-label col-md-1">Direccion</label> 
                                    <div class="form-group col-md-10">                                    
                                        <textarea name="observa" id="txtDireccion" class="form-control col-md-8" maxlength="200" 
                                         onkeydown = "return (event.keyCode!=13);"></textarea>                                        
                                   </div> 
                                </div>
                                <div class="row">
                                    <label for="espacio" class="control-label col-md-1"></label>
                                    <label for="menuname" class="control-label col-md-1">Telefono 1</label>
                                    <div class="form-group col-md-3">
                                        <input type="text" required class="form-control" id="txtTel1" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" name="telefono1" placeholder="" maxlength="15">
                                    </div>
                                    <label for="espacio" class="control-label col-md-1"></label>
                                    <label for="iconome" class="control-label col-md-1">Telefono 2</label>
                                    <div class="form-group col-md-3">
                                        <input id="txtTel2" name="iconome" type="text" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" placeholder=" " class="form-control" maxlength="15">
                                    </div> 
                                </div>
                                <div class="row">
                                    <label for="espacio" class="control-label col-md-1"></label>
                                    <label for="menuname" class="control-label col-md-1">Fax</label>
                                    <div class="form-group col-md-3">
                                        <input type="text" required class="form-control" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" id="txtFax" name="menuname" placeholder="" maxlength="10">
                                    </div>
                                    <label for="espacio" class="control-label col-md-1"></label>
                                    <label for="iconome" class="control-label col-md-1">Url</label>
                                    <div class="form-group col-md-3">
                                        <input id="txtUrl" name="iconome" type="text" placeholder=" " class="form-control" maxlength="80">
                                    </div> 
                                </div>
                                <div class="row">
                                   <label for="espacio" class="control-label col-md-1"></label>   
                                   <label for="cboArbol" class="control-label col-md-1">Nivel Arbol</label>  
                                    <div class="form-group col-md-3"> 
                                        <select class="form-control" id="cboArbol" name="cboarbol" style="width: 100%;">
                                            <option value="0">--Seleccione Nivel--</option>
                                            <?php foreach($datos as $fila): ?>
                                                <option value="<?=$fila['Codigo']?>"><?=$fila['Descripcion']?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <br>    
                            </fieldset>
                        </form>    
                      </div>
                      <div class="tab-pane fade" id="contacto" role="tabpanel" aria-labelledby="contacto-tab">
                          <br>  
                          <div class="row">
                                <label for="espacio" class="control-label col-md-1"></label>
                                <label for="menuname" class="control-label col-md-1">Contacto</label>
                                <div class="form-group col-md-3">
                                    <input type="text" required class="form-control" id="txtContacto" name="contacto" placeholder="" maxlength="150" onKeyUp="this.value=this.value.toUpperCase();">
                                </div>
                                <label for="espacio" class="control-label col-md-1"></label>
                                <label for="cbomenupadre" class="control-label col-md-1">Cargo</label>
                                <div class="form-group col-md-3"> 
                                    <select class="form-control" id="cboCargo" name="cbocargo" style="width: 100%;">
                                            <option value="0">--Seleccione Cargo--</option>
                                            <?php foreach($cargo as $fila): ?>
                                                <option value="<?=$fila['Codigo']?>"><?=$fila['Descripcion']?></option>
                                            <?php endforeach ?>
                                    </select>
                                </div>
                         </div>
                         <div class="row">
                              <label for="espacio" class="control-label col-md-1"></label>
                              <label for="ext" class="control-label col-md-1">Ext</label>
                              <div class="form-group col-md-3">
                                  <input type="text" required class="form-control" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" id="txtExt" name="menuname" maxlength="10">
                              </div>
                                    <label for="espacio" class="control-label col-md-1"></label>
                                    <label for="celular" class="control-label col-md-1">Celular</label>
                                    <div class="form-group col-md-3">
                                        <input id="txtCelular" name="iconome" type="tel" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" class="form-control" maxlength="10">
                                    </div> 
                         </div>
                              <div class="row">
                                   <label for="espacio" class="control-label col-md-1"></label>
                                   <label for="email" class="control-label col-md-1">Email 1</label>
                                    <div class="form-group col-md-3">
                                        <input type="text" required class="form-control" id="txtEmail1" name="menuname" maxlength="80">
                                    </div>
                                    <label for="espacio" class="control-label col-md-1"></label>
                                    <label for="email" class="control-label col-md-1">Email 2</label>
                                    <div class="form-group col-md-3">
                                        <input id="txtEmail2" name="email" type="text" placeholder=" " class="form-control" maxlength="80">
                                    </div> 
                              </div>
                            <br>
                            <br>
                            <div class="row">
                                <label for="espacio" class="control-label col-md-11"></label>
                                <button type="button" class="btn btn-outline-success" id="btnContacto" style="margin-bottom:10px"><i class="fa fa-plus"></i></button>
                            </div>
                            <br>
                            <div class="col-md-10 col-sm-11">
                                <form method="post" id="user_form">
                                    <div class="table-responsive">
                                        <table id="tblcontacto" class="table table-striped table-border table-condensed table-info"  style="width: 100%;">
                                            <thead class="text-center">
                                                <tr> 
                                                    <th style="display: none;">Id</th>
                                                    <th>Contacto</th>
                                                    <th>Cargo</th>
                                                    <th>Celular</th>
                                                    <th>Ext</th>
                                                    <th>Email</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody> 
                                        </table>
                                    </div> 
                                </form>                                 
                            </div>
                        </div>
                      <div class="tab-pane fade" id="producto" role="tabpanel" aria-labelledby="producto-tab">
                              
                        <!-- start accordion -->
                        <button type="button" class="btn btn-info btn-block" data-toggle="collapse" data-target="#demo">
                        Producto
                        </button>

                        <div id="demo" class="collapse in">
                        <br>  
                                <div class="row">
                                    <label for="espacio" class="control-label col-md-1"></label>
                                    <label for="menuname" class="control-label col-md-1">Producto</label>
                                        <div class="form-group col-md-7">
                                            <input type="text" required class="form-control" id="txtProducto" name="producto" placeholder="" maxlength="150">   
                                        </div>
                                        <div class="form-group col-md-2">
                                        <button type="button" class="btn btn-outline-success" id="btnProducto" style="margin-bottom:10px"><i class="fa fa-plus"></i></button> 
                                        </div>                        
                                </div>
                                <div class="row">
                                    <label for="espacio" class="control-label col-md-1"></label>
                                    <label for="menuname" class="control-label col-md-1">Descripcion</label>
                                        <div class="form-group col-md-9">
                                            <!-- <input type="text" required class="form-control" id="txtDescripcion" name="descripcion" placeholder="" maxlength="250"> -->
                                            <textarea name="observa" id="txtDescripcion" class="form-control col-md-9" maxlength="250" 
                                            onkeydown = "return (event.keyCode!=13);"></textarea>  
                                        </div>                    
                                </div>
                                <br>
                                <div class="col-md-10 col-sm-10">
                                    <form method="post" id="user_form">
                                        <div class="table-responsive">
                                            <table id="tblproducto" class="table table-striped table-border table-condensed table-info"  style="width: 100%;">
                                                <thead class="text-center">
                                                    <tr> 
                                                        <th style="display: none;">Id</th>
                                                        <th>Producto</th>
                                                        <th>Estado</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody> 
                                            </table>
                                        </div> 
                                    </form>                                 
                               </div>    
                        </div>
                          
                      <button type="button" class="btn btn-info  btn-block" data-toggle="collapse" data-target="#catalogo">
                      Catalogo Producto
                      </button>
                      
                      <div id="catalogo" class="collapse in">
                            <br>
                            <div class="row">
                                <label for="espacio" class="control-label col-md-1"></label>
                                <label for="espacio" class="control-label col-md-1">Producto</label>
                                <label for="cbomenupadre" class="control-label col-md-1"></label>
                                <div class="form-group col-md-5"> 
                                    <select class="form-control" id="cboProducto" name="cboproducto">
                                            <?php foreach($menump as $fila): ?>
                                                <option value="<?=$fila['Codigo']?>"></option>
                                            <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <button type="button" class="btn btn-outline-success" id="btnContalogoPro" style="margin-bottom:10px"><i class="fa fa-plus"></i></button> 
                                </div>                    
                            </div>
                                  <br>
                                  <br>
                            <div class="row">
                                  <label for="espacio" class="control-label col-md-1"></label>
                                  <label for="menuname" class="control-label col-md-2">Codigo Catalogo</label>
                                  <div class="form-group col-md-3">
                                      <input type="text" required class="form-control" id="txtCatalogo" name="catalogo" placeholder="" maxlength="80">
                                  </div>
                                    <label for="iconome" class="control-label col-md-2">Catalogo Producto</label>
                                  <div class="form-group col-md-3">
                                      <input id="txtCatProd" name="iconome" type="text" placeholder=" " class="form-control" maxlength="80">
                                  </div>                
                            </div>
                            <div class="row">
                                  <label for="espacio" class="control-label col-md-1"></label>    
                                  <label for="menuname" class="control-label col-md-2">Codigo Familia</label>
                                  <div class="form-group col-md-3">
                                    <input type="text" required class="form-control" id="txtCodFa" name="menuname" placeholder="" maxlength="10">
                                  </div>
                                  
                                  <label for="iconome" class="control-label col-md-2">Familia</label>
                                  <div class="form-group col-md-3">
                                    <input id="txtFamilia" name="iconome" type="text" placeholder=" " class="form-control" maxlength="250">
                                  </div>                  
                            </div>
                            <br>
                            <div class="col-md-10 col-sm-10">
                                <form method="post" id="user_form">
                                    <div class="table-responsive">
                                        <table id="tblcatalogo" class="table table-striped table-border table-condensed table-info"  style="width: 100%;">
                                            <thead class="text-center">
                                                <tr> 
                                                    <th style="display: none;">Id</th>
                                                    <th>Producto</th>
                                                    <th>Cod.Catalogo</th>
                                                    <th>Catalogo</th>
                                                    <th>Familia</th>
                                                    <th>Estado</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody> 
                                        </table>
                                    </div> 
                                </form>                                 
                            </div>
                      </div>
                    <!-- end of accordion -->
                              
                      </div>
                      <div class="tab-pane fade" id="agencia" role="tabpanel" aria-labelledby="agencia-tab">
                              </br>
                              <div class="row">
                              <label for="espacio" class="control-label col-md-1"></label>
                                <label for="menuname" class="control-label col-md-1">Codigo</label>
                                <div class="form-group col-md-3">
                                 <input type="text" required class="form-control" id="txtCodigo" name="menuname" placeholder="" maxlength="10" onKeyUp="this.value=this.value.toUpperCase();">
                                </div>
                                <label for="espacio" class="control-label col-md-1"></label>
                                <label for="cbomenupadre" class="control-label col-md-1">Agencia</label>
                                <div class="form-group col-md-3"> 
                                <input type="text" required class="form-control" id="txtAgencia" name="menuname" placeholder="" maxlength="250" onKeyUp="this.value=this.value.toUpperCase();"> 
                                </div>
                                <div class="form-group col-md-2">
                                    <button type="button" class="btn btn-outline-success" id="btnAgencia" style="margin-bottom:10px"><i class="fa fa-plus"></i></button> 
                                </div>          
                              </div>
                              <div class="row">
                                <label for="espacio" class="control-label col-md-1"></label>
                                <label for="menuname" class="control-label col-md-1">Sucursal</label>
                                <div class="form-group col-md-3">
                                <select class="form-control" id="cboSucursal" name="cbosucursal" style="width: 100%;">
                                           <option value="0">--Seleccione Sucursal--</option>
                                            <?php foreach($sucursal as $fila): ?>
                                                <option value="<?=$fila['Codigo']?>"><?=$fila['Descripcion']?></option>
                                            <?php endforeach ?>
                                    </select>
                                </div>
                                <label for="espacio" class="control-label col-md-1"></label>
                                <label for="cbomenupadre" class="control-label col-md-1">Zona</label>
                                <div class="form-group col-md-3"> 
                                   
                                    <select class="form-control" id="cboZona" name="cbozona" style="width: 100%;">
                                            <option value="0">--Seleccione Zona--</option>
                                            <?php foreach($zona as $fila): ?>
                                                <option value="<?=$fila['Codigo']?>"><?=$fila['Descripcion']?></option>
                                            <?php endforeach ?>
                                    </select>
                                </div>       
                              </div>
                              <br>
                              <div class="col-md-10 col-sm-11">
                                <form method="post" id="user_form">
                                    <div class="table-responsive">
                                        <table id="tblagencia" class="table table-striped table-border table-condensed table-info"  style="width: 100%;">
                                            <thead class="text-center">
                                                <tr> 
                                                    <th style="display: none;">Id</th>
                                                    <th>Agencia</th>
                                                    <th>Codigo</th>
                                                    <th>Sucursal</th>
                                                    <th>Zona</th>
                                                    <th>Estado</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody> 
                                        </table>
                                    </div> 
                                </form>                                 
                            </div>
                              <br>
                              <br>
                              <br>
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
        </div>
    </div>
  </div>   
</div>

<div class="modal fade" id="modalPARAMETER" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 35%" role="document">
            <div class="modal-content" id="myModal">
                <div class="modal-header" id="header">
                    <h5 class="modal-title" id="modalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formContacto">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="contacto" class="col-form-label">Contacto</label>
                            <input type="text" id="txtContacto" required class="form-control" maxlength="150" onKeyUp="this.value=this.value.toUpperCase();">
                        </div>
                        <div class="form-group">
                            <label for="valorv" class="col-form-label">Celular</label>
                            <input type="text" id="txtCelular" class="form-control" maxlength="10" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;">
                        </div>
                        <div class="form-group">
                            <label for="valori" class="col-form-label">Ext</label>
                            <input type="text" id="txtExt" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" class="form-control" maxlength="10">
                        </div>                                            
                
                        <div class="form-group">
                            <label for="email" class="col-form-label">Email</label>
                            <input type="text" id="txtEmail" required class="form-control" maxlength="80">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="row_id" id="hidden_row_id" />
                        <button type="button" id="btnAgregarCon" class="btn btn-success ml-3"><i class='fa fa-plus'></i> Agregar</button>
                        <!-- <button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i class='fa fa-close'></i></button> -->
                        
                    </div>
                </form>
            </div>
        </div>
    </div>  

<?php require_once '../dashmenu/panel_footer.php'; ?>
<script src="../codejs/cedente.js" type="text/javascript"></script>

</body>

</html>