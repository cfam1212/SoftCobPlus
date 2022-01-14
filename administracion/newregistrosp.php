<?php

require_once '../dashmenu/panel_menu.php';

$mensaje = (isset($_POST['mensaje'])) ? $_POST['mensaje'] : '';

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(37, $_SESSION["i_emprid"], 'Gestor', '', '', '', '', '', 0, 0, 0, 0, 0, 0));
$gestor = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(37, $_SESSION["i_emprid"], 'Supervisor', '', '', '', '', '', 0, 0, 0, 0, 0, 0));
$super = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "CALL sp_New_Cedente(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(2, $_SESSION["i_emprid"], 0, 0, 0, '', '', '', '', '', '', '', '', 0, '', '', '', 0, 0, 0, 0, ''));
$cedente = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consulta = "CALL sp_New_Supervisor(?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(0, 0, 0, '', '', '', 0, 0, 0, ''));
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
            <h2>REGISTRO SUPERVISORES Y GESTORES</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">
            <div class="float-left">
              <button class="btn btn-outline-success ml-3" id="btnAddSu" data-toggle="modal" data-target="#exampleModal" data-placement="top" title="agregar"><i class='fa fa-plus'></i></button>
            </div>
            <br />
            <br />
            <table id="tabledatasup" class="table table-striped jambo_table table-condensed table-dark table-borderless" style="width: 100%;">
              <thead>
                <tr>
                  <th>IdSupervisor</th>
                  <th>IdCedente</th>
                  <th>Cedente</th>
                  <th>Supervisor</th>
                  <th>Estado</th>
                  <th style="text-align: center;">Opciones</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($data as $datos) {
                ?>
                  <tr>
                    <td><?php echo $datos['IdSupe'] ?></td>
                    <td><?php echo $datos['IdCede'] ?></td>
                    <td><?php echo $datos['Cedente'] ?></td>
                    <td><?php echo $datos['Supervisor'] ?></td>
                    <td><?php echo $datos['Estado'] ?></td>
                    <td>
                      <div class="text-center">
                        <div class="btn-group">
                          <button class="btn btn-outline-info btn-sm ml-3" id="btnEditar" data-toggle="tooltip" data-placement="top" title="editar">
                            <i class="fa fa-pencil-square-o"></i></button>
                          <button class="btn btn-outline-danger btn-sm ml-3" id="btnEliminar" data-toggle="tooltip" data-placement="top" title="eliminar">
                            <i class="fa fa-pencil-square-o"></i>
                          </button>
                          <button class="btn btn-outline-danger btn-sm ml-3" id="btnEliminar" data-toggle="tooltip" data-placement="top" title="eliminar">
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
            <br />
            <br />
            <br />
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="superModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="myModalBg">
      <div class="modal-header" id="header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Registro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formSuper">
        <div class="modal-body">
          <fieldset>
            <div class="row">
              <label for="cedente" class="control-label col-md-1">Cedente</label>
              <label for="espacio" class="control-label col-md-1"></label>
              <div class="form-group col-md-7">
                <select class="form-control" id="cboCedente" name="cbocedente" style="width:100%;">
                  <option value="0">--Seleccione Cedente--</option>
                  <?php foreach ($cedente as $fila) : ?>
                    <option value="<?= $fila['Codigo'] ?>"><?= $fila['Descripcion'] ?>
                    </option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
            <div class="row">
              <label for="supervisor" class="control-label col-md-1">Supervisor</label>
              <label for="espacio" class="control-label col-md-1"></label>
              <div class="form-group col-md-7">
                <select class="form-control" id="cboSupervisor" name="cbosupervisor" style="width:100%;">
                  <option value="0">--Seleccione Supervisor--</option>
                  <?php foreach ($super as $fila) : ?>
                    <option value="<?= $fila['Codigo'] ?>"><?= $fila['Descripcion'] ?>
                    </option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
          </fieldset>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success ml-3" id="btnSaveSu"><i class='fa fa-plus'></i> Agregar</button>
        </div>
      </form>
    </div>
  </div>
</div>



<?php require_once '../dashmenu/panel_footer.php'; ?>
<script src="../codejs/registrosp.js" type="text/javascript"></script>

</body>

</html>