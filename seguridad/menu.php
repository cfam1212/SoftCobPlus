<?php
require_once '../dashmenu/panel_menu.php'; 

$mensaje = (isset($_POST['mensaje'])) ? $_POST['mensaje'] : '';

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(1,$_SESSION["i_emprid"],'','','','','','',0,0,0,0,0,0));
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

?>

<input type="hidden" id="mensaje" value="<?php echo $mensaje ?>">

<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Menu</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                                                
                      <button type="button" class="btn btn-outline-primary" id="btnNuevo" style="margin-bottom:10px"><i class="fa fa-plus"></i></button>
                    
                    <div class="x_content">
                        <br />
                      
                        <table id="tablenoorder" class="table table-striped jambo_table bulk_action" style="width: 100%;">
                                <thead>
                                    <tr>                            
                                        <th>Id</th>
                                        <th>Menu</th>
                                        <th>Icono</th>
                                        <th>Estado</th>
                                        <th style="text-align: center;">Opciones</th>
                                    </tr>
                                </thead>                        
                                <tbody>
                                    <?php
                                        if(count($data) == 0){
                                            $disablesub = 'disabled="disabled"';
                                        }else{
                                            $disablesub = '';
                                        }                                        
                                    foreach($data as $datos){
                                    ?>
                                        <?php

                                            if($datos['MenuId']=='200001'){
                                                $disabledel = 'disabled="disabled"';
                                            }else{
                                                $disabledel = '';
                                            }                                            
                                        ?>                                        
                                    <tr>
                                        <td><?php echo $datos['MenuId'] ?></td>
                                        <td><?php echo $datos['Menu'] ?></td>
                                        <td><?php echo $datos['Icono'] ?></td>
                                        <td><?php echo $datos['Estado'] ?></td>
                                        <td></td>
                                    </tr>
                                    <?php }
                                    ?>                          
                                </tbody>
                            </table>                        
                    </div>
                </div>
            </div>
        </div>
    </div>   
</div>

</div>     
     <?php require_once '../dashmenu/panel_footer.php'; ?>
     <script src="../codejs/menu.js" type="text/javascript"></script>
   </body>
</html> 