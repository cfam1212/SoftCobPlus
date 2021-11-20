<?php

require_once '../dashmenu/panel_menu.php'; 

$mensaje = (isset($_POST['mensaje'])) ? $_POST['mensaje'] : '';
$paraid = (isset($_POST['id'])) ? $_POST['id'] : '';

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(32,$_SESSION["i_emprid"],'','','','','','',$paraid,0,0,0,0,0));
$datapara = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(33,$_SESSION["i_emprid"],'','','','','','',$paraid,0,0,0,0,0));
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<input type="hidden" id="paraid" value="<?php echo $paraid ?>">
<div class="right_col" role="main"> 
    <input type="hidden" id="mensaje" value="<?php echo $mensaje ?>">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>EDITAR PARAMETRO</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                   
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                                                                                   
                  <div class="x_content">
                    <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="parametro-tab" data-toggle="tab" href="#parametro" role="tab" aria-controls="parametro" aria-selected="true">Datos Parámetro</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="detalle-tab" data-toggle="tab" href="#detalle" role="tab" aria-controls="detalle" aria-selected="false">Detalles</a>
                      </li>

                    </ul>
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="parametro" role="tabpanel" aria-labelledby="parametro-tab">
                      <br>
                      <form class="form-horizontal" role="form">      
                            <fieldset>
                                <div class="row">
                                    <label for="espacio" class="control-label col-md-1"></label>
                                    <label for="menuname" class="control-label col-md-1">Parámetro:</label>
                                    <div class="form-group col-md-3">
                                      <input type="text" required class="form-control" id="txtParametro" onKeyUp="this.value=this.value.toUpperCase();" maxlength="80" name="parametro" value="<?php echo $datapara[0]['parametro'] ?>" >
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="espacio" class="control-label col-md-1"></label>
                                    <label for="menuname" class="control-label col-md-1">Descripción:</label> 
                                    <div class="form-group col-md-10">                                    
                                        <textarea name="observa" id="txtDescripcion" class="form-control col-md-8"><?php echo $datapara[0]['descripcion'] ?></textarea>                                        
                                   </div> 
                                </div>
                                <div class="row">
                                    <label for="espacio" class="control-label col-md-1"></label>
                                    <label for="estado" class="control-label col-md-1">Estado:</label> 
                                    <div class="form-check" id="divcheck">
                                      <input type="checkbox" class="form-check-input" id="chkEstadoCab">
                                      <label for="estadolabel" class="form-check-label" id="lblEstadoCab"><?php echo $datapara[0]['estado'] ?></label>
                                  </div>
                                </div>
                                   
                            </fieldset>
                        </form> 
                        <br>
                        <br>
                            <div class='btn-group'>
                                <button class="btn btn-outline-primary" id = "btnRegresar" ><i class='fa fa-undo'></i> Regresar</button>
                                <button class="btn btn-outline-success ml-3 float-end" id="btnSave"><i class='fa fa-save'></i> Guardar</button>
                            </div>
                            
                      </div>
                      <div class="tab-pane fade" id="detalle" role="tabpanel" aria-labelledby="detalle-tab">
                            <div class="row">
                                    <label for="espacio" class="control-label col-md-11"></label>
                                    <button type="button" class="btn btn-outline-success" id="btnAdd" style="margin-bottom:10px"><i class="fa fa-plus"></i></button>
                            </div>
                        
                        <br>
                        <br>
                        <div class="col-md-12 col-sm-12">
                            <div class="col-md-1 col-sm-1">
                            </div>
                            <div class="col-md-10 col-sm-10">
                                <form method="post" id="user_form">
                                    <div class="table-responsive">
                                        <table id="tblparameter" class="table table-striped table-border table-condensed table-info"  style="width: 100%;">
                                            <thead class="text-center">
                                                <tr> 
                                                    <th style="display: none;">NOrden</th>
                                                    <th>Detalle</th>
                                                    <th>Valor Texto</th>
                                                    <th>Valor Entero</th>
                                                    <th>Estado</th>
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
                                                <td>
                                                    <?php echo $dat['Detalle']; ?>
                                                    <input type="hidden" name="hidden_detalle[]" id="txtDetalle<?php echo $dat['Orden'];?>" value="<?php echo $dat['Detalle']; ?>"/>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $dat['ValorV']; ?>
                                                    <input type="hidden" name="hidden_valorv[]" id="txtValorv<?php echo $dat['Orden'];?>" value="<?php echo $dat['ValorV']; ?>"/>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $dat['ValorI']; ?>
                                                    <input type="hidden" name="hidden_valori[]" id="txtValori<?php echo $dat['Orden'];?>" value="<?php echo $dat['ValorI']; ?>"/>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $dat['Estado']; ?>
                                                    <input type="hidden" name="hidden_estado[]" id="txtEstado<?php echo $dat['Orden'];?>" value="<?php echo $dat['Estado']; ?>"/>
                                                </td>
                                                <td>
                                                    <?php
                                                        if($dat['Orden'] == '1'){
                                                            $desactivar = "disabled";
                                                        }else{
                                                            $desactivar = '';
                                                        }
                                                    ?>
                                                    <div class="text-center">
                                                        <div class="btn-group">
                                                            <button type="button" name="btnUp" class="btn btn-outline-primary btn-sm btnUp" id="btnUp<?php echo $dat['Orden']; ?>"<?php echo $desactivar; ?>><i class="fa fa-arrow-up"></i></button>
                                                            <button type="button" name="btnEdit" class="btn btn-outline-info btn-sm ml-3 btnEdit" id=<?php echo $dat['Orden'];?>><i class="fa fa-pencil-square-o"></i></button>
                                                            <button type="button" name="btnDelete" class="btn btn-outline-danger btn-sm ml-3" id="<?php echo $dat['Orden']; ?>" disabled><i class="fa fa-trash-o"></i></button>                                                        
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
                            <div class="col-md-1 col-sm-1">
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
                <form id="formParam">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="detalle" class="col-form-label">Detalle</label>
                            <input type="text" id="txtDetalle" required class="form-control" maxlength="80" onKeyUp="this.value=this.value.toUpperCase();">
                        </div>
                        <div class="form-group">
                            <label for="valorv" class="col-form-label">Valor Text</label>
                            <input type="text" id="txtValorv" class="form-control" maxlength="255" onKeyUp="this.value=this.value.toUpperCase();">
                        </div>
                        <div class="form-group">
                            <label for="valori" class="col-form-label">Valor Entero</label>
                            <input type="text" id="txtValori" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" class="form-control" maxlength="5">
                        </div>                                            
                        <div class="form-check" id="divcheckedit">
                            <input type="checkbox" id="chkEstado" class="form-check-input">
                            <label for="estadolabel" class="form-check-label" id="lblEstado"></label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="row_id" id="hidden_row_id" />
                        <button type="button" id="btnAgregar" class="btn btn-success ml-3"><i class='fa fa-plus'></i> Agregar</button>
                        <!-- <button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i class='fa fa-close'></i></button> -->
                        
                    </div>
                </form>
            </div>
        </div>
    </div>  


<?php require_once '../dashmenu/panel_footer.php'; ?>
<script src="../codejs/paraedit.js" type="text/javascript"></script>

</body>

</html>