<?php
    session_start();

    require_once("conexion.php");
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    $data = null;

    $empreid = $_SESSION["i_emprid"];

    $in_tipo = (isset($_POST['tipo'])) ? $_POST['tipo'] : '';
    $in_orden = (isset($_POST['orden'])) ? $_POST['orden'] : '';

    foreach($in_orden as $position) {
        $in_menuid = $position[0];
        $in_neworden = $position[1];

        if($in_menuid != ''){
            $consulta = "CALL sp_Ordenar_Menu(?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array($in_tipo,$empreid,$in_menuid,$in_neworden));
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        }
     }

    print json_encode($data, JSON_UNESCAPED_UNICODE);

    $conexion = null;
?>