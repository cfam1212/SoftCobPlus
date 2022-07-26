<?php

ini_set('display_errors', 0);

require_once '../dashmenu/panel_menu.php';
require_once '../funciones/funciones.php';

//$xServidor = $_SERVER['HTTP_HOST'];
//$xServerName = $_SERVER['SERVER_NAME'];

//echo $xServerName;
//exit(0);

@session_start();

$userid = $_SESSION["i_usuaid"];
$host = $_SESSION["s_namehost"];
$empreid = $_SESSION["i_emprid"];

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

$consulta = "CALL sp_New_Cartera(?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resultado = $conexion->prepare($consulta);
$resultado->execute(array(1, 0, 0, 0, 0, '', '', '', '', '', 0, 0, 0));
$dataciu = $resultado->fetchAll(PDO::FETCH_ASSOC);

//$menuid = (isset($_POST['id'])) ? $_POST['id'] : '';
//$subiocartera = (isset($_POST['subiocartera'])) ? $_POST['subiocartera'] : '';

$MostarData = 0;

if (isset($_POST['Enviar'])) {


    $cedenteid = safe($_POST['cbocedente']);
    $productoid = safe($_POST['cboProducto']);

    if (is_uploaded_file($_FILES['file_input']['tmp_name'])) {
        //echo "<h1>" . "File ". $_FILES['file_input']['name'] ." subido." . "</h1>";
        //echo "<h2>Datos subidos:</h2>";
        //readfile($_FILES['file_input']['tmp_name']);
        $type = $_FILES['file_input']['type'];
        $size = $_FILES['file_input']['size'];
    }

    if ($type == 'application/vnd.ms-excel' and $size < 100000) {
        //Import uploaded file to Database
        $handle = fopen($_FILES['file_input']['tmp_name'], "r");

        while (($data = fgetcsv($handle, 2000, ";")) !== FALSE) {
            if (str_contains($data[0], 'Cedula')) {
            } else {

                $nombrecompleto = $data[1] . ' ' . $data[2];

                $consulta = "CALL sp_Subir_Cartera_Persona(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute(array(
                    0, 'C', $data[0], $data[1], $data[2], $nombrecompleto, $data[3], 'M', $data[4],
                    $data[5], 'S', 'A', $userid, $host
                ));

                $personaid = $resultado->fetchColumn();

                $tipocliente = 'TIT';
                $tipotelefono = '';

                if ($data[21] != '') {

                    $primervalor = substr($data[21], 0, 1);
                    $segvalor = substr($data[21], 0, 2);
                    $largo = strlen($data[21]);

                    if (strlen($data[21]) > 8 || strlen($data[21]) < 11) {

                        switch ($segvalor) {
                            case "09":
                                $tipotelefono = 'CEL';
                                break;
                            case "02":
                            case "03":
                            case "04":
                            case "05":
                            case "06":
                            case "07":
                            case "08":
                                $tipotelefono = 'CON';
                                break;
                        }
                    }

                    if (strlen($data[21]) > 6 || strlen($data[21]) < 11) {

                        switch ($primervalor) {
                            case "9":
                                $tipotelefono = 'CEL';
                                if ($largo == 9) {
                                    $data[21] = '0' . $data[21];
                                }
                                break;

                            case "2":
                            case "3":
                            case "4":
                            case "5":
                            case "6":
                            case "7":
                            case "8":
                                $tipotelefono = 'CON';

                                if ($largo == 7) {
                                    $data[21] = '02' . $data[21];
                                }

                                if ($largo == 8) {
                                    $data[21] = '0' . $data[21];
                                }

                                break;
                        }

                        $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?)";
                        $resultado = $conexion->prepare($consulta);
                        $resultado->execute(array(
                            0, $cedeid, $personaid, 0, $data[21], $tipotelefono, $tipocliente, 0,
                            'A', $userid, $host
                        ));
                    }
                }

                if ($data[22] != '') {

                    $primervalor = substr($data[22], 0, 1);
                    $segvalor = substr($data[22], 0, 2);
                    $largo = strlen($data[21]);

                    if (strlen($data[22]) > 8 || strlen($data[22]) < 11) {

                        switch ($segvalor) {
                            case "09":
                                $tipotelefono = 'CEL';
                                break;
                            case "02":
                            case "03":
                            case "04":
                            case "05":
                            case "06":
                            case "07":
                            case "08":
                                $tipotelefono = 'CON';
                                break;
                        }
                    }

                    if (strlen($data[22]) > 6 || strlen($data[22]) < 11) {

                        switch ($primervalor) {
                            case "9":
                                $tipotelefono = 'CEL';
                                if ($largo == 9) {
                                    $data[22] = '0' . $data[22];
                                }
                                break;

                            case "2":
                            case "3":
                            case "4":
                            case "5":
                            case "6":
                            case "7":
                            case "8":
                                $tipotelefono = 'CON';

                                if ($largo == 7) {
                                    $data[22] = '02' . $data[22];
                                }

                                if ($largo == 8) {
                                    $data[22] = '0' . $data[22];
                                }

                                break;
                        }
                    }

                    $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute(array(
                        0, $cedeid, $personaid, 0, $data[22], $tipotelefono, $tipocliente, 0,
                        'A', $userid, $host
                    ));
                }

                if ($data[23] != '') {

                    $primervalor = substr($data[23], 0, 1);
                    $segvalor = substr($data[23], 0, 2);
                    $largo = strlen($data[23]);

                    if (strlen($data[23]) > 8 || strlen($data[23]) < 11) {

                        switch ($segvalor) {
                            case "09":
                                $tipotelefono = 'CEL';
                                break;
                            case "02":
                            case "03":
                            case "04":
                            case "05":
                            case "06":
                            case "07":
                            case "08":
                                $tipotelefono = 'CON';
                                break;
                        }
                    }

                    if (strlen($data[23]) > 6 || strlen($data[23]) < 11) {

                        switch ($primervalor) {
                            case "9":
                                $tipotelefono = 'CEL';
                                if ($largo == 9) {
                                    $data[23] = '0' . $data[23];
                                }
                                break;

                            case "2":
                            case "3":
                            case "4":
                            case "5":
                            case "6":
                            case "7":
                            case "8":
                                $tipotelefono = 'CON';

                                if ($largo == 7) {
                                    $data[23] = '02' . $data[23];
                                }

                                if ($largo == 8) {
                                    $data[23] = '0' . $data[23];
                                }

                                break;
                        }
                    }

                    $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute(array(
                        0, $cedenteid, $personaid, 0, $data[23], $tipotelefono, $tipocliente, 0,
                        $newestado, $currentdate, $userid, $host
                    ));
                }

                if ($data[24] != '') {

                    $primervalor = substr($data[24], 0, 1);
                    $segvalor = substr($data[24], 0, 2);
                    $largo = strlen($data[24]);

                    if (strlen($data[24]) > 8 || strlen($data[24]) < 11) {

                        switch ($segvalor) {
                            case "09":
                                $tipotelefono = 'CEL';
                                break;
                            case "02":
                            case "03":
                            case "04":
                            case "05":
                            case "06":
                            case "07":
                            case "08":
                                $tipotelefono = 'CON';
                                break;
                        }
                    }

                    if (strlen($data[24]) > 6 || strlen($data[24]) < 11) {

                        switch ($primervalor) {
                            case "9":
                                $tipotelefono = 'CEL';
                                if ($largo == 9) {
                                    $data[24] = '0' . $data[24];
                                }
                                break;

                            case "2":
                            case "3":
                            case "4":
                            case "5":
                            case "6":
                            case "7":
                            case "8":
                                $tipotelefono = 'CON';

                                if ($largo == 7) {
                                    $data[24] = '02' . $data[24];
                                }

                                if ($largo == 8) {
                                    $data[24] = '0' . $data[24];
                                }

                                break;
                        }
                    }


                    $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute(array(
                        0, $cedenteid, $personaid, 0, $data[24], $tipotelefono, $tipocliente, 0,
                        $newestado, $currentdate, $userid, $host
                    ));
                }

                if ($data[25] != '') {

                    $primervalor = substr($data[25], 0, 1);
                    $segvalor = substr($data[25], 0, 2);
                    $largo = strlen($data[25]);

                    if (strlen($data[25]) > 8 || strlen($data[25]) < 11) {

                        switch ($segvalor) {
                            case "09":
                                $tipotelefono = 'CEL';
                                break;
                            case "02":
                            case "03":
                            case "04":
                            case "05":
                            case "06":
                            case "07":
                            case "08":
                                $tipotelefono = 'CON';
                                break;
                        }
                    }

                    if (strlen($data[25]) > 6 || strlen($data[25]) < 11) {

                        switch ($primervalor) {
                            case "9":
                                $tipotelefono = 'CEL';
                                if ($largo == 9) {
                                    $data[25] = '0' . $data[25];
                                }
                                break;

                            case "2":
                            case "3":
                            case "4":
                            case "5":
                            case "6":
                            case "7":
                            case "8":
                                $tipotelefono = 'CON';

                                if ($largo == 7) {
                                    $data[25] = '02' . $data[25];
                                }

                                if ($largo == 8) {
                                    $data[25] = '0' . $data[25];
                                }

                                break;
                        }
                    }

                    $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute(array(
                        0, $cedenteid, $personaid, 0, $data[25], $tipotelefono, $tipocliente, 0,
                        $newestado, $currentdate, $userid, $host
                    ));
                }

                if ($data[26] != '') {

                    $primervalor = substr($data[26], 0, 1);
                    $segvalor = substr($data[26], 0, 2);
                    $largo = strlen($data[26]);

                    if (strlen($data[26]) > 8 || strlen($data[26]) < 11) {

                        switch ($segvalor) {
                            case "09":
                                $tipotelefono = 'CEL';
                                break;
                            case "02":
                            case "03":
                            case "04":
                            case "05":
                            case "06":
                            case "07":
                            case "08":
                                $tipotelefono = 'CON';
                                break;
                        }
                    }

                    if (strlen($data[26]) > 6 || strlen($data[26]) < 11) {

                        switch ($primervalor) {
                            case "9":
                                $tipotelefono = 'CEL';
                                if ($largo == 9) {
                                    $data[26] = '0' . $data[26];
                                }
                                break;
                            case "2":
                            case "3":
                            case "4":
                            case "5":
                            case "6":
                            case "7":
                            case "8":
                                $tipotelefono = 'CON';

                                if ($largo == 7) {
                                    $data[26] = '02' . $data[26];
                                }

                                if ($largo == 8) {
                                    $data[26] = '0' . $data[26];
                                }

                                break;
                        }
                    }

                    $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute(array(
                        0, $cedenteid, $personaid, 0, $data[26], $tipotelefono, $tipocliente, 0,
                        $newestado, $currentdate, $userid, $host
                    ));
                }

                if ($data[27] != '') {

                    $primervalor = substr($data[27], 0, 1);
                    $segvalor = substr($data[27], 0, 2);
                    $largo = strlen($data[27]);


                    if (strlen($data[27]) > 8 || strlen($data[27]) < 11) {

                        switch ($segvalor) {
                            case "09":
                                $tipotelefono = 'CEL';
                                break;
                            case "02":
                            case "03":
                            case "04":
                            case "05":
                            case "06":
                            case "07":
                            case "08":
                                $tipotelefono = 'CON';
                                break;
                        }
                    }

                    if (strlen($data[27]) > 6 || strlen($data[27]) < 11) {

                        switch ($primervalor) {
                            case "9":
                                $tipotelefono = 'CEL';
                                if ($largo == 9) {
                                    $data[27] = '0' . $data[27];
                                }
                                break;

                            case "2":
                            case "3":
                            case "4":
                            case "5":
                            case "6":
                            case "7":
                            case "8":
                                $tipotelefono = 'CON';

                                if ($largo == 7) {
                                    $data[27] = '02' . $data[27];
                                }

                                if ($largo == 8) {
                                    $data[27] = '0' . $data[27];
                                }

                                break;
                        }
                    }

                    $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute(array(
                        0, $cedenteid, $personaid, 0, $data[27], $tipotelefono, $tipocliente, 0,
                        $newestado, $currentdate, $userid, $host
                    ));
                }

                if ($data[28] != '') {

                    $primervalor = substr($data[28], 0, 1);
                    $segvalor = substr($data[28], 0, 2);
                    $largo = strlen($data[28]);

                    if (strlen($data[28]) > 8 || strlen($data[28]) < 11) {

                        switch ($segvalor) {
                            case "09":
                                $tipotelefono = 'CEL';
                                break;
                            case "02":
                            case "03":
                            case "04":
                            case "05":
                            case "06":
                            case "07":
                            case "08":
                                $tipotelefono = 'CON';
                                break;
                        }
                    }

                    if (strlen($data[28]) > 6 || strlen($data[28]) < 11) {

                        switch ($primervalor) {
                            case "9":
                                $tipotelefono = 'CEL';
                                if ($largo == 9) {
                                    $data[28] = '0' . $data[28];
                                }
                                break;

                            case "2":
                            case "3":
                            case "4":
                            case "5":
                            case "6":
                            case "7":
                            case "8":
                                $tipotelefono = 'CON';

                                if ($largo == 7) {
                                    $data[28] = '02' . $data[28];
                                }

                                if ($largo == 8) {
                                    $data[28] = '0' . $data[28];
                                }

                                break;
                        }
                    }


                    $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute(array(
                        0, $cedenteid, $personaid, 0, $data[28], $tipotelefono, $tipocliente, 0,
                        $newestado, $currentdate, $userid, $host
                    ));
                }

                if ($data[29] != '') {

                    $primervalor = substr($data[29], 0, 1);
                    $segvalor = substr($data[29], 0, 2);
                    $largo = strlen($data[29]);


                    if (strlen($data[29]) > 8 || strlen($data[29]) < 11) {

                        switch ($segvalor) {
                            case "09":
                                $tipotelefono = 'CEL';
                                break;
                            case "02":
                            case "03":
                            case "04":
                            case "05":
                            case "06":
                            case "07":
                            case "08":
                                $tipotelefono = 'CON';
                                break;
                        }
                    }

                    if (strlen($data[29]) > 6 || strlen($data[29]) < 11) {

                        switch ($primervalor) {
                            case "9":
                                $tipotelefono = 'CEL';
                                if ($largo == 9) {
                                    $data[29] = '0' . $data[29];
                                }
                                break;

                            case "2":
                            case "3":
                            case "4":
                            case "5":
                            case "6":
                            case "7":
                            case "8":
                                $tipotelefono = 'CON';

                                if ($largo == 7) {
                                    $data[29] = '02' . $data[29];
                                }

                                if ($largo == 8) {
                                    $data[29] = '0' . $data[29];
                                }

                                break;
                        }
                    }

                    $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute(array(
                        0, $cedenteid, $personaid, 0, $data[29], $tipotelefono, $tipocliente, 0,
                        $newestado, $currentdate, $userid, $host
                    ));
                }

                if ($data[30] != '') {

                    $primervalor = substr($data[30], 0, 1);
                    $segvalor = substr($data[30], 0, 2);
                    $largo = strlen($data[30]);

                    if (strlen($data[30]) > 8 || strlen($data[30]) < 11) {

                        switch ($segvalor) {
                            case "09":
                                $tipotelefono = 'CEL';
                                break;
                            case "02":
                            case "03":
                            case "04":
                            case "05":
                            case "06":
                            case "07":
                            case "08":
                                $tipotelefono = 'CON';
                                break;
                        }
                    }

                    if (strlen($data[30]) > 6 || strlen($data[30]) < 11) {

                        switch ($primervalor) {
                            case "9":
                                $tipotelefono = 'CEL';
                                if ($largo == 9) {
                                    $data[30] = '0' . $data[30];
                                }
                                break;

                            case "2":
                            case "3":
                            case "4":
                            case "5":
                            case "6":
                            case "7":
                            case "8":
                                $tipotelefono = 'CON';

                                if ($largo == 7) {
                                    $data[30] = '02' . $data[30];
                                }

                                if ($largo == 8) {
                                    $data[30] = '0' . $data[30];
                                }

                                break;
                        }
                    }

                    $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute(array(
                        0, $cedenteid, $personaid, 0, $data[30], $tipotelefono, $tipocliente, 0,
                        $newestado, $currentdate, $userid, $host
                    ));
                }

                //INSERTAR DIRECCION Y CORREO DEUDOR   
                $direcciondom = safe($data[6]);
                $referenciadom = safe($data[7]);
                if ($direcciondom != '') {
                    $tipodireccion = 'DIRECCION';
                    $definicion = 'DOM';

                    $consulta = "CALL sp_New_Direccion_Correos(?,?,?,?,?,?,?,?,?,?,?,?)";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute(array(
                        0, $cedula, '', $tipodireccion, $tipocliente, $definicion,
                        $direcciondom, $referenciadom, '', $currentdate, $userid, $host
                    ));
                }

                $direcciontra = safe($data[8]);
                $referenciatra = safe($data[9]);
                if ($direcciontra != '') {
                    $tipodireccion = 'DIRECCION';
                    $definicion = 'TRA';

                    $consulta = "CALL sp_New_Direccion_Correos(?,?,?,?,?,?,?,?,?,?,?,?)";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute(array(
                        0, $cedula, '', $tipodireccion, $tipocliente, $definicion,
                        $direcciontra, $referenciatra, '', $currentdate, $userid, $host
                    ));
                }

                $email = safe($data[10]);
                if ($email != '') {
                    $tipodireccion = 'CORREO';
                    $definicion = 'PER';

                    $consulta = "CALL sp_New_Direccion_Correos(?,?,?,?,?,?,?,?,?,?,?,?)";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute(array(
                        0, $cedula, '', $tipodireccion, $tipocliente, $definicion,
                        '', '', $email, $currentdate, $userid, $host
                    ));
                }

                // DEUDOR_REFERENCIA 1

                $tipocliente = 'FAM';
                $tipotelefono = 'CEL';

                $nombreref1 = safe($data[32]);
                $cedularef1 = safe($data[31]);
                $cedula = $data[0];

                if ($nombreref1 != '') {
                    if ($cedularef1 == '') {
                        $cedularef1 = $cedula;
                    }


                    $consulta = "CALL sp_New_Referencia_Deudor(?,?,?,?,?,?,?,?)";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute(array(0, $personaid, $cedularef1, $nombreref1, $tipocliente, $currentdate, $userid, $host));

                    $referenid = $resultado->fetchColumn();

                    //TELEFONO 1 REFERENCIA 1

                    $fono1ref1 = safe($data[33]);
                    if ($fono1ref1 != '') {

                        $primervalor = substr($fono1ref1, 0, 1);
                        $segvalor = substr($fono1ref1, 0, 2);
                        $largo = strlen($fono1ref1);

                        if (strlen($fono1ref1) > 8 || strlen($fono1ref1) < 11) {

                            switch ($segvalor) {
                                case "09":
                                    $tipotelefono = 'CEL';
                                    break;
                                case "02":
                                case "03":
                                case "04":
                                case "05":
                                case "06":
                                case "07":
                                case "08":
                                    $tipotelefono = 'CON';
                                    break;
                            }
                        }

                        if (strlen($fono1ref1) > 6 || strlen($fono1ref1) < 11) {

                            switch ($primervalor) {
                                case "9":
                                    $tipotelefono = 'CEL';
                                    if ($largo == 9) {
                                        $fono1ref1 = '0' . $fono1ref1;
                                    }
                                    break;

                                case "2":
                                case "3":
                                case "4":
                                case "5":
                                case "6":
                                case "7":
                                case "8":
                                    $tipotelefono = 'CON';

                                    if ($largo == 7) {
                                        $fono1ref1 = '02' . $fono1ref1;
                                    }

                                    if ($largo == 8) {
                                        $fono1ref1 = '0' . $fono1ref1;
                                    }

                                    break;
                            }
                        }


                        $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
                        $resultado = $conexion->prepare($consulta);
                        $resultado->execute(array(
                            0, $cedenteid, $personaid, $referenid, $fono1ref1, $tipotelefono, $tipocliente, 0,
                            $newestado, $currentdate, $userid, $host
                        ));
                    }

                    //TELEFONO 2  REFERENCIA 1

                    $fono2ref1 = safe($data[34]);
                    if ($fono2ref1 != '') {
                        $primervalor = substr($fono2ref1, 0, 1);
                        $segvalor = substr($fono2ref1, 0, 2);
                        $largo = strlen($fono2ref1);

                        if (strlen($fono2ref1) > 8 || strlen($fono2ref1) < 11) {

                            switch ($segvalor) {
                                case "09":
                                    $tipotelefono = 'CEL';
                                    break;
                                case "02":
                                case "03":
                                case "04":
                                case "05":
                                case "06":
                                case "07":
                                case "08":
                                    $tipotelefono = 'CON';
                                    break;
                            }
                        }


                        if (strlen($fono2ref1) > 6 || strlen($fono2ref1) < 11) {

                            switch ($primervalor) {
                                case "9":
                                    $tipotelefono = 'CEL';
                                    if ($largo == 9) {
                                        $fono2ref1 = '0' . $fono2ref1;
                                    }
                                    break;

                                case "2":
                                case "3":
                                case "4":
                                case "5":
                                case "6":
                                case "7":
                                case "8":
                                    $tipotelefono = 'CON';

                                    if ($largo == 7) {
                                        $fono2ref1 = '02' . $fono2ref1;
                                    }

                                    if ($largo == 8) {
                                        $fono2ref1 = '0' . $fono2ref1;
                                    }

                                    break;
                            }
                        }


                        $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
                        $resultado = $conexion->prepare($consulta);
                        $resultado->execute(array(
                            0, $cedenteid, $personaid, $referenid, $fono2ref1, $tipotelefono, $tipocliente, 0,
                            $newestado, $currentdate, $userid, $host
                        ));
                    }

                    //DIRECCIONES REFERENCIA 1

                    $direcciondomref1 = safe($data[35]);
                    $referenciadomref1 = safe($data[36]);
                    if ($direcciondomref1 != '') {
                        $tipodireccion = 'DIRECCION';
                        $definicion = 'DOM';

                        $consulta = "CALL sp_New_Direccion_Correos(?,?,?,?,?,?,?,?,?,?,?,?)";
                        $resultado = $conexion->prepare($consulta);
                        $resultado->execute(array(
                            0, $cedula, $cedularef1, $tipodireccion, $tipocliente, $definicion,
                            $direcciondomref1, $referenciadomref1, '', $currentdate, $userid, $host
                        ));
                    }

                    $emailref1 = safe($data[37]);
                    if ($emailref1 != '') {
                        $tipodireccion = 'CORREO';
                        $definicion = 'PER';

                        $consulta = "CALL sp_New_Direccion_Correos(?,?,?,?,?,?,?,?,?,?,?,?)";
                        $resultado = $conexion->prepare($consulta);
                        $resultado->execute(array(
                            0, $cedula, $cedularef1, $tipodireccion, $tipocliente, $definicion,
                            '', '', $emailref1, $currentdate, $userid, $host
                        ));
                    }
                }


                // DEUDOR_REFERENCIA 2

                $cedularef2 = safe($data[38]);
                $nombreref2 = safe($data[39]);
                $cedula = $data[0];
                if ($nombreref2 != '') {
                    if ($cedularef2 == '') {
                        $cedularef2 = $cedula;
                    }


                    $consulta = "CALL sp_New_Referencia_Deudor(?,?,?,?,?,?,?,?)";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute(array(0, $personaid, $cedularef2, $nombreref2, $tipocliente, $currentdate, $userid, $host));

                    $referenid = $resultado->fetchColumn();


                    //TELEFONO 1 REFERENCIA 2

                    $fono1ref2 = safe($data[40]);
                    if ($fono1ref2 != '') {

                        $primervalor = substr($fono1ref2, 0, 1);
                        $segvalor = substr($fono1ref2, 0, 2);
                        $largo = strlen($fono1ref2);

                        if (strlen($fono1ref2) > 8 || strlen($fono1ref2) < 11) {

                            switch ($segvalor) {
                                case "09":
                                    $tipotelefono = 'CEL';
                                    break;
                                case "02":
                                case "03":
                                case "04":
                                case "05":
                                case "06":
                                case "07":
                                case "08":
                                    $tipotelefono = 'CON';
                                    break;
                            }
                        }


                        if (strlen($fono1ref2) > 6 || strlen($fono1ref2) < 11) {

                            switch ($primervalor) {
                                case "9":
                                    $tipotelefono = 'CEL';
                                    if ($largo == 9) {
                                        $fono1ref2 = '0' . $fono1ref2;
                                    }
                                    break;

                                case "2":
                                case "3":
                                case "4":
                                case "5":
                                case "6":
                                case "7":
                                case "8":
                                    $tipotelefono = 'CON';

                                    if ($largo == 7) {
                                        $fono1ref2 = '02' . $fono1ref2;
                                    }

                                    if ($largo == 8) {
                                        $fono1ref2 = '0' . $fono1ref2;
                                    }

                                    break;
                            }
                        }


                        $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
                        $resultado = $conexion->prepare($consulta);
                        $resultado->execute(array(
                            0, $cedenteid, $personaid, $referenid, $fono1ref2, $tipotelefono, $tipocliente, 0,
                            $newestado, $currentdate, $userid, $host
                        ));
                    }

                    //TELEFONO 2 REFERENCIA 2

                    $fono2ref2 = safe($data[41]);
                    if ($fono2ref2 != '') {

                        $primervalor = substr($fono2ref2, 0, 1);
                        $segvalor = substr($fono2ref2, 0, 2);
                        $largo = strlen($fono2ref2);

                        if (strlen($fono2ref2) > 8 || strlen($fono2ref2) < 11) {

                            switch ($segvalor) {
                                case "09":
                                    $tipotelefono = 'CEL';
                                    break;
                                case "02":
                                case "03":
                                case "04":
                                case "05":
                                case "06":
                                case "07":
                                case "08":
                                    $tipotelefono = 'CON';
                                    break;
                            }
                        }


                        if (strlen($fono2ref2) > 6 || strlen($fono2ref2) < 11) {

                            switch ($primervalor) {
                                case "9":
                                    $tipotelefono = 'CEL';
                                    if ($largo == 9) {
                                        $fono2ref2 = '0' . $fono2ref2;
                                    }
                                    break;

                                case "2":
                                case "3":
                                case "4":
                                case "5":
                                case "6":
                                case "7":
                                case "8":
                                    $tipotelefono = 'CON';

                                    if ($largo == 7) {
                                        $fono2ref2 = '02' . $fono2ref2;
                                    }

                                    if ($largo == 8) {
                                        $fono2ref2 = '0' . $fono2ref2;
                                    }

                                    break;
                            }
                        }


                        $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
                        $resultado = $conexion->prepare($consulta);
                        $resultado->execute(array(
                            0, $cedenteid, $personaid, $referenid, $fono2ref2, $tipotelefono, $tipocliente, 0,
                            $newestado, $currentdate, $userid, $host
                        ));
                    }

                    //DIRECCIONES REFERENCIA 2


                    $direcciondomref2 = safe($data[42]);
                    $referenciadomref2 = safe($data[43]);
                    if ($direcciondomref2 != '') {
                        $tipodireccion = 'DIRECCION';
                        $definicion = 'DOM';

                        $consulta = "CALL sp_New_Direccion_Correos(?,?,?,?,?,?,?,?,?,?,?,?)";
                        $resultado = $conexion->prepare($consulta);
                        $resultado->execute(array(
                            0, $cedula, $cedularef1, $tipodireccion, $tipocliente, $definicion,
                            $direcciondomref2, $referenciadomref2, '', $currentdate, $userid, $host
                        ));
                    }

                    $emailref2 = safe($data[44]);
                    if ($emailref2 != '') {
                        $tipodireccion = 'CORREO';
                        $definicion = 'PER';

                        $consulta = "CALL sp_New_Direccion_Correos(?,?,?,?,?,?,?,?,?,?,?,?)";
                        $resultado = $conexion->prepare($consulta);
                        $resultado->execute(array(
                            0, $cedula, $cedularef2, $tipodireccion, $tipocliente, $definicion,
                            '', '', $emailref2, $currentdate, $userid, $host
                        ));
                    }
                }

                // INSERTEAR GARANTE 1

                $tipocliente = 'GAR';
                $tipotelefono = 'CEL';
                $cedulagarante1 = safe($data[46]);
                $nombregarante1 = safe($data[47]);
                $cedula = $data[0];

                if ($nombregarante1 != '') {

                    if ($cedulagarante1 != '') {

                        $consulta = "CALL sp_New_Garante_Deudor(?,?,?,?,?,?,?,?)";
                        $resultado = $conexion->prepare($consulta);
                        $resultado->execute(array(0, $tipocliente, $cedula, $cedulagarante1, $nombregarante1, $currentdate, $userid, $host));

                        $direcciondomgara1 = safe($data[48]);
                        $referenciadomgara1 = safe($data[49]);
                        if ($direcciondomgara1 != '') {

                            $tipodireccion = 'DIRECCION';
                            $definicion = 'DOM';

                            $consulta = "CALL sp_New_Direccion_Correos(?,?,?,?,?,?,?,?,?,?,?,?)";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute(array(
                                0, $cedula, $cedulagarante1, $tipodireccion, $tipocliente, $definicion,
                                $direcciondomgara1, $referenciadomgara1, '', $currentdate, $userid, $host
                            ));
                        }


                        $direcciontragara1 = safe($data[50]);
                        $referenciatragara1 = safe($data[51]);
                        if ($direcciontragara1 != '') {

                            $tipodireccion = 'DIRECCION';
                            $definicion = 'TRA';

                            $consulta = "CALL sp_New_Direccion_Correos(?,?,?,?,?,?,?,?,?,?,?,?)";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute(array(
                                0, $cedula, $cedulagarante1, $tipodireccion, $tipocliente, $definicion,
                                $direcciontragara1, $referenciatragara1, '', $currentdate, $userid, $host
                            ));
                        }

                        $emailpersonalgara1 = safe($data[52]);
                        if ($emailpersonalgara1 != '') {

                            $tipodireccion = 'CORREO';
                            $definicion = 'PER';

                            $consulta = "CALL sp_New_Direccion_Correos(?,?,?,?,?,?,?,?,?,?,?,?)";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute(array(
                                0, $cedula, $cedulagarante1, $tipodireccion, $tipocliente, $definicion,
                                '', '', $emailpersonalgara1, $currentdate, $userid, $host
                            ));
                        }

                        $emailtrabajogara1 = safe($data[53]);
                        if ($emailtrabajogara1 != '') {

                            $tipodireccion = 'CORREO';
                            $definicion = 'TRA';

                            $consulta = "CALL sp_New_Direccion_Correos(?,?,?,?,?,?,?,?,?,?,?,?)";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute(array(
                                0, $cedula, $cedulagarante1, $tipodireccion, $tipocliente, $definicion,
                                '', '', $emailtrabajogara1, $currentdate, $userid, $host
                            ));
                        }

                        $fono1gara1 = safe($data[54]);
                        if ($fono1gara1 != '') {

                            $primervalor = substr($fono1gara1, 0, 1);
                            $segvalor = substr($fono1gara1, 0, 2);
                            $largo = strlen($fono1gara1);

                            if (strlen($fono1gara1) > 8 || strlen($fono1gara1) < 11) {

                                switch ($segvalor) {
                                    case "09":
                                        $tipotelefono = 'CEL';
                                        break;
                                    case "02":
                                    case "03":
                                    case "04":
                                    case "05":
                                    case "06":
                                    case "07":
                                    case "08":
                                        $tipotelefono = 'CON';
                                        break;
                                }
                            }


                            if (strlen($fono1gara1) > 6 || strlen($fono1gara1) < 11) {

                                switch ($primervalor) {
                                    case "9":
                                        $tipotelefono = 'CEL';
                                        if ($largo == 9) {
                                            $fono1gara1 = '0' . $fono1gara1;
                                        }
                                        break;

                                    case "2":
                                    case "3":
                                    case "4":
                                    case "5":
                                    case "6":
                                    case "7":
                                    case "8":
                                        $tipotelefono = 'CON';

                                        if ($largo == 7) {
                                            $fono1gara1 = '02' . $fono1gara1;
                                        }

                                        if ($largo == 8) {
                                            $fono1gara1 = '0' . $fono1gara1;
                                        }

                                        break;
                                }
                            }

                            $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute(array(
                                0, $cedenteid, $personaid, 0, $fono1gara1, $tipotelefono, $tipocliente, 0,
                                $newestado, $currentdate, $userid, $host
                            ));
                        }

                        $fono2gara1 = safe($data[55]);
                        if ($fono2gara1 != '') {

                            $primervalor = substr($fono2gara1, 0, 1);
                            $segvalor = substr($fono2gara1, 0, 2);
                            $largo = strlen($fono2gara1);

                            if (strlen($fono2gara1) > 8 || strlen($fono2gara1) < 11) {

                                switch ($segvalor) {
                                    case "09":
                                        $tipotelefono = 'CEL';
                                        break;
                                    case "02":
                                    case "03":
                                    case "04":
                                    case "05":
                                    case "06":
                                    case "07":
                                    case "08":
                                        $tipotelefono = 'CON';
                                        break;
                                }
                            }


                            if (strlen($fono2gara1) > 6 || strlen($fono2gara1) < 11) {

                                switch ($primervalor) {
                                    case "9":
                                        $tipotelefono = 'CEL';
                                        if ($largo == 9) {
                                            $fono2gara1 = '0' . $fono2gara1;
                                        }
                                    case "09":
                                        $tipotelefono = 'CEL';
                                        break;

                                    case "2":
                                    case "3":
                                    case "4":
                                    case "5":
                                    case "6":
                                    case "7":
                                    case "8":
                                        $tipotelefono = 'CON';

                                        if ($largo == 7) {
                                            $fono2gara1 = '02' . $fono2gara1;
                                        }

                                        if ($largo == 8) {
                                            $fono2gara1 = '0' . $fono2gara1;
                                        }

                                        break;
                                }
                            }

                            $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute(array(
                                0, $cedenteid, $personaid, 0, $fono2gara1, $tipotelefono, $tipocliente, 0,
                                $newestado, $currentdate, $userid, $host
                            ));
                        }

                        $fono3gara1 = safe($data[56]);
                        if ($fono3gara1 != '') {
                            $primervalor = substr($fono3gara1, 0, 1);
                            $segvalor = substr($fono3gara1, 0, 2);
                            $largo = strlen($fono3gara1);

                            if (strlen($fono3gara1) > 8 || strlen($fono3gara1) < 11) {

                                switch ($segvalor) {
                                    case "09":
                                        $tipotelefono = 'CEL';
                                        break;
                                    case "02":
                                    case "03":
                                    case "04":
                                    case "05":
                                    case "06":
                                    case "07":
                                    case "08":
                                        $tipotelefono = 'CON';
                                        break;
                                }
                            }


                            if (strlen($fono3gara1) > 6 || strlen($fono3gara1) < 11) {

                                switch ($primervalor) {
                                    case "9":
                                        $tipotelefono = 'CEL';
                                        if ($largo == 9) {
                                            $fono3gara1 = '0' . $fono3gara1;
                                        }
                                        break;

                                    case "2":
                                    case "3":
                                    case "4":
                                    case "5":
                                    case "6":
                                    case "7":
                                    case "8":
                                        $tipotelefono = 'CON';

                                        if ($largo == 7) {
                                            $fono3gara1 = '02' . $fono3gara1;
                                        }

                                        if ($largo == 8) {
                                            $fono3gara1 = '0' . $fono3gara1;
                                        }

                                        break;
                                }
                            }

                            $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute(array(
                                0, $cedenteid, $personaid, 0, $fono3gara1, $tipotelefono, $tipocliente, 0,
                                $newestado, $currentdate, $userid, $host
                            ));
                        }
                    }
                }

                // INSERTEAR GARANTE 2

                $cedulagarante2 = safe($data[58]);
                $nombregarante2 = safe($data[59]);
                $cedula = $data[0];
                if ($nombregarante2 != '') {

                    if ($cedulagarante2 != '') {

                        $consulta = "CALL sp_New_Garante_Deudor(?,?,?,?,?,?,?,?)";
                        $resultado = $conexion->prepare($consulta);
                        $resultado->execute(array(
                            0, $tipocliente, $cedula, $cedulagarante2, $nombregarante2,
                            $currentdate, $userid, $host
                        ));

                        $direcciondomgara2 = safe($data[60]);
                        $referenciadomgara2 = safe($data[61]);
                        if ($direcciondomgara2 != '') {

                            $tipodireccion = 'DIRECCION';
                            $definicion = 'DOM';

                            $consulta = "CALL sp_New_Direccion_Correos(?,?,?,?,?,?,?,?,?,?,?,?)";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute(array(
                                0, $cedula, $cedulagarante2, $tipodireccion, $tipocliente, $definicion,
                                $direcciondomgara2, $referenciadomgara2, '', $currentdate, $userid, $host
                            ));
                        }

                        $direcciontragara2 = safe($data[62]);
                        $referenciatragara2 = safe($data[63]);
                        if ($direcciontragara2 != '') {

                            $tipodireccion = 'DIRECCION';
                            $definicion = 'TRA';

                            $consulta = "CALL sp_New_Direccion_Correos(?,?,?,?,?,?,?,?,?,?,?,?)";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute(array(
                                0, $cedula, $cedulagarante2, $tipodireccion, $tipocliente, $definicion,
                                $direcciontragara2, $referenciatragara2, '', $currentdate, $userid, $host
                            ));
                        }

                        $emailpersonalgara2 = safe($data[64]);
                        if ($emailpersonalgara2 != '') {

                            $tipodireccion = 'CORREO';
                            $definicion = 'PER';

                            $consulta = "CALL sp_New_Direccion_Correos(?,?,?,?,?,?,?,?,?,?,?,?)";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute(array(
                                0, $cedula, $cedulagarante2, $tipodireccion, $tipocliente, $definicion,
                                '', '', $emailpersonalgara2, $currentdate, $userid, $host
                            ));
                        }

                        $emailtrabajogara2 = safe($data[65]);
                        if ($emailtrabajogara2 != '') {

                            $tipodireccion = 'CORREO';
                            $definicion = 'TRA';

                            $consulta = "CALL sp_New_Direccion_Correos(?,?,?,?,?,?,?,?,?,?,?,?)";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute(array(
                                0, $cedula, $cedulagarante2, $tipodireccion, $tipocliente, $definicion,
                                '', '', $emailtrabajogara2, $currentdate, $userid, $host
                            ));
                        }

                        $fono1gara2 = safe($data[66]);
                        if ($fono1gara2 != '') {

                            $primervalor = substr($fono1gara2, 0, 1);
                            $segvalor = substr($fono1gara2, 0, 2);
                            $largo = strlen($fono1gara2);

                            if (strlen($fono1gara2) > 8 || strlen($fono1gara2) < 11) {

                                switch ($segvalor) {
                                    case "09":
                                        $tipotelefono = 'CEL';
                                        break;
                                    case "02":
                                    case "03":
                                    case "04":
                                    case "05":
                                    case "06":
                                    case "07":
                                    case "08":
                                        $tipotelefono = 'CON';
                                        break;
                                }
                            }


                            if (strlen($fono1gara2) > 6 || strlen($fono1gara2) < 11) {

                                switch ($primervalor) {
                                    case "9":
                                        $tipotelefono = 'CEL';
                                        if ($largo == 9) {
                                            $fono1gara2 = '0' . $fono1gara2;
                                        }
                                        break;

                                    case "2":
                                    case "3":
                                    case "4":
                                    case "5":
                                    case "6":
                                    case "7":
                                    case "8":
                                        $tipotelefono = 'CON';

                                        if ($largo == 7) {
                                            $fono1gara2 = '02' . $fono1gara2;
                                        }

                                        if ($largo == 8) {
                                            $fono1gara2 = '0' . $fono1gara2;
                                        }

                                        break;
                                }
                            }


                            $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute(array(
                                0, $cedenteid, $personaid, 0, $fono1gara2, $tipotelefono, $tipocliente, 0,
                                $newestado, $currentdate, $userid, $host
                            ));
                        }

                        $fono2gara2 = safe($data[67]);
                        if ($fono2gara2 != '') {
                            $primervalor = substr($fono2gara2, 0, 1);
                            $segvalor = substr($fono2gara2, 0, 2);
                            $largo = strlen($fono2gara2);

                            if (strlen($fono2gara2) > 8 || strlen($fono2gara2) < 11) {

                                switch ($segvalor) {
                                    case "09":
                                        $tipotelefono = 'CEL';
                                        break;
                                    case "02":
                                    case "03":
                                    case "04":
                                    case "05":
                                    case "06":
                                    case "07":
                                    case "08":
                                        $tipotelefono = 'CON';
                                        break;
                                }
                            }


                            if (strlen($fono2gara2) > 6 || strlen($fono2gara2) < 11) {

                                switch ($primervalor) {
                                    case "9":
                                        $tipotelefono = 'CEL';
                                        if ($largo == 9) {
                                            $fono2gara2 = '0' . $fono2gara2;
                                        }
                                        break;

                                    case "2":
                                    case "3":
                                    case "4":
                                    case "5":
                                    case "6":
                                    case "7":
                                    case "8":
                                        $tipotelefono = 'CON';

                                        if ($largo == 7) {
                                            $fono2gara2 = '02' . $fono2gara2;
                                        }

                                        if ($largo == 8) {
                                            $fono2gara2 = '0' . $fono2gara2;
                                        }

                                        break;
                                }
                            }


                            $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute(array(
                                0, $cedenteid, $personaid, 0, $fono2gara2, $tipotelefono, $tipocliente, 0,
                                $newestado, $currentdate, $userid, $host
                            ));
                        }

                        $fono3gara2 = safe($data[68]);
                        if ($fono3gara2 != '') {

                            $primervalor = substr($fono3gara2, 0, 1);
                            $segvalor = substr($fono3gara2, 0, 2);
                            $largo = strlen($fono3gara2);

                            if (strlen($fono3gara2) > 8 || strlen($fono3gara2) < 11) {

                                switch ($segvalor) {
                                    case "09":
                                        $tipotelefono = 'CEL';
                                        break;
                                    case "02":
                                    case "03":
                                    case "04":
                                    case "05":
                                    case "06":
                                    case "07":
                                    case "08":
                                        $tipotelefono = 'CON';
                                        break;
                                }
                            }


                            if (strlen($fono3gara2) > 6 || strlen($fono3gara2) < 11) {

                                switch ($primervalor) {
                                    case "9":
                                        $tipotelefono = 'CEL';
                                        if ($largo == 9) {
                                            $fono3gara2 = '0' . $fono3gara2;
                                        }
                                        break;

                                    case "2":
                                    case "3":
                                    case "4":
                                    case "5":
                                    case "6":
                                    case "7":
                                    case "8":
                                        $tipotelefono = 'CON';

                                        if ($largo == 7) {
                                            $fono3gara2 = '02' . $fono3gara2;
                                        }

                                        if ($largo == 8) {
                                            $fono3gara2 = '0' . $fono3gara2;
                                        }

                                        break;
                                }
                            }

                            $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute(array(
                                0, $cedenteid, $personaid, 0, $fono3gara2, $tipotelefono, $tipocliente, 0,
                                $newestado, $currentdate, $userid, $host
                            ));
                        }
                    }
                }

                //CAMPOS ADICIONALES

                $datosadicionales = $data[69] . $adicional2 . $adicional3 . $adicional4 . $adicional5;

                if ($datosadicionales != '') {

                    $consulta = "CALL sp_New_Campos_Adicionales(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute(array(
                        0, $cedenteid, $catalogoid, $personaid, $operacion, $adicional1, $adicional2, $adicional3, $adicional4, $adicional5,
                        $adicional6, $adicional7, $adicional8, $adicional9, $adicional10, $adicional11, $adicional12, $adicional13, $adicional14, $adicional5, $adicional16,
                        $adicional7, $adicional18, $adicional19, $adicional20, $adicional21, $adicional22, $adicional23, $adicional24, $adicional25, $adicional26, $adicional27,
                        $adicional28, $adicional29, $adicional30
                    ));
                }

                //CUENTA DEUDOR

                $consulta = "CALL sp_Subir_Cuenta_Deudor(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute(array(0,$personaid,$cedenteid,$productoid,$catalogoid,$operacion,$totaldeuda,$diasmora,
                                        $capitalxvencer,$capitalvencido,$capitalmora,$valorexigible,$fechaobligacion,
                                            $fechavencimiento,$fechaultpago,0,$newestado));
    
            }
        }
        $MostarData = 1;
        fclose($handle);
    }

    //AL FINAL DE TODO RECARGAR LA PAGINA NUEVAMENTE
    //header("Location: http://localhost:8080/softcobplus/herramientas/subircartera.php");
}

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
                        <form method="post" class="form-horizontal col-md-12" enctype="multipart/form-data">
                            <?php if ($MostarData == 0) {  ?>
                                <br />
                                <div class="form-group row">
                                    <label for="ciudad" class="control-label-required col-md-1">Ciudad:</label>
                                    <div class="col-md-4 col-sm-8">
                                        <select class="form-control" id="cboCiudad" name="cbociudad" style="width: 100%;" onfocusout="f_validarciudad(this)" required>
                                            <option value="">--Seleccione Cuidad--</option>
                                            <?php foreach ($dataciu as $fila) : ?>
                                                <option value="<?= $fila['Codigo'] ?>"><?= $fila['Descripcion'] ?>
                                                </option>
                                            <?php endforeach ?>
                                        </select>
                                        <label id="Ciudad-error" class="error" for="cbociudad" style="display: none;"></label>
                                    </div>
                                    <label for="espacio" class="control-label col-md-1"></label>
                                    <label for="cedente" class="control-label col-md-1">Cedente:</label>
                                    <div class="col-md-4 col-sm-8">
                                        <select class="form-control" id="cboCedente" name="cbocedente" style="width: 100%;" onfocusout="f_validarcedente(this)" required>
                                            <option value="">--Seleccione Cedente--</option>
                                        </select>
                                        <label id="Cedente-error" class="error" for="cboCedente" style="display: none;"></label>
                                    </div>
                                </div>
                                <br />
                                <div class="form-group row">
                                    <label for="producto" class="control-label col-md-1">Producto:</label>
                                    <div class="col-md-4 col-sm-8">
                                        <select class="form-control" id="cboProducto" name="cboproducto" style="width: 100%;" required>
                                            <option value="">--Seleccione Producto--</option>
                                        </select>
                                    </div>
                                    <label for="espacio" class="control-label col-md-1"></label>
                                    <label for="catalogo" class="control-label col-md-1">Catalogo:</label>
                                    <div class="col-md-4 col-sm-8">
                                        <select class="form-control" id="cboCatalogo" name="cbocatalogo" style="width: 100%;" required>
                                            <option value="">--Seleccione Catalogo--</option>
                                        </select>
                                    </div>
                                </div>
                                <br />
                                <br />
                                <br />
                                <div class="form-group row">
                                    <label for="espacio" class="control-label col-md-3"></label>
                                    <div class="wrapper" id="container">
                                        <input type="file" accept=".csv" id="file_input" name="file_input" class="file" hidden required>
                                        <i class="fa fa-cloud-upload"></i>
                                        <p>Browse File to Upload</p>
                                        <span>
                                            <strong>Archivo Seleccionado:</strong>
                                            <span id="file_name">Ninguno</span>
                                        </span>
                                    </div>
                                </div>

                                <label for="espacio" class="control-label col-md-3"></label>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <input type='submit' class='btn btn-outline-info' name='Enviar' value='Subir Cartera' id="btnEnviar" />
                                </div>
                                <br />
                                <br />
                                <label for="espacio" class="control-label col-md-3"></label>
                                <div id="progressBar">
                                    <div id="progressbar">
                                    </div>
                                </div>
                            <?php   } elseif ($MostarData == 1) { ?>
                                <div>
                                    <h1>HOLA</h1>
                                </div>
                                <a class="btn btn-md btn-primary" href="subircartera.php" role="button">Cargar Nuevamente</a>

                            <?php    }  ?>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../dashmenu/panel_footer.php'; ?>
<script src="../codejs/herramientas.js" type="text/javascript"></script>

<script>
    function f_validarciudad(obj) {
        if (obj.value == '') {
            mensajesalertify("Seleccione Ciudad", "W", "top-center", 5);
            $("#Ciudad-error").html("Este dato es necesario.");
            $("#Ciudad-error").show();
        }
    }

    function f_validarcedente(obj) {
        mensajesalertify("Seleccione Cedente", "W", "top-center", 5);
        $("#Cedente-error").html("Este dato es necesario.");
        $("#Cedente-error").show();
    }
</script>

</body>

</html>