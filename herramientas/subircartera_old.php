<?php

require_once '../dashmenu/panel_menu.php';

@session_start();
    
if(isset($_SESSION["s_usuario"])){
    if($_SESSION["s_login"] != "loged"){
        header("Location: ./logout.php");
        exit();
    } else{
    }
} else{
    header("Location: ./logout.php");
    exit();
}

$consulta = "CALL sp_New_Cartera(?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(1, 0, 0, 0, 0, '', '', '', '', '', 0, 0, 0));
$dataciu = $resultado->fetchAll(PDO::FETCH_ASSOC);

$menuid = (isset($_POST['id'])) ? $_POST['id'] : '';
$subiocartera = (isset($_POST['subiocartera'])) ? $_POST['subiocartera'] : '';

?>
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <input type="hidden" id="subircartera" value="<?php echo $subiocartera ?>">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Subir Cartera</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <br />
                        <form method="post" class="form-horizontal col-md-12" id="subircartera" enctype="multipart/form-data">
                            <br/>
                            
                            <div class="form-group row">
                                <label for="ciudad" class="control-label col-md-1">Ciudad:</label>
                                <div class="col-md-4 col-sm-8">
                                    <select class="form-control" id="cboCiudad" name="cbociudad" style="width: 100%;">
                                        <option value="0">--Seleccione Cuidad--</option>
                                        <?php foreach ($dataciu as $fila) : ?>
                                            <option value="<?= $fila['Codigo'] ?>"><?= $fila['Descripcion'] ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <label for="espacio" class="control-label col-md-1"></label>
                                <label for="cedente" class="control-label col-md-1">Cedente:</label>
                                <div class="col-md-4 col-sm-8">
                                    <select class="form-control" id="cboCedente" name="cbocedente" style="width: 100%;">
                                        <option value="0">--Seleccione Cedente--</option>
                                    </select>
                                </div>
                            </div>
                            <br/>
                            <br/>
                            <div class="form-group row">
                                <label for="producto" class="control-label col-md-1">Producto:</label>
                                <div class="col-md-4 col-sm-8">
                                    <select class="form-control" id="cboProducto" name="cboproducto" style="width: 100%;">
                                        <option value="0">--Seleccione Producto--</option>
                                    </select>
                                </div>
                                <label for="espacio" class="control-label col-md-1"></label>
                                <label for="catalogo" class="control-label col-md-1">Catalogo:</label>
                                <div class="col-md-4 col-sm-8">
                                    <select class="form-control" id="cboCatalogo" name="cbocatalogo" style="width: 100%;">
                                        <option value="0">--Seleccione Catalogo--</option>
                                    </select>
                                </div>
                            </div>
                            <br />
                            <br />
                            <br />
                            <div class="form-group row">
                                <label for="espacio" class="control-label col-md-3"></label>
                                <div class="wrapper" id="container">
                                    <input type="file" accept=".txt" id="file_input" name="file_input" class="file" hidden>
                                    <i class="fa fa-cloud-upload"></i>
                                    <p>Browse File to Upload</p>
                                    <span>
                                        <strong>Archivo Seleccionado:</strong>
                                        <span id="file_name">Ninguno</span>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="custom-file">
                                    <script>
                                        function crearTabla(data) {
                                            const todasFilas = data.split(/\r?\n|\r/);
                                            let tabla = '<table id="tablecartera" class="table table-striped jambo_table bulk_action table-borderless" style="width: 100%;">';
                                            for (let fila = 0; fila < todasFilas.length; fila++) {
                                                if (fila === 0) {
                                                    tabla += '<thead>';
                                                    tabla += '<tr>';
                                                } else {
                                                    tabla += '<tr>';
                                                }
                                                const celdasFila = todasFilas[fila].split('\t');
                                                for (let rowCell = 0; rowCell < celdasFila.length; rowCell++) {
                                                    if (fila === 0) {
                                                        tabla += '<th>';
                                                        tabla += celdasFila[rowCell];
                                                        tabla += '</th>';
                                                    } else {
                                                        tabla += '<td>';
                                                        if (rowCell === 3) {
                                                            //tabla += '<img src="'+celdasFila[rowCell]+'">';
                                                        } else {
                                                            tabla += celdasFila[rowCell];
                                                        }
                                                        tabla += '</td>';
                                                    }
                                                }
                                                if (fila === 0) {
                                                    tabla += '</tr>';
                                                    tabla += '</thead>';
                                                    tabla += '<tbody>';
                                                } else {
                                                    tabla += '</tr>';
                                                }
                                            }
                                            tabla += '</tbody>';
                                            tabla += '</table>';
                                            document.querySelector('#tablares').innerHTML = tabla;
                                        }

                                        function abrirArchivo(evento) {

                                            let archivo = evento.target.files[0];

                                            if (archivo) {
                                                let reader = new FileReader();

                                                reader.onload = function(e) {
                                                    crearTabla(e.target.result)
                                                    /*let contenido = e.target.result;
                                                    document.getElementById('contenido').innerHTML = contenido;*/
                                                };

                                                reader.readAsText(archivo);

                                            } else {
                                                document.getElementById('mensajes').innerHTML = 'No se ha seleccionado ningun archivo';
                                            }
                                        }

                                        /*window.addEventListener('load',() => {
                                            document.getElementById('txtArchivo').addEventListener('change', abrirArchivo);
                                        });*/

                                        document.querySelector('#file_input').addEventListener('change', abrirArchivo, false);
                                    </script>
                                </div>
                            </div>
                            <label for="espacio" class="control-label col-md-3"></label>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" id="btnProcesar" name="btnProcesar" class="btn btn-outline-info"><i class="fa fa-gears"></i> Procesar</button>
                            </div>
                            <br />
                            <br />
                            <label for="espacio" class="control-label col-md-3"></label>
                            <div id="progressBar">
                                <div id="progressbar">

                                </div>
                            </div>
                            <br />
                            <h2 id="status"></h2> <br />
                            <p id="loades_n_total"></p>
                            <div class="form-group row">
                                <div id="tablares" style="display: none;">

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../dashmenu/panel_footer.php'; ?>
<script src="../codejs/herramientas.js" type="text/javascript"></script>

<script></script>
</body>

</html>