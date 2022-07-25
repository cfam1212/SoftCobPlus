$(document).ready(function(){

    var  _cbocedente, _cboid, _cboproducto, _cbocatalogo,_cbocedeid, _cbopro, _catalogoid, 
    _resultCartera = [], _exito = 1, _result ;

    $('#cboCiudad').select2();
    $('#cboCedente').select2();
    $('#cboProducto').select2();
    $('#cboCatalogo').select2();

    _cbocedente = $('#cboCedente');
    _cboproducto = $('#cboProducto'); 
    _cbocatalogo = $('#cboCatalogo');  

    _mensaje = $('input#subircartera').val();

    if(_mensaje == 'SI'){
        mensajesalertify("Subido con exito","S","top-center",5);	
    }    

    $('input#subircartera').val('');

  //INPUT FILE

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
    $("#cboCedente").append('<option value="">--Seleccione Cedente--</option>');

    $("#cboProducto").empty();
    $("#cboProducto").append('<option value="">--Seleccione Producto--</option>');

    $("#cboCatalogo").empty();
    $("#cboCatalogo").append('<option value="">--Seleccione Catalogo--</option>');

    $("#cboGestor").empty();
    $("#cboGestor").append('<option value="">--Seleccione Gestor--</option>');
   

    if(_cboid != ''){ 
        $("#Ciudad-error").html("");
        $("#Ciudad-error").hide();        
      $.ajax({
        dataType: 'html',
        type: 'POST',
        url: '../db/cargarcombos.php',
        data: {opcion:2, idciu:_cboid, tipocbo: 1},
      }).done(function(data){

        _cbocedente.html(data);
        _cbocedente.select2();
      });
    }else{
        //mensajesalertify("Seleccione Ciudad","W","top-center",5);
        $("#Ciudad-error").html("Este dato es necesario.");
        $("#Ciudad-error").show();        
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

    // function _(el){
    //     return document.getElementById(el);
    // }

    // function  uploadFile(){
    //     var file = _("file_input").files[0];
    //      alert(file.name +" | " + file.size +" | "+file.type);
    //     var formdata = new FormData();

    //     formdata.append("file_input",file);
    //     var ajax = new XMLHttpRequest();


    //     ajax.upload.addEventListener("progress",progressHandler,false);
    //     ajax.addEventListener("load", completeHandler,false);
    //     ajax.addEventListener("error", errorHandler,false);
    //     ajax.addEventListener("abort", abortHandler,false);

    //     ajax.open("POST","../db/file_upload_parser.php");
    //     ajax.send(formdata);
    // }

    // function progressHandler(event){
    //      $('#loades_n_total').innerHTML = "Uploaded" + event.loaded + " bytes of" +event.total;
    //      var porcent = (event.loaded / event.total) * 100;
    //      $('#progressBar').value =  Math.round(porcent);
    //      $('#status').innerHTML =  Math.round(porcent) + "% uploaded... please wait";

    // }

    // function completeHandler(event){
    //     $('#status').innerHTML =  event.target.responseText;
    //     $('#progressBar').value =  0;   
    // }
    
    // function errorHandler(event){
    //     _("status").innerHTML =  "Upload Failed";
    // }

    // function abortHandler(event){
    //     _("status").innerHTML =  "Upload Aborted";
    // }      


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
       
        if(document.querySelector('#file_input').files.length == 0){
    
            mensajesalertify("Seleccione un archivo","E","top-center",3);
            return;
    
            }

        $("#btnProcesar").prop("disabled", "disabled");
       
      
        /*$("#tablecartera tbody tr").each(function (items) 
        {
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
            
            if(_cedula != '')
                {

                    $.ajax({
                        url: "../db/herramientacrud.php",
                        type: "POST",
                        dataType: "json",
                        data: {
                            cedeid: _cbocedeid, 
                            producid: _cbopro, 
                            catalogoid: _catalogoid, 
                            cedula: _cedula,
                            nombres: _nombres,
                            apellidos: _apellidos, 
                            fechanaci: _fechanacimiento, 
                            provincia: _provincia, 
                            ciudad: _ciudad,
                            direcciondom: _direcciondom,
                            referenciadom: _referenciadom,
                            direcciontra: _direcciontrab,
                            referenciatra: _referenciatrab,
                            email: _email,
                            operacion: _operacion,
                            totaldeuda: _totaldeuda,
                            diasmora: _diasmora,
                            capitalxvencer: _capitalxvencer,
                            capitalvencido: _capitalvencido,
                            capitalmora: _capitalmora,
                            valorexigible: _valorexigible,
                            fechaobligacion: _fechaobligacion,
                            fechavencimiento: _fechavencimiento,
                            fechaultpago: _fechaultimopago,
                            fonodeu1: _fonodeudor1,
                            fonodeu2: _fonodeudor2,
                            fonodeu3: _fonodeudor3,
                            fonodeu4: _fonodeudor4,
                            fonodeu5: _fonodeudor5,
                            fonodeu6: _fonodeudor6,
                            fonodeu7: _fonodeudor7,
                            fonodeu8: _fonodeudor8,
                            fonodeu9: _fonodeudor9,
                            fonodeu10: _fonodeudor10,
                            cedularef1: _cedularef1,
                            nombreref1: _nomref1,
                            fono1ref1: _fono1ref1,
                            fono2ref1: _fono2ref1,
                            direcciondomref1: _direcdomref1,
                            referenciadomref1: _refdomref1,
                            emailref1: _emailref1,
                            cedularef2: _cedularef2,
                            nombreref2: _nomref2,
                            fono1ref2: _fono1ref2,
                            fono2ref2: _fono2ref2,
                            direcciondomref2: _direcdomref2,
                            referenciadomref2: _refdomref2,
                            emailref2: _emailref2,
                            tipogarante1: _tipogarante1,
                            cedulagarante1: _cedulagarante1,
                            nombregarante1: _nombregarante1,
                            direcciondomgara1: _direccdomgarante1,
                            referenciadomgara1: _referendomgarante1,
                            direcciontragara1: _direcctragarante1,
                            referenciatragara1: _referentragarante1,
                            emailpersonalgara1: _emailpergarante1,
                            emailtrabajogara1: _emailtragarante1,
                            fono1gara1: _fono1garante1,
                            fono2gara1: _fono2garante1,
                            fono3gara1: _fono3garante1,
                            tipogarante2: _tipogarante2,
                            cedulagarante2: _cedulagarante2,
                            nombregarante2: _nombregarante1,
                            direcciondomgara2: _direccdomgarante2,
                            referenciadomgara2: _referendomgarante2,
                            direcciontragara2: _direcctragarante2,
                            referenciatragara2: _referentragarante2,
                            emailpersonalgara2: _emailpergarante2,
                            emailtrabajogara2: _emailtragarante2,
                            fono1gara2: _fono1garante2,
                            fono2gara2: _fono2garante2,
                            fono3gara2: _fono3garante2,
                            adicional1: _adicional1,
                            adicional2: _adicional1,
                            adicional3: _adicional1,
                            adicional4: _adicional1,
                            adicional5: _adicional5,
                            adicional6: _adicional6,
                            adicional7: _adicional7,
                            adicional8: _adicional8,
                            adicional9: _adicional9,
                            adicional10: _adicional10,
                            adicional11: _adicional11,
                            adicional12: _adicional12,
                            adicional13: _adicional13,
                            adicional14: _adicional14,
                            adicional15: _adicional15,
                            adicional16: _adicional16,
                            adicional17: _adicional17,
                            adicionall8: _adicional18,
                            adicional19: _adicional19,
                            adicional20: _adicional20,
                            adicional21: _adicional21,
                            adicional22: _adicional22,
                            adicional23: _adicional23,
                            adicional24: _adicional24,
                            adicional25: _adicional25,
                            adicional26: _adicional26,
                            adicional27: _adicional27,
                            adicional28: _adicional28,
                            adicional29: _adicional29,
                            adicional30: _adicional30,
                            opcion: 0},
                        success: function(datos){
                            //console.log(datos);
                            _exito = 1;            
                        },
                        error: function (error) {
                            console.log(error);
                        }                 
                    });
            }            
        });*/       
         move();
    });

    _result = 0;

    var slider = document.getElementById("progressBar");
    var progress = document.getElementById("progressbar");

    var widthBar = parseInt(window.getComputedStyle(progress).width);
    var widthProgress = parseInt(window.getComputedStyle(slider).width);

    var _result = Math.round((widthBar/widthProgress)* 100);

    //var contar = 0;
    function move(){
        interval  = setInterval(addFrame, 100);
         function addFrame(){

            //contar++;
            if(_result == 100){
                clearInterval(interval);
                limpiar();
                return false;
            }

            if(_result < 100){
                _result = _result + 1;
                progress.style.width = _result + "%";
                progress.innerHTML = _result + "%";            
            }            
        }
    }
    
    function limpiar()
    {
        //window.location.href="./subircartera.php";
        $.redirect('subircartera.php', {'subiocartera': 'SI'});        
    }

});