$(document).ready(function(){

  var  _cbocedente, _cboid, _cboproducto, _cbocatalogo,_cbocedeid, _cbopro, _catalogoid, _resultCartera = [];

  $('#cboCiudad').select2();
  $('#cboCedente').select2();
  $('#cboProducto').select2();
  $('#cboCatalogo').select2();

  _cbocedente = $('#cboCedente');
  _cboproducto = $('#cboProducto'); 
  _cbocatalogo = $('#cboCatalogo');  

  const form = document.querySelector("#container");
  fileInput = form.querySelector(".file"),
  form.addEventListener("click",()=>{
   fileInput.click();
  });

  let fileName = document.getElementById('file_input');
  let fileNameField = document.getElementById('file_name');

  fileName.addEventListener('change', function(event){
      let uploadFileName = event.target.files[0].name;
      fileNameField.textContent = uploadFileName;
  });



  $('#cboCiudad').change(function(){
    _cboid = $(this).val(); //obtener el id seleccionado

    
    $("#cboCedente").empty();
    $("#cboCedente").append('<option value=0>--Seleccione Cedente--</option>');

    $("#cboProducto").empty();
    $("#cboProducto").append('<option value=0>--Seleccione Producto--</option>');

    $("#cboCatalogo").empty();
    $("#cboCatalogo").append('<option value=0>--Seleccione Catalogo--</option>');

    $("#cboGestor").empty();
    $("#cboGestor").append('<option value=0>--Seleccione Gestor--</option>');
   

    if(_cboid != '0'){ 
      $.ajax({
        dataType: 'html',
        type: 'POST',
        url: '../db/cargarcombos.php',
        data: {opcion:2, idciu:_cboid},
      }).done(function(data){

        _cbocedente.html(data);
        _cbocedente.select2();
      });
    }   
  });

  $('#cboCedente').change(function(){

    _cbocedeid = $(this).val();


    $.ajax({
      dataType: 'html',
      type: 'POST',
      url: '../db/cargarcombos.php',
      data: {opcion:4, cedeid:_cbocedeid},
    }).done(function(data){

      _cboproducto.html(data);
      _cboproducto.select2();
    });
     

  });
  
  
    $('#cboProducto').change(function(){

      
      _cbopro = $(this).val();

      $.ajax({
        dataType: 'html',
        type: 'POST',
        url: '../db/cargarcombos.php',
        data: {opcion:5, proid:_cbopro},
      }).done(function(data){

        _cbocatalogo.html(data);
        _cbocatalogo.select2();
      });


    }); 

    $('#cboCatalogo').change(function(){

      _catalogoid = $(this).val();

    });    


    $("#btnProcesar").click(function(){

        let _cbociudad = $('#cboCiudad').val();
        let _cbocedente = $('#cboCedente').val();
        let _cboproducto = $('#cboProducto').val();
        let _cbocatalogo = $('#cboCatalogo').val();

        if(_cbociudad == '0')
        {
            mensajesalertify("Seleccione Ciudad..!","W","top-right",3);
            return;
        }

        if(_cbocedente == '0')
        {
            mensajesalertify("Seleccione Cedente..!","W","top-right",3);
            return;
        }

        if(_cboproducto == '0')
        {
            mensajesalertify("Seleccione Producto..!","W","top-right",3);
            return;
        }

        if(_cbocatalogo == '0')
        {
            mensajesalertify("Seleccione Catalogo..!","W","top-right",3);
            return;
        }



        document.querySelector('#btnProcesar').addEventListener('click', function(){

            if(document.querySelector('#file_input').files.length == 0){
        
                mensajesalertify("Seleccione un archivo","E","top-center",3);
                return;
        
                }

            let _inputFile = document.querySelector('#file_input').files[0];
            let _progressbar = document.querySelector('#progressBar');

            let data = new FormData();
       
        });


       
      
        $("#tablecartera tbody tr").each(function (items) 
        {
            let _cedula, _nombres, _apellidos, _fechanacimiento, _provincia, _ciudad;
            
            $(this).children("td").each(function (index) 
            {
                switch(index){
                    case 0:
                        _cedula = $.trim($(this).text());
                        break;
                    case 1:
                        _nombres = $.trim($(this).text());
                        break;
                    case 2:
                        _apellidos = $.trim($(this).text());
                        break;
                    case 3:
                        _fechanacimiento = $.trim($(this).text());
                        break;
                    case 4:
                        _provincia = $.trim($(this).text());
                        break;
                    case 5:
                        _ciudad = $.trim($(this).text());
                        break;
                    case 6:
                        _direcciondom = $.trim($(this).text());
                        break;                        
                    case 7:
                        _referenciadom = $.trim($(this).text());
                        break;
                    case 8:
                        _direcciontrab = $.trim($(this).text());
                        break;
                    case 9:
                        _referenciatrab = $.trim($(this).text());
                        break;
                    case 10:
                        _email = $.trim($(this).text());
                        break;
                    case 11:
                        _operacion = $.trim($(this).text());
                        break;
                    case 12:
                        _totaldeuda = $.trim($(this).text());
                        break;
                    case 13:
                        _diasmora = $.trim($(this).text());
                        break;
                    case 14:
                        _capitalxvencer = $.trim($(this).text());
                        break;
                    case 15:
                        _capitalvencido = $.trim($(this).text());
                        break;
                    case 16:
                        _capitalmora = $.trim($(this).text());
                        break;
                    case 17:
                        _valorexigible = $.trim($(this).text());
                        break;
                    case 18:
                        _fechaobligacion = $.trim($(this).text());
                        break;
                    case 19:
                        _fechavencimiento = $.trim($(this).text());
                        break;
                    case 20:
                        _fechaultimopago = $.trim($(this).text());
                        break;
                    case 21:
                        _fonodeudor1 = $.trim($(this).text());
                        break;
                    case 22:
                        _fonodeudor2 = $.trim($(this).text());
                        break;
                    case 23:
                        _fonodeudor3 = $.trim($(this).text());
                        break;
                    case 24:
                        _fonodeudor4 = $.trim($(this).text());
                        break;
                    case 25:
                        _fonodeudor5 = $.trim($(this).text());
                        break;
                    case 26:
                        _fonodeudor6 = $.trim($(this).text());
                        break;
                    case 27:
                        _fonodeudor7 = $.trim($(this).text());
                        break;
                    case 28:
                        _fonodeudor8 = $.trim($(this).text());
                        break;
                    case 29:
                        _fonodeudor9 = $.trim($(this).text());
                        break;
                    case 30:
                        _fonodeudor10 = $.trim($(this).text());
                        break;
                    case 31:
                        _cedularef1 = $.trim($(this).text());
                        break;
                    case 32:
                        _nomref1 = $.trim($(this).text());
                        break;
                    case 33:
                        _fono1ref1 = $.trim($(this).text());
                        break;
                    case 34:
                        _fono2ref1 = $.trim($(this).text());
                        break;
                    case 35:
                        _direcdomref1 = $.trim($(this).text());
                        break;
                    case 36:
                        _refdomref1 = $.trim($(this).text());
                        break;
                    case 37:
                        _emailref1 = $.trim($(this).text());
                        break;
                    case 38:
                        _cedularef2 = $.trim($(this).text());
                        break;
                    case 39:
                        _nomref2 = $.trim($(this).text());
                        break;
                    case 40:
                        _fono1ref2 = $.trim($(this).text());
                        break;
                    case 41:
                        _fono2ref2 = $.trim($(this).text());
                        break;
                    case 42:
                        _direcdomref2 = $.trim($(this).text());
                        break;
                    case 43:
                        _refdomref2 = $.trim($(this).text());
                        break;
                    case 44:
                        _emailref2 = $.trim($(this).text());
                        break;
                    case 45:
                        _tipogarante1 = $.trim($(this).text());
                        break;
                    case 46:
                        _cedulagarante1 = $.trim($(this).text());
                        break;
                    case 47:
                        _nombregarante1 = $.trim($(this).text());
                        break;
                    case 48:
                        _direccdomgarante1 = $.trim($(this).text());
                        break;
                    case 49:
                        _referendomgarante1 = $.trim($(this).text());
                        break;
                    case 50:
                        _direcctragarante1 = $.trim($(this).text());
                        break;
                    case 51:
                        _referentragarante1 = $.trim($(this).text());
                        break;
                    case 52:
                        _emailpergarante1 = $.trim($(this).text());
                        break;
                    case 53:
                        _emailtragarante1 = $.trim($(this).text());
                        break;
                    case 54:
                        _fono1garante1 = $.trim($(this).text());
                        break;
                    case 55:
                        _fono2garante1 = $.trim($(this).text());
                        break;
                    case 56:
                        _fono3garante1 = $.trim($(this).text());
                        break;
                    case 57:
                        _tipogarante2 = $.trim($(this).text());
                        break;
                    case 58:
                        _cedulagarante2 = $.trim($(this).text());
                        break;
                    case 59:
                        _nombregarante2 = $.trim($(this).text());
                        break;
                    case 60:
                        _direccdomgarante2 = $.trim($(this).text());
                        break;
                    case 61:
                        _referendomgarante2 = $.trim($(this).text());
                        break;
                    case 62:
                        _direcctragarante2 = $.trim($(this).text());
                        break;
                    case 63:
                        _referentragarante2 = $.trim($(this).text());
                        break;
                    case 64:
                        _emailpergarante2 = $.trim($(this).text());
                        break;
                    case 65:
                        _emailtragarante2 = $.trim($(this).text());
                        break;
                    case 66:
                        _fono1garante2 = $.trim($(this).text());
                        break;
                    case 67:
                        _fono2garante2 = $.trim($(this).text());
                        break;
                    case 68:
                        _fono3garante2 = $.trim($(this).text());
                        break;                        
                    case 69:
                        _adicional1 = $.trim($(this).text());
                        break;
                    case 70:
                        _adicional2 = $.trim($(this).text());
                        break;
                    case 71:
                        _adicional3 = $.trim($(this).text());
                        break;
                    case 72:
                        _adicional4 = $.trim($(this).text());
                        break;
                    case 73:
                        _adicional5 = $.trim($(this).text());
                        break;
                    case 74:
                        _adicional6 = $.trim($(this).text());
                        break;
                    case 75:
                        _adicional7 = $.trim($(this).text());
                        break;
                    case 76:
                        _adicional8 = $.trim($(this).text());
                        break;
                    case 77:
                        _adicional9 = $.trim($(this).text());
                        break;
                    case 78:
                        _adicional10 = $.trim($(this).text());
                        break;
                    case 79:
                        _adicional11 = $.trim($(this).text());
                        break;
                    case 80:
                        _adicional12 = $.trim($(this).text());
                        break;
                    case 81:
                        _adicional13 = $.trim($(this).text());
                        break;
                    case 82:
                        _adicional14 = $.trim($(this).text());
                        break;
                    case 83:
                        _adicional15 = $.trim($(this).text());
                        break;
                    case 84:
                        _adicional16 = $.trim($(this).text());
                        break;
                    case 85:
                        _adicional17 = $.trim($(this).text());
                        break;
                    case 86:
                        _adicional18 = $.trim($(this).text());
                        break;
                    case 87:
                        _adicional19 = $.trim($(this).text());
                        break;
                    case 88:
                        _adicional20 = $.trim($(this).text());
                        break;
                    case 89:
                        _adicional21 = $.trim($(this).text());
                        break;
                    case 90:
                        _adicional22 = $.trim($(this).text());
                        break;
                    case 91:
                        _adicional23 = $.trim($(this).text());
                        break;
                    case 92:
                        _adicional24 = $.trim($(this).text());
                        break;
                    case 93:
                        _adicional25 = $.trim($(this).text());
                        break;
                    case 94:
                        _adicional26 = $.trim($(this).text());
                        break;
                    case 95:
                        _adicional27 = $.trim($(this).text());
                        break;
                    case 96:
                        _adicional28 = $.trim($(this).text());
                        break;
                    case 97:
                        _adicional29 = $.trim($(this).text());
                        break;
                    case 98:
                        _adicional30 = $.trim($(this).text());
                        break;
                }
            }); 
            
            // console.log(_idpade);
           

            _objeto = 
            {
                arrycedula : _cedula,
                arrynombres : _nombres,
                arryapellidos : _apellidos,
                arryfechanac : _fechanacimiento,
                arryprovincia : _provincia,
                arryciudad : _ciudad,
                arrydirecdom : _direcciondom,
                arryrefedom : _referenciadom,
                arrydirectra : _direcciontrab,
                arryreftrabajo : _referenciatrab,
                arryemail : _email,
                arryoperacion : _operacion,
                arrytotaldeuda : _totaldeuda,
                arrydiasmora : _diasmora,
                arrycapitalxvencer : _capitalxvencer,
                arrycapitalvencido : _capitalvencido,
                arrycapitalmora : _capitalmora,
                arryvalorexigible : _valorexigible,
                arryfechaobligacion : _fechaobligacion,
                arryfechavencimiento : _fechavencimiento,
                arryfechaultpago : _fechaultimopago,
                arryfonodeu1 : _fonodeudor1,
                arryfonodeu2 : _fonodeudor2,
                arryfonodeu3 : _fonodeudor3,
                arryfonodeu4 : _fonodeudor4,
                arryfonodeu5 : _fonodeudor5,
                arryfonodeu6 : _fonodeudor6,
                arryfonodeu7 : _fonodeudor7,
                arryfonodeu8 : _fonodeudor8,
                arryfonodeu9 : _fonodeudor9,
                arryfonodeu10 : _fonodeudor10,
                arryceduref1 : _cedularef1,
                arrynomref1 : _nomref1,
                arryfono1ref1 : _fono1ref1,
                arryfono2ref1 : _fono2ref1,
                arrydireccdomref1 : _direcdomref1,
                arryrefedomref1 : _refdomref1,
                arryemailref1 : _emailref1,
                arryceduref2 : _cedularef2,
                arrynomref2 : _nomref2,
                arryfono1ref2 : _fono1ref2,
                arryfono2ref2 : _fono2ref2,
                arrydireccdomref2 : _direcdomref2,
                arryrefedomref2 : _refdomref2,
                arryemailref2 : _emailref2,
                arrytipogarante1 : _tipogarante1,
                arrycedulagarante1 : _cedulagarante1,
                arrynomgarante1 : _nombregarante1,
                arrydirecdomgarante1 : _direccdomgarante1,
                arryrefdomgarante1 : _referendomgarante1,
                arrydirectragarante1 : _direcctragarante1,
                arryreftragarante1 : _referentragarante1,
                arryemailpergarante1 : _emailpergarante1,
                arryemailtragarante1 : _emailtragarante1,
                arryfono1garante1 : _fono1garante1,
                arryfono2garante1 : _fono2garante1,
                arryfono3garante1 : _fono3garante1,
                arrytipogarante2 : _tipogarante2,
                arrycedulagarante2 : _cedulagarante2,
                arrynomgarante2 : _nombregarante2,
                arrydirecdomgarante2 : _direccdomgarante2,
                arryrefdomgarante2 : _referendomgarante2,
                arrydirectragarante2 : _direcctragarante2,
                arryreftragarante2 : _referentragarante2,
                arryemailpergarante2 : _emailpergarante2,
                arryemailtragarante2 : _emailtragarante2,
                arryfono1garante2 : _fono1garante2,
                arryfono2garante2 : _fono2garante2,
                arryfono3garante2 : _fono3garante2,
                arryadicional1 : _adicional1,
                arryadicional2 : _adicional2,
                arryadicional3 : _adicional3,
                arryadicional4 : _adicional4,
                arryadicional5 : _adicional5,
                arryadicional6 : _adicional6,
                arryadicional7 : _adicional7,
                arryadicional8 : _adicional8,
                arryadicional9 : _adicional9,
                arryadicional10 : _adicional10,
                arryadicional11 : _adicional11,
                arryadicional12 : _adicional12,
                arryadicional13 : _adicional13,
                arryadicional14 : _adicional14,
                arryadicional15 : _adicional15,
                arryadicional16 : _adicional16,
                arryadicional17 : _adicional17,
                arryadicional18 : _adicional18,
                arryadicional19 : _adicional19,
                arryadicional20 : _adicional20,
                arryadicional21 : _adicional21,
                arryadicional22 : _adicional22,
                arryadicional23 : _adicional23,
                arryadicional24 : _adicional24,
                arryadicional25 : _adicional25,
                arryadicional26 : _adicional26,
                arryadicional27 : _adicional27,
                arryadicional28 : _adicional28,
                arryadicional29 : _adicional29,
                arryadicional30 : _adicional30,
            }
    
            _resultCartera.push(_objeto); 
          
        });

       
        _resultCartera.forEach(function(cartera, index) {
            console.log(`${index} : ${cartera.arrycedula} ${cartera.arrynombres}`);

            $.ajax({
                url: "../db/herramientacrud.php",
                type: "POST",
                dataType: "json",
                data: {
                    cedeid: _cbocedeid, 
                    producid: _cbopro, 
                    catalogoid: _catalogoid, 
                    cedula: cartera.arrycedula,
                    nombres: cartera.arrynombres,
                    apellidos: cartera.arryapellidos, 
                    fechanaci: cartera.arryfechanac, 
                    provincia: cartera.arryprovincia, 
                    ciudad: cartera.arryciudad,
                    direcciondom: cartera.arrydirecdom,
                    referenciadom: cartera.arryrefedom,
                    direcciontra: cartera.arrydirectra,
                    referenciatra: cartera.arryreftrabajo,
                    email: cartera.arryemail,
                    operacion: cartera.arryoperacion,
                    totaldeuda: cartera.arrytotaldeuda,
                    diasmora: cartera.arrydiasmora,
                    capitalxvencer: cartera.arrycapitalxvencer,
                    capitalvencido: cartera.arrycapitalvencido,
                    capitalmora: cartera.arrycapitalmora,
                    valorexigible: cartera.arryvalorexigible,
                    fechaobligacion: cartera.arryfechaobligacion,
                    fechavencimiento: cartera.arryfechavencimiento,
                    fechaultpago: cartera.arryfechaultpago,
                    fonodeu1: cartera.arryfonodeu1,
                    fonodeu2: cartera.arryfonodeu2,
                    fonodeu3: cartera.arryfonodeu3,
                    fonodeu4: cartera.arryfonodeu4,
                    fonodeu5: cartera.arryfonodeu5,
                    fonodeu6: cartera.arryfonodeu6,
                    fonodeu7: cartera.arryfonodeu7,
                    fonodeu8: cartera.arryfonodeu8,
                    fonodeu9: cartera.arryfonodeu9,
                    fonodeu10: cartera.arryfonodeu10,
                    cedularef1: cartera.arryceduref1,
                    nombreref1: cartera.arrynomref1,
                    fono1ref1: cartera.arryfono1ref1,
                    fono2ref1: cartera.arryfono2ref1,
                    direcciondomref1: cartera.arrydireccdomref1,
                    referenciadomref1: cartera.arryrefedomref1,
                    emailref1: cartera.arryemailref1,
                    cedularef2: cartera.arryceduref2,
                    nombreref2: cartera.arrynomref2,
                    fono1ref2: cartera.arryfono1ref2,
                    fono2ref2: cartera.arryfono2ref2,
                    direcciondomref2: cartera.arrydireccdomref2,
                    referenciadomref2: cartera.arryrefedomref2,
                    emailref2: cartera.arryemailref2,
                    tipogarante1: cartera.arrytipogarante1,
                    cedulagarante1: cartera.arrycedulagarante1,
                    nombregarante1: cartera.arrynomgarante1,
                    direcciondomgara1: cartera.arrydirecdomgarante1,
                    referenciadomgara1: cartera.arryrefdomgarante1,
                    direcciontragara1: cartera.arrydirectragarante1,
                    referenciatragara1: cartera.arryreftragarante1,
                    emailpersonalgara1: cartera.arryemailpergarante1,
                    emailtrabajogara1: cartera.arryemailtragarante1,
                    fono1gara1: cartera.arryfono1garante1,
                    fono2gara1: cartera.arryfono2garante1,
                    fono3gara1: cartera.arryfono3garante1,
                    tipogarante2: cartera.arrytipogarante2,
                    cedulagarante2: cartera.arrycedulagarante2,
                    nombregarante2: cartera.arrynomgarante2,
                    direcciondomgara2: cartera.arrydirecdomgarante2,
                    referenciadomgara2: cartera.arryrefdomgarante2,
                    direcciontragara2: cartera.arrydirectragarante2,
                    referenciatragara2: cartera.arryreftragarante2,
                    emailpersonalgara2: cartera.arryemailpergarante2,
                    emailtrabajogara2: cartera.arryemailtragarante2,
                    fono1gara2: cartera.arryfono1garante2,
                    fono2gara2: cartera.arryfono2garante2,
                    fono3gara2: cartera.arryfono3garante2,
                    adicional1: cartera.arryadicional1,
                    adicional2: cartera.arryadicional2,
                    adicional3: cartera.arryadicional3,
                    adicional4: cartera.arryadicional4,
                    adicional5: cartera.arryadicional5,
                    adicional6: cartera.arryadicional6,
                    adicional7: cartera.arryadicional7,
                    adicional8: cartera.arryadicional8,
                    adicional9: cartera.arryadicional9,
                    adicional10: cartera.arryadicional10,
                    adicional11: cartera.arryadicional11,
                    adicional12: cartera.arryadicional12,
                    adicional13: cartera.arryadicional13,
                    adicional14: cartera.arryadicional14,
                    adicional15: cartera.arryadicional15,
                    adicional16: cartera.arryadicional16,
                    adicional17: cartera.arryadicional17,
                    adicional8: cartera.arryadicional18,
                    adicional19: cartera.arryadicional19,
                    adicional20: cartera.arryadicional20,
                    adicional21: cartera.arryadicional21,
                    adicional22: cartera.arryadicional22,
                    adicional23: cartera.arryadicional23,
                    adicional24: cartera.arryadicional24,
                    adicional25: cartera.arryadicional25,
                    adicional26: cartera.arryadicional26,
                    adicional27: cartera.arryadicional27,
                    adicional28: cartera.arryadicional28,
                    adicional29: cartera.arryadicional29,
                    adicional: cartera.arryadicional30,

                    opcion: 0},
                success: function(data){

                 
                
                },
                error: function (error) {
                    console.log(error);
                }                 
            }); 
            
          
        });
        
          
    });



  

});