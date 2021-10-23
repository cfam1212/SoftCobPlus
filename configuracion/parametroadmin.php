<?php

require_once '../dashmenu/panel_menu.php'; 

$mensaje = (isset($_POST['mensaje'])) ? $_POST['mensaje'] : '';

$consulta = "CALL sp_consulta_datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(31,0,'','','','','','',0,0,0,0,0,0));
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
?>
    <div class="right_col" role="main"> 
        <input type="hidden" id="mensaje" value="<?php echo $mensaje ?>">
        <div class="">
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Registro de parámetros</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                                                    
                        <button type="button" class="btn btn-outline-primary" id="btnNuevo" style="margin-bottom:10px"><i class="fa fa-plus"></i></button>
                        
                        <div class="x_content">
                            <br />
                            <table id="tabledata" class="table table-striped jambo_table bulk_action table-info" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Parámetro</th>
                                            <th>Descipción</th>
                                            <th>Estado</th>
                                            <th style="text-align: center;">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach($data as $datos){
                                        ?>  
                                            <tr>
                                                <td><?php echo $dat['ParaId'] ?></td>
                                                <td><?php echo $dat['Parametro'] ?></td>
                                                <td><?php echo $dat['Descripcion'] ?></td>
                                                <td><?php echo $dat['Estado'] ?></td>
                                                <td>
                                                    <div class="text-center">
                                                        <div class="btn-group">
                                                            <button class="btn btn-outline-info btn-sm ml-3" id="btnEditar">
                                                            <i class="fa fa-file"></i></button>
                                                            <button class="btn btn-outline-danger btn-sm ml-3" id="btnEliminar">
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
     <script src="../codejs/parametros.js" type="text/javascript"></script>
   </body>
</html> 