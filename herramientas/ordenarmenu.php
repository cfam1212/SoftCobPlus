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

<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Ordenar Menu</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up fa-1x"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <div class="container top">
                            <div class="row sortable" id="drop-items">
                                <?php
                                foreach ($data as $dataDrag_Drop) {
                                ?>
                                    <div class="col-md-6 col-lg-4" data-index="<?php echo $dataDrag_Drop['MenuId']; ?>" data-position="<?php echo $dataDrag_Drop['Posicion']; ?>">
                                        <div class="drop__card">
                                            <div class="drop__data">
                                                <i class="<?php echo $dataDrag_Drop['Icono']; ?>" id="icono"></i>
                                                <div>
                                                    <h2 class="drop__name"><?php echo $dataDrag_Drop['Menu']; ?></h2>
                                                    <span class="drop__profession"></span>
                                                </div>
                                            </div>
                                            <div class="circulo">
                                                <h2><?php echo $dataDrag_Drop['Posicion']; ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                    <br />
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<?php require_once '../dashmenu/panel_footer.php'; ?>
<script src="../codejs/ordenarmenu.js" type="text/javascript"></script>

</body>

</html>