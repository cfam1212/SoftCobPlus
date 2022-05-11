<?php
session_start();

require_once("conexion.php");
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$data = null;

ini_set('memory_limit', '2GB');

$userid = $_SESSION["i_usuaid"];
$host = $_SESSION["s_namehost"];
$empreid = $_SESSION["i_emprid"];


$cedenteid = (isset($_POST['cedeid'])) ? $_POST['cedeid'] : '0';
$productoid = (isset($_POST['producid'])) ? $_POST['producid'] : '0';
$catalogoid = (isset($_POST['catalogoid'])) ? $_POST['catalogoid'] : '0';
//CAMPOS PERSONA
$cedula = (isset($_POST['cedula'])) ? $_POST['cedula'] : '';
$nombres = (isset($_POST['nombres'])) ? $_POST['nombres'] : '';
$apellidos = (isset($_POST['apellidos'])) ? $_POST['apellidos'] : '';
$fechanaci = (isset($_POST['fechanaci'])) ? $_POST['fechanaci'] : '';
$provincia = (isset($_POST['provincia'])) ? $_POST['provincia'] : '0';
$ciudad = (isset($_POST['ciudad'])) ? $_POST['ciudad'] : '0';
$direcciondom = (isset($_POST['direcciondom'])) ? $_POST['direcciondom'] : '';
$referenciadom = (isset($_POST['referenciadom'])) ? $_POST['referenciadom'] : '';
$direcciontra = (isset($_POST['direcciontra'])) ? $_POST['direcciontra'] : '';
$referenciatra = (isset($_POST['referenciatra'])) ? $_POST['referenciatra'] : '';
$email = (isset($_POST['email'])) ? $_POST['email'] : '';
//CAMPOS DEUDAS PERSONA
$operacion = (isset($_POST['operacion'])) ? $_POST['operacion'] : '';
$totaldeuda = (isset($_POST['totaldeuda'])) ? $_POST['totaldeuda'] : '0';
$diasmora = (isset($_POST['diasmora'])) ? $_POST['diasmora'] : '0';
$capitalxvencer = (isset($_POST['capitalxvencer'])) ? $_POST['capitalxvencer'] : '0';
$capitalvencido = (isset($_POST['capitalvencido'])) ? $_POST['capitalvencido'] : '0';
$capitalmora = (isset($_POST['capitalmora'])) ? $_POST['capitalmora'] : '0';
$valorexigible = (isset($_POST['valorexigible'])) ? $_POST['valorexigible'] : '0';
$fechaobligacion = (isset($_POST['fechaobligacion'])) ? $_POST['fechaobligacion'] : '';
$fechavencimiento = (isset($_POST['fechavencimiento'])) ? $_POST['fechavencimiento'] : '';
$fechaultpago = (isset($_POST['fechaultpago'])) ? $_POST['fechaultpago'] : '';
//CAMPOS TELELEFONOS
$fonodeu1 = (isset($_POST['fonodeu1'])) ? $_POST['fonodeu1'] : '0';
$fonodeu2 = (isset($_POST['fonodeu2'])) ? $_POST['fonodeu2'] : '0';
$fonodeu3 = (isset($_POST['fonodeu3'])) ? $_POST['fonodeu3'] : '0';
$fonodeu4 = (isset($_POST['fonodeu4'])) ? $_POST['fonodeu4'] : '0';
$fonodeu5 = (isset($_POST['fonodeu5'])) ? $_POST['fonodeu5'] : '0';
$fonodeu6 = (isset($_POST['fonodeu6'])) ? $_POST['fonodeu6'] : '0';
$fonodeu7 = (isset($_POST['fonodeu7'])) ? $_POST['fonodeu7'] : '0';
$fonodeu8 = (isset($_POST['fonodeu8'])) ? $_POST['fonodeu8'] : '0';
$fonodeu9 = (isset($_POST['fonodeu9'])) ? $_POST['fonodeu9'] : '0';
$fonodeu10 = (isset($_POST['fonodeu10'])) ? $_POST['fonodeu10'] : '0';
//CAMPOS PERSONA REFERENCIA
$cedularef1 = (isset($_POST['cedularef1'])) ? $_POST['cedularef1'] : '';
$nombreref1 = (isset($_POST['nombreref1'])) ? $_POST['nombreref1'] : '';
$fono1ref1 = (isset($_POST['fono1ref1'])) ? $_POST['fono1ref1'] : '0';
$fono2ref1 = (isset($_POST['fono2ref1'])) ? $_POST['fono2ref1'] : '0';
$direcciondomref1 = (isset($_POST['direcciondomref1'])) ? $_POST['direcciondomref1'] : '';
$referenciadomref1 = (isset($_POST['referenciadomref1'])) ? $_POST['referenciadomref1'] : '';
$emailref1 = (isset($_POST['emailref1'])) ? $_POST['emailref1'] : '';

$cedularef2 = (isset($_POST['cedularef2'])) ? $_POST['cedularef2'] : '';
$nombreref2 = (isset($_POST['nombreref2'])) ? $_POST['nombreref2'] : '';
$fono1ref2 = (isset($_POST['fono1ref2'])) ? $_POST['fono1ref2'] : '0';
$fono2ref2 = (isset($_POST['fono2ref2'])) ? $_POST['fono2ref2'] : '0';
$direcciondomref2 = (isset($_POST['direcciondomref2'])) ? $_POST['direcciondomref2'] : '';
$referenciadomref2 = (isset($_POST['referenciadomref2'])) ? $_POST['referenciadomref2'] : '';
$emailref2 = (isset($_POST['emailref2'])) ? $_POST['emailref2'] : '';
//CAMPOS PERSONA GARENTE
$tipogarante1 = (isset($_POST['tipogarante1'])) ? $_POST['tipogarante1'] : '';
$cedulagarante1 = (isset($_POST['cedulagarante1'])) ? $_POST['cedulagarante1'] : '';
$nombregarante1 = (isset($_POST['nombregarante1'])) ? $_POST['nombregarante1'] : '';
$direcciondomgara1 = (isset($_POST['direcciondomgara1'])) ? $_POST['direcciondomgara1'] : '';
$referenciadomgara1 = (isset($_POST['referenciadomgara1'])) ? $_POST['referenciadomgara1'] : '';
$direcciontragara1 = (isset($_POST['direcciontragara1'])) ? $_POST['direcciontragara1'] : '';
$referenciatragara1 = (isset($_POST['referenciatragara1'])) ? $_POST['referenciatragara1'] : '';
$emailpersonalgara1 = (isset($_POST['emailpersonalgara1'])) ? $_POST['emailpersonalgara1'] : '';
$emailtrabajogara1 = (isset($_POST['emailtrabajogara1'])) ? $_POST['emailtrabajogara1'] : '';
$fono1gara1 = (isset($_POST['fono1gara1'])) ? $_POST['fono1gara1'] : '0';
$fono2gara1 = (isset($_POST['fono2gara1'])) ? $_POST['fono2gara1'] : '0';
$fono3gara1 = (isset($_POST['fono3gara1'])) ? $_POST['fono3gara1'] : '0';

$tipogarante2 = (isset($_POST['tipogarante2'])) ? $_POST['tipogarante2'] : '';
$cedulagarante2 = (isset($_POST['cedulagarante2'])) ? $_POST['cedulagarante2'] : '';
$nombregarante2 = (isset($_POST['nombregarante2'])) ? $_POST['nombregarante2'] : '';
$direcciondomgara2 = (isset($_POST['direcciondomgara2'])) ? $_POST['direcciondomgara2'] : '';
$referenciadomgara2 = (isset($_POST['referenciadomgara2'])) ? $_POST['referenciadomgara2'] : '';
$direcciontragara2 = (isset($_POST['direcciontragara2'])) ? $_POST['direcciontragara2'] : '';
$referenciatragara2 = (isset($_POST['referenciatragara2'])) ? $_POST['referenciatragara2'] : '';
$emailpersonalgara2 = (isset($_POST['emailpersonalgara2'])) ? $_POST['emailpersonalgara2'] : '';
$emailtrabajogara2 = (isset($_POST['emailtrabajogara2'])) ? $_POST['emailtrabajogara2'] : '';
$fono1gara2 = (isset($_POST['fono1gara2'])) ? $_POST['fono1gara2'] : '0';
$fono2gara2 = (isset($_POST['fono2gara2'])) ? $_POST['fono2gara2'] : '0';
$fono3gara2 = (isset($_POST['fono3gara2'])) ? $_POST['fono3gara2'] : '0';
//CAMPOS ADICIONALES
$adicional1 = (isset($_POST['adicional1'])) ? $_POST['adicional1'] : '';
$adicional2 = (isset($_POST['adicional2'])) ? $_POST['adicional2'] : '';
$adicional3 = (isset($_POST['adicional3'])) ? $_POST['adicional3'] : '';
$adicional4 = (isset($_POST['adicional4'])) ? $_POST['adicional4'] : '';
$adicional5 = (isset($_POST['adicional5'])) ? $_POST['adicional5'] : '';
$adicional6 = (isset($_POST['adicional6'])) ? $_POST['adicional6'] : '';
$adicional7 = (isset($_POST['adicional7'])) ? $_POST['adicional7'] : '';
$adicional8 = (isset($_POST['adicional8'])) ? $_POST['adicional8'] : '';
$adicional9 = (isset($_POST['adicional9'])) ? $_POST['adicional9'] : '';
$adicional10 = (isset($_POST['adicional10'])) ? $_POST['adicional10'] : '';
$adicional11 = (isset($_POST['adicional11'])) ? $_POST['adicional11'] : '';
$adicional12 = (isset($_POST['adicional12'])) ? $_POST['adicional12'] : '';
$adicional13 = (isset($_POST['adicional13'])) ? $_POST['adicional13'] : '';
$adicional14 = (isset($_POST['adicional14'])) ? $_POST['adicional14'] : '';
$adicional15 = (isset($_POST['adicional15'])) ? $_POST['adicional15'] : '';
$adicional16 = (isset($_POST['adicional16'])) ? $_POST['adicional16'] : '';
$adicional17 = (isset($_POST['adicional17'])) ? $_POST['adicional17'] : '';
$adicional18 = (isset($_POST['adicional18'])) ? $_POST['adicional18'] : '';
$adicional19 = (isset($_POST['adicional19'])) ? $_POST['adicional19'] : '';
$adicional20 = (isset($_POST['adicional20'])) ? $_POST['adicional20'] : '';
$adicional21 = (isset($_POST['adicional21'])) ? $_POST['adicional21'] : '';
$adicional22 = (isset($_POST['adicional22'])) ? $_POST['adicional22'] : '';
$adicional23 = (isset($_POST['adicional23'])) ? $_POST['adicional23'] : '';
$adicional24 = (isset($_POST['adicional24'])) ? $_POST['adicional24'] : '';
$adicional25 = (isset($_POST['adicional25'])) ? $_POST['adicional25'] : '';
$adicional26 = (isset($_POST['adicional26'])) ? $_POST['adicional26'] : '';
$adicional27 = (isset($_POST['adicional27'])) ? $_POST['adicional27'] : '';
$adicional28 = (isset($_POST['adicional28'])) ? $_POST['adicional28'] : '';
$adicional29 = (isset($_POST['adicional29'])) ? $_POST['adicional29'] : '';
$adicional30 = (isset($_POST['adicional30'])) ? $_POST['adicional30'] : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '0';

$newestado = 'A';
$tipodocumento = 'C';


date_default_timezone_set("America/Guayaquil");
$currentdate = date('Y-m-d H:i:s');

switch($opcion){
    case 0: //INSERTAR PERSONA 
          
        if($cedula == '' || $operacion == '' )
        {
            return false;
        }

        $consulta = "CALL sp_Subir_Cartera_Persona(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(array(0,$tipodocumento,$cedula,'',$apellidos,$nombres,$fechanaci,'',$provincia,$ciudad,'',
                                    $newestado,$currentdate,$userid,$host));
        
        $personaid = $resultado->fetchColumn();

        //INSERTAR TELEFONOS DEUDOR

        $tipocliente = 'TIT';
        $tipotelefono = 'CEL';

        if($fonodeu1 != ''){

            if(substr($fonodeu1,2)!= '09'){
                $tipotelefono = 'CON';
            }else{ $tipotelefono = 'CEL';}

            $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$cedenteid,$personaid,0,$fonodeu1,$tipotelefono,$tipocliente,0,
                                        $newestado,$currentdate,$userid,$host));
        }

        if($fonodeu2 != ''){

                if(substr($fonodeu2,2)!= '09'){
                    $tipotelefono = 'CON';
                }else{ $tipotelefono = 'CEL';}

                $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute(array(0,$cedenteid,$personaid,0,$fonodeu2,$tipotelefono,$tipocliente,0,
                                            $newestado,$currentdate,$userid,$host));
        }
            
            

        if($fonodeu3 != ''){
                if(substr($fonodeu3,2)!= '09'){
                    $tipotelefono = 'CON';
                }else{ $tipotelefono = 'CEL';}

                $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute(array(0,$cedenteid,$personaid,0,$fonodeu3,$tipotelefono,$tipocliente,0,
                                            $newestado,$currentdate,$userid,$host));
        }
        
        if($fonodeu4 != ''){
            if(substr($fonodeu3,2)!= '09'){
                $tipotelefono = 'CON';
            }else{ $tipotelefono = 'CEL';}

            $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$cedenteid,$personaid,0,$fonodeu4,$tipotelefono,$tipocliente,0,
                                        $newestado,$currentdate,$userid,$host));
        } 
        
        
        if($fonodeu5 != ''){
            if(substr($fonodeu3,2)!= '09'){
                $tipotelefono = 'CON';
            }else{ $tipotelefono = 'CEL';}

            $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$cedenteid,$personaid,0,$fonodeu5,$tipotelefono,$tipocliente,0,
                                        $newestado,$currentdate,$userid,$host));
        }   
        
        if($fonodeu6 != ''){
            if(substr($fonodeu3,2)!= '09'){
                $tipotelefono = 'CON';
            }else{ $tipotelefono = 'CEL';}

            $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$cedenteid,$personaid,0,$fonodeu6,$tipotelefono,$tipocliente,0,
                                        $newestado,$currentdate,$userid,$host));
        }
        
        if($fonodeu7 != ''){
            if(substr($fonodeu3,2)!= '09'){
                $tipotelefono = 'CON';
            }else{ $tipotelefono = 'CEL';}

            $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$cedenteid,$personaid,0,$fonodeu7,$tipotelefono,$tipocliente,0,
                                        $newestado,$currentdate,$userid,$host));
        }
        
        if($fonodeu8 != ''){
            if(substr($fonodeu3,2)!= '09'){
                $tipotelefono = 'CON';
            }else{ $tipotelefono = 'CEL';}

            $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$cedenteid,$personaid,0,$fonodeu8,$tipotelefono,$tipocliente,0,
                                        $newestado,$currentdate,$userid,$host));
        }
        
        if($fonodeu9 != ''){
            if(substr($fonodeu3,2)!= '09'){
                $tipotelefono = 'CON';
            }else{ $tipotelefono = 'CEL';}

            $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$cedenteid,$personaid,0,$fonodeu9,$tipotelefono,$tipocliente,0,
                                        $newestado,$currentdate,$userid,$host));
        }  
        
        if($fonodeu10 != ''){
            if(substr($fonodeu3,2)!= '09'){
                $tipotelefono = 'CON';
            }else{ $tipotelefono = 'CEL';}

            $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$cedenteid,$personaid,0,$fonodeu10,$tipotelefono,$tipocliente,0,
                                        $newestado,$currentdate,$userid,$host));
        }                                    

              //INSERTAR DIRECCION Y CORREO DEUDOR             

        if($direcciondom != ''){
            $tipodireccion = 'DIRECCION';
            $definicion = 'DOM';

            $consulta = "CALL sp_New_Direccion_Correos(?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$cedula,'',$tipodireccion,$tipocliente,$definicion,
                                       $direcciondom,$referenciadom,'',$currentdate,$userid,$host));
          
        }

        if($direcciontra != ''){
            $tipodireccion = 'DIRECCION';
            $definicion = 'TRA';
            
            $consulta = "CALL sp_New_Direccion_Correos(?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$cedula,'',$tipodireccion,$tipocliente,$definicion,
                                       $direcciontra,$referenciatra,'',$currentdate,$userid,$host));
        }        

        if($email != ''){
            $tipodireccion = 'CORREO';
            $definicion = 'PER';

            $consulta = "CALL sp_New_Direccion_Correos(?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$cedula,'',$tipodireccion,$tipocliente,$definicion,
                                       '','',$email,$currentdate,$userid,$host));
          
        }           

        $consulta = "CALL sp_Subir_Cuenta_Deudor(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(array(0,$personaid,$cedenteid,$productoid,$catalogoid,$operacion,$totaldeuda,$diasmora,
                                   $capitalxvencer,$capitalvencido,$capitalmora,$valorexigible,$fechaobligacion,
                                    $fechavencimiento,$fechaultpago,0,$newestado));


        $tipocliente = 'FAM'; 
        $tipotelefono = 'CEL';

        if($nombreref1 != '')
        {
            if($cedularef1 == ''){
                $cedularef1 = $cedula;
            }

            ///INSERT EN TABLA DEUDOR_REFERENCIA
            $consulta = "CALL sp_New_Referencia_Deudor(?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$personaid,$cedularef1,$nombreref1,$tipocliente,$currentdate,$userid,$host));   
            
            $referenid = $resultado->fetchColumn();
            
            if($fono1ref1 != '')
            {
                if(substr($fono1ref1,2) != '09'){
                    $tipotelefono = 'CON';
                }else{ $tipotelefono = 'CEL';}
               
                $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute(array(0,$cedenteid,$personaid,$referenid,$fono1ref1,$tipotelefono,$tipocliente,0,
                                            $newestado,$currentdate,$userid,$host));
            }

            if($fono2ref1 != '')
            {
                if(substr($fono2ref1,2) != '09'){
                    $tipotelefono = 'CON';
                }else{ $tipotelefono = 'CEL';}
                
                $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute(array(0,$cedenteid,$personaid,$referenid,$fono2ref1,$tipotelefono,$tipocliente,0,
                                            $newestado,$currentdate,$userid,$host));
            }

            if($direcciondomref1 != ''){
                $tipodireccion = 'DIRECCION';
                $definicion = 'DOM';
                
                $consulta = "CALL sp_New_Direccion_Correos(?,?,?,?,?,?,?,?,?,?,?,?)";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute(array(0,$cedula,$cedularef1,$tipodireccion,$tipocliente,$definicion,
                                       $direcciondomref1,$referenciadomref1,'',$currentdate,$userid,$host));
            }

            if($emailref1 != ''){
                $tipodireccion = 'CORREO';
                $definicion = 'PER';
    
                $consulta = "CALL sp_New_Direccion_Correos(?,?,?,?,?,?,?,?,?,?,?,?)";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute(array(0,$cedula,$cedularef1,$tipodireccion,$tipocliente,$definicion,
                                           '','',$emailref1,$currentdate,$userid,$host));
              
            }    


        }

        //REFERENCIA  DEUDOR 2

        if($nombreref2 != '')
        {
            if($cedularef2 == ''){
                $cedularef2 = $cedula;
            }

           
            $consulta = "CALL sp_New_Referencia_Deudor(?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$personaid,$cedularef2,$nombreref2,$tipocliente,$currentdate,$userid,$host));   
            
            $referenid = $resultado->fetchColumn();
            
            if($fono1ref2 != '')
            {
                if(substr($fono1ref2,2) != '09'){
                    $tipotelefono = 'CON';
                }else{ $tipotelefono = 'CEL';}
               
                $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute(array(0,$cedenteid,$personaid,$referenid,$fono1ref2,$tipotelefono,$tipocliente,0,
                                            $newestado,$currentdate,$userid,$host));
            }

            if($fono2ref2 != '')
            {
                if(substr($fono2ref1,2) != '09'){
                    $tipotelefono = 'CON';
                }else{ $tipotelefono = 'CEL';}
                
                $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute(array(0,$cedenteid,$personaid,$referenid,$fono2ref2,$tipotelefono,$tipocliente,0,
                                            $newestado,$currentdate,$userid,$host));
            }

            if($direcciondomref2 != ''){
                $tipodireccion = 'DIRECCION';
                $definicion = 'DOM';
                
                $consulta = "CALL sp_New_Direccion_Correos(?,?,?,?,?,?,?,?,?,?,?,?)";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute(array(0,$cedula,$cedularef1,$tipodireccion,$tipocliente,$definicion,
                                       $direcciondomref2,$referenciadomref2,'',$currentdate,$userid,$host));
            }

            if($emailref2 != ''){
                $tipodireccion = 'CORREO';
                $definicion = 'PER';
    
                $consulta = "CALL sp_New_Direccion_Correos(?,?,?,?,?,?,?,?,?,?,?,?)";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute(array(0,$cedula,$cedularef2,$tipodireccion,$tipocliente,$definicion,
                                           '','',$emailref2,$currentdate,$userid,$host));
              
            }    


        }

        // INSERTEAR GARANTE 1

        $tipocliente = 'GAR'; 
        $tipotelefono = 'CEL';

        if($nombregarante1 != ''){

            if($cedulagarante1 = ''){
                 $cedula = $cedulagarante1; 
            }


            $consulta = "CALL sp_New_Garante_Deudor(?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$tipocliente,$cedula,$cedulagarante1,$nombregarante1,$currentdate,$userid,$host));


            if($direcciondomgara1 != ''){
               
                $tipodireccion = 'DIRECCION';
                $definicion = 'DOM';

                $consulta = "CALL sp_New_Direccion_Correos(?,?,?,?,?,?,?,?,?,?,?,?)";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute(array(0,$cedula,$cedulagarante1,$tipodireccion,$tipocliente,$definicion,
                                       $direcciondomgara1,$referenciadomgara1,'',$currentdate,$userid,$host));

            }

            if($direcciontragara1 != ''){
               
                $tipodireccion = 'DIRECCION';
                $definicion = 'TRA';

                $consulta = "CALL sp_New_Direccion_Correos(?,?,?,?,?,?,?,?,?,?,?,?)";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute(array(0,$cedula,$cedulagarante1,$tipodireccion,$tipocliente,$definicion,
                                       $direcciontragara1,$referenciatragara1,'',$currentdate,$userid,$host));

            }

            if($emailpersonalgara1 != ''){
               
                $tipodireccion = 'CORREO';
                $definicion = 'PER';

                $consulta = "CALL sp_New_Direccion_Correos(?,?,?,?,?,?,?,?,?,?,?,?)";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute(array(0,$cedula,$cedulagarante1,$tipodireccion,$tipocliente,$definicion,
                                       '','',$emailpersonalgara1,$currentdate,$userid,$host));

            }

            if($emailtrabajogara1 != ''){
               
                $tipodireccion = 'CORREO';
                $definicion = 'TRA';

                $consulta = "CALL sp_New_Direccion_Correos(?,?,?,?,?,?,?,?,?,?,?,?)";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute(array(0,$cedula,$cedulagarante1,$tipodireccion,$tipocliente,$definicion,
                                       '','',$emailtrabajogara1,$currentdate,$userid,$host));

            }

            if($fono1gara1 != '')
            {
                if(substr($fono1gara1,2) != '09'){
                    $tipotelefono = 'CON';
                }else{ $tipotelefono = 'CEL';}
                
                $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute(array(0,$cedenteid,$personaid,0,$fono1gara1,$tipotelefono,$tipocliente,0,
                                            $newestado,$currentdate,$userid,$host));
            }

            if($fono2gara1 != '')
            {
                if(substr($fono2gara1,2) != '09'){
                    $tipotelefono = 'CON';
                }else{ $tipotelefono = 'CEL';}
                
                $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute(array(0,$cedenteid,$personaid,0,$fono2gara1,$tipotelefono,$tipocliente,0,
                                            $newestado,$currentdate,$userid,$host));
            }

            if($fono3gara1 != '')
            {
                if(substr($fono3gara1,2) != '09'){
                    $tipotelefono = 'CON';
                }else{ $tipotelefono = 'CEL';}
                
                $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute(array(0,$cedenteid,$personaid,0,$fono3gara1,$tipotelefono,$tipocliente,0,
                                            $newestado,$currentdate,$userid,$host));
            }


        }

         // INSERTEAR GARANTE 2

         if($nombregarante2 != ''){

            if($cedulagarante2 = ''){
                $cedula = $cedulagarante2; 
            }


            $consulta = "CALL sp_New_Garante_Deudor(?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$tipocliente,$cedula,$cedulagarante2,$nombregarante2,$currentdate,$userid,$host));


            if($direcciondomgara2 != ''){
               
                $tipodireccion = 'DIRECCION';
                $definicion = 'DOM';

                $consulta = "CALL sp_New_Direccion_Correos(?,?,?,?,?,?,?,?,?,?,?,?)";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute(array(0,$cedula,$cedulagarante2,$tipodireccion,$tipocliente,$definicion,
                                       $direcciondomgara2,$referenciadomgara2,'',$currentdate,$userid,$host));

            }

            if($direcciontragara2 != ''){
               
                $tipodireccion = 'DIRECCION';
                $definicion = 'TRA';

                $consulta = "CALL sp_New_Direccion_Correos(?,?,?,?,?,?,?,?,?,?,?,?)";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute(array(0,$cedula,$cedulagarante2,$tipodireccion,$tipocliente,$definicion,
                                       $direcciontragara2,$referenciatragara2,'',$currentdate,$userid,$host));

            }

            if($emailpersonalgara2 != ''){
               
                $tipodireccion = 'CORREO';
                $definicion = 'PER';

                $consulta = "CALL sp_New_Direccion_Correos(?,?,?,?,?,?,?,?,?,?,?,?)";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute(array(0,$cedula,$cedulagarante2,$tipodireccion,$tipocliente,$definicion,
                                       '','',$emailpersonalgara2,$currentdate,$userid,$host));

            }

            if($emailtrabajogara2 != ''){
               
                $tipodireccion = 'CORREO';
                $definicion = 'TRA';

                $consulta = "CALL sp_New_Direccion_Correos(?,?,?,?,?,?,?,?,?,?,?,?)";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute(array(0,$cedula,$cedulagarante2,$tipodireccion,$tipocliente,$definicion,
                                       '','',$emailtrabajogara2,$currentdate,$userid,$host));

            }

            if($fono1gara2 != '')
            {
                if(substr($fono1gara2,2) != '09'){
                    $tipotelefono = 'CON';
                }else{ $tipotelefono = 'CEL';}
                
                $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute(array(0,$cedenteid,$personaid,0,$fono1gara2,$tipotelefono,$tipocliente,0,
                                            $newestado,$currentdate,$userid,$host));
            }

            if($fono2gara2 != '')
            {
                if(substr($fono2gara2,2) != '09'){
                    $tipotelefono = 'CON';
                }else{ $tipotelefono = 'CEL';}
                
                $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute(array(0,$cedenteid,$personaid,0,$fono2gara2,$tipotelefono,$tipocliente,0,
                                            $newestado,$currentdate,$userid,$host));
            }

            if($fono3gara2 != '')
            {
                if(substr($fono3gara1,2) != '09'){
                    $tipotelefono = 'CON';
                }else{ $tipotelefono = 'CEL';}
                
                $consulta = "CALL sp_New_Telefonos(?,?,?,?,?,?,?,?,?,?,?,?)";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute(array(0,$cedenteid,$personaid,0,$fono3gara2,$tipotelefono,$tipocliente,0,
                                            $newestado,$currentdate,$userid,$host));
            }


        }

        //CAMPOS ADICIONALES

        if($adicional1 != ''){

            $consulta = "CALL sp_New_Campos_Adicionales(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$cedenteid,$catalogoid,$personaid,$operacion,$adicional1,'','','','',
                                       '','','','','','','','','','','','','','','','','','','','','','','','',''));
        }

        if($adicional2 != ''){

            $consulta = "CALL sp_New_Campos_Adicionales(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$cedenteid,$catalogoid,$personaid,$operacion,'',$adicional2 ,'','','',
                                       '','','','','','','','','','','','','','','','','','','','','','','','',''));
        }

        if($adicional3 != ''){

            $consulta = "CALL sp_New_Campos_Adicionales(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$cedenteid,$catalogoid,$personaid,$operacion,'','',$adicional3,'','',
                                       '','','','','','','','','','','','','','','','','','','','','','','','',''));
        }

        if($adicional4 != ''){

            $consulta = "CALL sp_New_Campos_Adicionales(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$cedenteid,$catalogoid,$personaid,$operacion,'','','',$adicional4 ,'',
                                       '','','','','','','','','','','','','','','','','','','','','','','','',''));
        }

        if($adicional5 != ''){

            $consulta = "CALL sp_New_Campos_Adicionales(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$cedenteid,$catalogoid,$personaid,$operacion,'','','','',$adicional5,
                                       '','','','','','','','','','','','','','','','','','','','','','','','',''));
        }

        if($adicional6 != ''){

            $consulta = "CALL sp_New_Campos_Adicionales(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$cedenteid,$catalogoid,$personaid,$operacion,'','','','','',
                       $adicional6,'','','','','','','','','','','','','','','','','','','','','','','',''));
        }

        if($adicional7 != ''){

            $consulta = "CALL sp_New_Campos_Adicionales(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$cedenteid,$catalogoid,$personaid,$operacion,'','','','','',
                       '',$adicional7,'','','','','','','','','','','','','','','','','','','','','','',''));
        }

        if($adicional8 != ''){

            $consulta ="CALL sp_New_Campos_Adicionales(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$cedenteid,$catalogoid,$personaid,$operacion,'','','','','',
                       '','',$adicional8,'','','','','','','','','','','','','','','','','','','','','',''));
        }

        if($adicional9 != ''){

            $consulta ="CALL sp_New_Campos_Adicionales(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$cedenteid,$catalogoid,$personaid,$operacion,'','','','','',
                       '','','',$adicional9,'','','','','','','','','','','','','','','','','','','','',''));
        }

        if($adicional10 != ''){

            $consulta = "CALL sp_New_Campos_Adicionales(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$cedenteid,$catalogoid,$personaid,$operacion,'','','','','',
                       '','','','',$adicional10,'','','','','','','','','','','','','','','','','','','',''));
        }

        if($adicional11 != ''){

            $consulta ="CALL sp_New_Campos_Adicionales(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$cedenteid,$catalogoid,$personaid,$operacion,'','','','','',
                       '','','','','',$adicional11,'','','','','','','','','','','','','','','','','','',''));
        }

        if($adicional12 != ''){

            $consulta ="CALL sp_New_Campos_Adicionales(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$cedenteid,$catalogoid,$personaid,$operacion,'','','','','',
                       '','','','','','',$adicional12,'','','','','','','','','','','','','','','','','',''));
        }

        if($adicional13 != ''){

            $consulta ="CALL sp_New_Campos_Adicionales(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$cedenteid,$catalogoid,$personaid,$operacion,'','','','','',
                       '','','','','','','',$adicional13,'','','','','','','','','','','','','','','','',''));
        }

        if($adicional14 != ''){

            $consulta = "CALL sp_New_Campos_Adicionales(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$cedenteid,$catalogoid,$personaid,$operacion,'','','','','',
                       '','','','','','','','',$adicional14 ,'','','','','','','','','','','','','','','',''));
        }

        if($adicional15 != ''){

            $consulta ="CALL sp_New_Campos_Adicionales(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$cedenteid,$catalogoid,$personaid,$operacion,'','','','','',
                       '','','','','','','','','',$adicional15,'','','','','','','','','','','','','','',''));
        }

        if($adicional16 != ''){

            $consulta ="CALL sp_New_Campos_Adicionales(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$cedenteid,$catalogoid,$personaid,$operacion,'','','','','',
                       '','','','','','','','','','',$adicional16,'','','','','','','','','','','','','',''));
        }

        if($adicional17 != ''){

            $consulta = "CALL sp_New_Campos_Adicionales(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$cedenteid,$catalogoid,$personaid,$operacion,'','','','','',
                       '','','','','','','','','','','',$adicional17,'','','','','','','','','','','','',''));
        }

        if($adicional18 != ''){

            $consulta ="CALL sp_New_Campos_Adicionales(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$cedenteid,$catalogoid,$personaid,$operacion,'','','','','',
                       '','','','','','','','','','','','',$adicional18,'','','','','','','','','','','',''));
        }

        if($adicional19 != ''){

            $consulta = "CALL sp_New_Campos_Adicionales(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$cedenteid,$catalogoid,$personaid,$operacion,'','','','','',
                       '','','','','','','','','','','','','',$adicional19,'','','','','','','','','','',''));
        }

        
        if($adicional20 != ''){

            $consulta = "CALL sp_New_Campos_Adicionales(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$cedenteid,$catalogoid,$personaid,$operacion,'','','','','',
                       '','','','','','','','','','','','','','',$adicional20,'','','','','','','','','',''));
        }

        if($adicional21 != ''){

            $consulta ="CALL sp_New_Campos_Adicionales(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$cedenteid,$catalogoid,$personaid,$operacion,'','','','','',
                       '','','','','','','','','','','','','','','',$adicional21,'','','','','','','','',''));
        }

        if($adicional22 != ''){

            $consulta ="CALL sp_New_Campos_Adicionales(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$cedenteid,$catalogoid,$personaid,$operacion,'','','','','',
                       '','','','','','','','','','','','','','','','',$adicional22,'','','','','','','',''));
        }

        if($adicional23 != ''){

            $consulta = "CALL sp_New_Campos_Adicionales(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$cedenteid,$catalogoid,$personaid,$operacion,'','','','','',
                       '','','','','','','','','','','','','','','','','',$adicional23,'','','','','','',''));
        }

        if($adicional24 != ''){

            $consulta ="CALL sp_New_Campos_Adicionales(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$cedenteid,$catalogoid,$personaid,$operacion,'','','','','',
                       '','','','','','','','','','','','','','','','','','',$adicional24,'','','','','',''));
        }

        if($adicional25 != ''){

            $consulta ="CALL sp_New_Campos_Adicionales(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$cedenteid,$catalogoid,$personaid,$operacion,'','','','','',
                       '','','','','','','','','','','','','','','','','','','',$adicional25,'','','','',''));
        }

        if($adicional26 != ''){

            $consulta ="CALL sp_New_Campos_Adicionales(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$cedenteid,$catalogoid,$personaid,$operacion,'','','','','',
                       '','','','','','','','','','','','','','','','','','','','',$adicional26,'','','',''));
        }

        if($adicional27 != ''){

            $consulta = "CALL sp_New_Campos_Adicionales(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$cedenteid,$catalogoid,$personaid,$operacion,'','','','','',
                       '','','','','','','','','','','','','','','','','','','','','',$adicional27,'','',''));
        }

        if($adicional28 != ''){

            $consulta = "CALL sp_New_Campos_Adicionales(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$cedenteid,$catalogoid,$personaid,$operacion,'','','','','',
                       '','','','','','','','','','','','','','','','','','','','','','',$adicional28,'',''));
        }

        if($adicional29 != ''){

            $consulta ="CALL sp_New_Campos_Adicionales(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$cedenteid,$catalogoid,$personaid,$operacion,'','','','','',
                       '','','','','','','','','','','','','','','','','','','','','','','',$adicional29,''));
        }

        if($adicional30 != ''){

            $consulta ="CALL sp_New_Campos_Adicionales(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(array(0,$cedenteid,$catalogoid,$personaid,$operacion,'','','','','',
                       '','','','','','','','','','','','','','','','','','','','','','','','',$adicional30));
        }
                         
        break;
                
            
    case 1: //
      
    case 2: //
      
    case 3: //
             
    case 4://
     
    case 5: //
      
          
}

print json_encode($data, JSON_UNESCAPED_UNICODE);

$conexion = null;

?>