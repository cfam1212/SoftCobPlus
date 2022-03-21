<?php
require_once '../dashmenu/panel_menu.php'; 

$consulta = "CALL sp_consulta_datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(26,$_SESSION["i_emprid"],'','','','','','',0,0,0,0,0,0));
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

 
?>
<div class="right_col" role="main"> 
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Deslogueo Usuario</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                                                
                                         
                    <div class="x_content">
                        <br />
                        <table id="tabledata" class="table table-striped jambo_table bulk_action table-borderless" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Usuario</th>
                                        <th>Perfil</th>
                                        <th>Estado</th>
                                        <th>Fecha Logueo</th>
                                        <th style="text-align: center;">Desloguear</th>
                                        <th style="text-align: center;">Resetear Password</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                  
                                    foreach($data as $datos){
                                     
                                        
                                    ?>  
                                        <tr>
                                            <td><?php echo $datos['Id'] ?></td>
                                            <td><?php echo $datos['Usuario'] ?></td>
                                            <td><?php echo $datos['Perfil'] ?></td>
                                            <td><?php echo $datos['Estado'] ?></td>
                                            <td><?php echo $datos['FechaLogueo'] ?></td>
                                            <td>
                                                <div class="text-center">
                                                    <button class="btn btn-outline-info btn-sm ml-3" id="btnDes">
                                                    <i class="fa fa-key"></i></button>                            
                                                </div> 
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <button class="btn btn-outline-primary btn-sm ml-3" id="btnReset">
                                                     <i class="fa fa-street-view"></i></button>                            
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
     <script src="../codejs/seguridad.js" type="text/javascript"></script>
   </body>
</html> 