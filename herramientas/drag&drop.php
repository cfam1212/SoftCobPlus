<?php

require_once '../dashmenu/panel_menu.php';

@session_start();

if (isset($_SESSION["s_usuario"])) {
    if ($_SESSION["s_login"] != "loged") {
        header("Location: ./logout.php");
        exit();
    } else {
    }
} else {
    header("Location: ./logout.php");
    exit();
}


$consulta = "CALL sp_Consulta_Datos(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(1, $_SESSION["i_emprid"], '', '', '', '', '', '', 0, 0, 0, 0, 0, 0));
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

?>

<input type="hidden" id="txtusuaid" value="<?php echo $_SESSION["i_usuaid"] ?>">


<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
    </div>
    <div class="row py-5">
        <div class="col-md-3 col-sm-6">
        </div>
        <div class="col-md-6 col-sm-12">
            <br />
            <div class="x_panel">
                <div class="x_title">
                    <h2 style="text-align: center;">Ordenar Menu</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <div class="container top">
                        <div class="row sortable" id="drop-items">
                            <?php
                            foreach ($data as $dataDrag_Drop) {
                                
                            ?>
                                <div class="col-md-8" data-index="<?php echo $dataDrag_Drop['MenuId']; ?>" data-position="<?php echo $dataDrag_Drop['Posicion']; ?>">
                                    <div class="drop__card">
                                        <div class="drop__data">
                                            <i class="<?php echo $dataDrag_Drop['Icono'];?>" id="icono"></i>
                                            <div>
                                                <h4 class="drop__name"><?php echo $dataDrag_Drop['Menu']; ?></h4>
                                                <span class="drop__profession"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br/>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require_once '../dashmenu/panel_footer.php'; ?>
<script src="../codejs/drag&drop.js" type="text/javascript"></script>

</body>

</html>