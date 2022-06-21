$(document).ready(function(){

    var  _cbocedente, _cboid, _cboproducto, _cbocatalogo,_cbogestor,_cbocedeid, _cbopro, _gestores = [];


    $('#cboCiudad').select2();
    $('#cboCedente').select2();
    $('#cboProducto').select2();
    $('#cboCatalogo').select2();
    $('#cboGestor').select2();

  

   
    _cbocedente = $('#cboCedente');
    _cboproducto = $('#cboProducto'); 
    _cbocatalogo = $('#cboCatalogo');  
    _cbogestor = $('#cboGestor'); 

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

    //COMOBO PARA LLENAR GESTOR CON ID CEDENTE

    $('#cboCedente').change(function(){

      _cbocedeid = $(this).val();


      $.ajax({
        dataType: 'html',
        type: 'POST',
        url: '../db/cargarcombos.php',
        data: {opcion:3, cedeid:_cbocedeid},
      }).done(function(data){

        _cbogestor.html(data);
        _cbogestor.select2();
      });

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

    
    //COMOBO PARA LLENAR CATALOGO CON ID PRODUCTO

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

      _cbocata = $(this).val();

      $.ajax({
        url: "../db/consultadatos.php",
        type: "POST",
        dataType: "json",
        data: {tipo:47, auxv1:"", auxv2:"", auxv3:"", auxv4:"", auxv5:"", auxv6:"", auxi1:_cbocedeid, auxi2:_cbopro, auxi3:_cbocata, auxi4:0, auxi5:0, 
        auxi6:0, opcion:0},
        success: function(data){
            
            $('#txttotalreg').val(data[0].Registros);

        },
        error: function (error){
            console.log(error);
        }
      });      

    });     
   
     //// EVENTO POR GESTORES

      $("#chkPorGest").change(function() {

        $("#chkTodosGest").prop("checked", false);
        $("#tblagestor").empty();
        _output = '<thead>';
        _output += '<tr><th style="display: none;">Id</th>';
        _output += '<th>Gestor</th><th>Registro</th><th style="width:12% ; text-align: center">Opciones</th></tr></thead>'
        $('#tblagestor').append(_output); 

        _output  = '<tbody>';
        $('#tblagestor').append(_output);  
       
        $("#divGestor").show();
        $("#divRegistro").show();


        $.ajax({
          url: "../db/carteracrud.php",
          type: "POST",
          dataType: "json",
          data: {opcion:0},
          success: function(data){
              
            },
            error: function (error) {
                console.log(error);
            }                  
        });
        
      });

 

  //FUNCION AGREGAR POR GESTOR

  $('#btnPorGestor').click(function(){

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

   
    let _cbogestor = $('#cboGestor').val();
    let _gestor = $.trim($("#cboGestor option:selected").text()); 
    
    let _numregistros = $('#txtNumReg').val();

    
    
    if(_cbogestor == '0')
    {
        mensajesalertify("Seleccione Gestor..!","W","top-right",3);
        return;
    }

    if(_numregistros == '')
    {
        mensajesalertify("Ingrese numero de Registros..!","W","top-right",3);
        return;
    }

    $.ajax({
      url: "../db/registrocrudsp.php",
      type: "POST",
      dataType: "json",
      data: {idgestor:_cbogestor,numregistros:_numregistros, opcion: 1},
      success: function(data){
          if(data[0].Existe == 'Existe'){
              mensajesalertify("Gestor ya esta Agregado..!","W","top-right",3);  
          }
          else{
              $("#tblagestor").empty();

              _output = '<thead>';
              _output += '<tr><th style="display: none;">Id</th>';
              _output += '<th>Gestor</th><th>Registro</th><th style="width:12% ; text-align: center">Opciones</th></tr></thead>'
              $('#tblagestor').append(_output); 
      
              _output  = '<tbody>';
              $('#tblagestor').append(_output);  

              $.each(data,function(i,item){      
                  _id = data[i].Id;
                  _gestor = data[i].Gestor
                  _numregistro = data[i].Registro
                  
                  _output = '<tr id="rowges_' + _id + '">';
                  _output += '<td style="display: none;">' + _id + ' <input type="hidden" name="hidden_id[]" id="txtId' + _id + '" value="' + _id + '" /></td>';
                  _output += '<td>' + _gestor + ' <input type="hidden" name="hidden_gestor[]" id="txtGestor' + _id + '" value="' + _gestor + '" /></td>';
                  _output += '<td>' + _numregistro + ' <input type="hidden" name="hidden_gestor[]" id="txtGestor' + _id + '" value="' + _numregistro + '" /></td>';
                  _output += '<td><div class="text-center"><div class="btn-group"><button type="button" class="btn btn-outline-danger btn-sm ml-3 btnDel" id="btnEli' + _id + '"><i class="fa fa-trash-o"></i></button></div></div></td>';
          
                  $('#tblagestor').append(_output); 
              });
              
              _output  = '</tbody>';
              $('#tblagestor').append(_output);                     
          }
      },
      error: function (error) {
          console.log(error);
      }
    }); 
     
      $('#cboGestor').val('0').change();                  
    
  });

  ////FUNCION CHECKBOX TODOS LOS GESTORES

  $('#chkTodosGest').change(function(){

    $("#chkPorGest").prop("checked", false);
    $("#tblagestor").empty();

    $("#divGestor").hide();
    $("#divRegistro").hide();

    $.ajax({
      dataType: 'json',
      type: 'POST',
      url: '../db/consultadatos.php',
      data: {tipo:48, auxv1:"", auxv2:"", auxv3:"", auxv4:"", auxv5:"", auxv6:"", auxi1:_cbocedeid, auxi2:_cbopro, auxi3:_cbocata, auxi4:0, auxi5:0, 
      auxi6:0, opcion:0},
      success: function(data){
          _total = data.length;

          _registros = $('#txttotalreg').val()/_total;

          $("#tblagestor").empty();

          _output = '<thead>';
          _output += '<tr><th style="display: none;">Id</th>';
          _output += '<th>Gestor</th><th>Registro</th><th style="width:12% ; text-align: center">Opciones</th></tr></thead>'
          $('#tblagestor').append(_output); 

          _output  = '<tbody>';
          $('#tblagestor').append(_output);  

          $.each(data,function(i,item){      
              _id = data[i].Codigo;
              _gestor = data[i].Descripcion;
              _numregistro = _registros;
              
              _output = '<tr id="rowges_' + _id + '">';
              _output += '<td style="display: none;">' + _id + ' <input type="hidden" name="hidden_id[]" id="txtId' + _id + '" value="' + _id + '" /></td>';
              _output += '<td>' + _gestor + ' <input type="hidden" name="hidden_gestor[]" id="txtGestor' + _id + '" value="' + _gestor + '" /></td>';
              _output += '<td>' + _numregistro + ' <input type="hidden" name="hidden_gestor[]" id="txtGestor' + _id + '" value="' + _numregistro + '" /></td>';
              _output += '<td><div class="text-center"><div class="btn-group"><button type="button" class="btn btn-outline-danger btn-sm ml-3 btnDel" id="btnEli' + _id + '"><i class="fa fa-trash-o"></i></button></div></div></td></tr>';
      
              console.log(_output);

              $('#tblagestor').append(_output); 
          });
          
          _output  = '</tbody>';
          $('#tblagestor').append(_output);   
        }, 
        error: function (error) {
          console.log(error);
        }          

    });    


  });

  //BOTON PROCESAR

  $('#btnProcesar').click(function(){

    let _cbociudad = $('#cboCiudad').val();
    let _cbocedente = $('#cboCedente').val();
    let _cboproducto = $('#cboProducto').val();
    let _cbocatalogo = $('#cboCatalogo').val();
    let _cbogestor = $('#cboGestor').val();


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

    let porgestor = $('#chkPorGest').is(":checked");
    if(!porgestor){
        mensajesalertify("Seleccione una opcion para agregar gestores..!","W","top-right",3);
        return;
    }

    if(_cbogestor == '0')
    {
        mensajesalertify("Seleccione Gestor..!","W","top-right",3);
        return;
    }

    

       move();
  });


  var slider = document.getElementById("progressBar");
  var progress = document.getElementById("progressbar");

  var widthBar = parseInt(window.getComputedStyle(progress).width);
  var widthProgress = parseInt(window.getComputedStyle(slider).width);

  var _result = Math.round((widthBar/widthProgress)* 100);

  
  function move(){
      interval  = setInterval(addFrame, 100);
       function addFrame(){

          //contar++;
          if(_result == 100){
              clearInterval(interval);
              // limpiar();
              return false;
          }

          if(_result < 100){
              _result = _result + 1;
              progress.style.width = _result + "%";
              progress.innerHTML = _result + "%";            
          }
          
      }

  }



});