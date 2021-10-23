<?php 

require_once '../dashmenu/panel_menu.php'; 

$mensaje = (isset($_POST['mensaje'])) ? $_POST['mensaje'] : '';

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(17,$_SESSION["i_emprid"],'','','','','','',0,0,0,0,0,0));
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(19,$_SESSION["i_emprid"],'','','','','','',0,0,0,0,0,0));
$cboperfil = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "CALL sp_New_Departamento(?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(5,$_SESSION["i_emprid"],'','','','','',0,0,0,'',0,''));
$cbodepa = $resultado->fetchAll(PDO::FETCH_ASSOC);   

?>
<div class="right_col" role="main"> 
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Registro de Usuarios</h2>
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
                                        <th>Usuario</th>
                                        <th>Login</th>
                                        <th>Perfil</th>
                                        <th>Estado</th>
                                        <th style="text-align: center;">Opciones</th>
                                    </tr>
                                </thead>                        
                                <tbody>
                                    <?php
                                    foreach($data as $dat){
                                    ?>
                                        <?php
                                            if($dat['UserId']=='1'){
                                                $disabledel = 'disabled="disabled"';
                                            }else{
                                                $disabledel = '';
                                            }
                                        ?>
                                    <tr>
                                        <td><?php echo $dat['UserId'] ?></td>
                                        <td><?php echo $dat['Usuario'] ?></td>
                                        <td><?php echo $dat['Namelogin'] ?></td>
                                        <td><?php echo $dat['Perfil'] ?></td>
                                        <td><?php echo $dat['Estado'] ?></td>
                                        <td>
                                            <div class="text-center">
                                                <div class="btn-group">
                                                    <button class="btn btn-outline-info btn-sm ml-3" id="btnEditar">
                                                    <i class="fa fa-pencil-square-o"></i></button>
                                                    <button class="btn btn-outline-danger btn-sm ml-3" <?php echo $disabledel ?> id="btnEliminar">
                                                    <i class="fa fa-trash-o"></i>
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
<div class="modal fade" id="modalNewUser" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 65%" role="document">
        <div class="modal-content">
            <div class="modal-header" id="header">
                <h5 class="modal-title" id="modalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" id="frmUserNew"> 
                <div class="modal-body">                
                    <div class="form-group row">
                        <label for="username" class="control-label col-md-2">Nombres:</label>
                        <input type="text" required class="form-control col-md-4" id="txtUsername" name="username" maxlength="80" placeholder="Nombre del Usuario"> 
                        <label for="lastname" class="control-label col-md-2">Apellidos:</label>
                        <input type="text" required class="form-control col-md-4" id="txtLastname" name="lastname" maxlength="80" placeholder="Apellido del Usuario"></input>
                    </div>

                    <div class="form-group row">
                        <label for="login" class="control-label col-md-2">Login:</label>
                        <input type="text" required class="form-control col-md-4" id="txtLogin" name="login" maxlength="16" placeholder="Login"> 

                        <label for="password" class="control-label col-md-2">Password:</label>
                        <input type="password" required class="form-control col-md-4" id="txtPassword" name="password" maxlength="20" placeholder="Password"></input>
                    </div>

                    <div class="form-group row">
                        <label for="perfil" class="control-label col-md-2">Perfil:</label>
                        <select class="form-control col-md-4" id="cboPerfil" name="cboperfil">
                            <?php foreach($cboperfil as $fila): ?>
                                <option value="<?=$fila['Codigo']?>"><?=$fila['Descripcion']?></option>
                            <?php endforeach ?>
                        </select>
                        <label for="estado" class="control-label col-md-2">Estado:</label>
                        <div class="checkbox col-md-4">
                            <input type="checkbox" id="chkEstado"></input>
                            <label for="estadolabel" class="form-check-label" id="lblEstado">Activo</label>
                        </div>                                                 
                    </div>
                    <div class="form-group row">
                        <label for="perfil" class="control-label col-md-2">Departamento:</label>
                        <select class="form-control col-md-4" id="cboDepa" name="cbodepa">
                            <?php foreach($cbodepa as $fila): ?>
                                <option value="<?=$fila['Codigo']?>"><?=$fila['Descripcion']?></option>
                            <?php endforeach ?>
                        </select>
                                                                      
                    </div>

                    <div class="form-group row">
                        <label for="caduca" class="control-label col-md-2">Password Caduca:</label>
                        <div class="checkbox col-md-4">
                            <input type="checkbox" id="chkCaduca"></input>
                            <label class="form-check-label" id="lblCaduca">NO</label>
                        </div>   
                        <label for="fechacaduca" class="control-label col-md-2">Fecha Caduca:</label>
                        <input type="text" class="form-control col-md-4" id="txtFechacaduca" maxlength="50" disabled placeholder="MM/dd/yyyy "></input>
                    </div>

                    <div class="form-group row">
                        <label for="cambiar" class="control-label col-md-2">Cambiar Password:</label>
                        <div class="checkbox col-md-4">
                            <input type="checkbox" id="chkCambiar"></input>
                            <label class="form-check-label" id="lblCambiar">NO</label>
                        </div>   
                    </div>                                         

                    <div class="form-group row">
                        <label for="foto" class="control-label col-md-2">Imagen:</label>
                        <input type="file" accept="image/*" id="txtImagen" name="imagen"></input>
                        <div class="col-md-4">
                            <div class="card shadow">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Imagen</h6>
                                </div>
                                <div class="card-body">
                                    <div class="text-center" id="image-preview">
                                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 10rem;" src="../images/sin-user.png">
                                    </div>
                                </div>        
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-success ml-3" id="btnSave"><i class='fa fa-save'></i> Guardar</button> 
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i class='fa fa-close'></i></button>                
                </div>              
            </form>
        </div>
    </div>
</div>
<?php require_once '../dashmenu/panel_footer.php'; ?>
<script src="../codejs/usuarios.js" type="text/javascript"></script>

</body>

</html>