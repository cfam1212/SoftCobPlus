<?php 

require_once '../dashmenu/panel_menu.php'; 

$mensaje = (isset($_POST['mensaje'])) ? $_POST['mensaje'] : '';

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(11,$_SESSION["i_emprid"],'','','','','','',0,0,0,0,0,0));
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
                        <h2>PERFILES</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                                                
                      <button type="button" class="btn btn-outline-primary" id="btnNuevo" style="margin-bottom:10px"><i class="fa fa-plus"></i></button>
                    
                    <div class="x_content">
                        <br />
                        <table id="tabledata" class="table table-striped jambo_table bulk_action" style="width: 100%;">
                        <thead>
                                    <tr>                            
                                        <th>Id</th>
                                        <th>Perfil</th>
                                        <th>Descipción</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>                        
                                <tbody>
                                    <?php
                                        if(count($data) == 1){
                                            $disablesub = 'disabled="disabled"';
                                        }else{
                                            $disablesub = '';
                                        }                                        
                                    foreach($data as $datos){
                                    ?>
                                        <?php

                                            if($datos['PerfilId']=='1'){
                                                $disabledel = 'disabled="disabled"';
                                            }else{
                                                $disabledel = '';
                                            }                                            
                                        ?>                                        
                                    <tr>
                                        <td><?php echo $datos['PerfilId'] ?></td>
                                        <td><?php echo $datos['Perfil'] ?></td>
                                        <td><?php echo $datos['Descripcion'] ?></td>
                                        <td><?php echo $datos['Estado'] ?></td>
                                        <td>
                                            <div class="text-center">
                                                <div class="btn-group">
                                                    <button class="btn btn-outline-info btn-sm ml-3" id="btnEditar">
                                                    <i class="fa fa-file"></i></button>
                                                    <button class="btn btn-outline-danger btn-sm ml-3" <?php echo $disabledel ?> id="btnEliminar">
                                                    <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>                                                                                                     
                                        </td>
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

<?php require_once '../dashmenu/panel_footer.php'; ?>
<script src="../codejs/perfil.js" type="text/javascript"></script>

</body>

</html>