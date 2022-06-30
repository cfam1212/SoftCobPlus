$(document).ready(function(){

    var  _cbocedente, _cboid, _cboproducto, _cbocatalogo,_cbogestor,_cbocedeid, _cbopro, _gestores = [], _asignarRegistros,_count=0,newvalor;


    $('#cboCiudad').select2();
    $('#cboCedente').select2();
    $('#cboProducto').select2();
    $('#cboCatalogo').select2();
    $('#cboGestor').select2();

   
    _cbocedente = $('#cboCedente');
    _cboproducto = $('#cboProducto'); 
    _cbocatalogo = $('#cboCatalogo');  
    _cbogestor = $('#cboGestor'); 

    $('#chkTodosGest').prop('disabled',true);
    $('#chkPorGest').prop('disabled',true);

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
      
      $('#chkTodosGest').prop('disabled',false);
      $('#chkPorGest').prop('disabled',false);

      $.ajax({
        url: "../db/consultadatos.php",
        type: "POST",
        dataType: "json",
        data: {tipo:47, auxv1:"", auxv2:"", auxv3:"", auxv4:"", auxv5:"", auxv6:"", auxi1:_cbocedeid, auxi2:_cbopro, auxi3:_cbocata, auxi4:0, auxi5:0, 
        auxi6:0, opcion:0},
        success: function(data){
         
            
            $('#txttotalreg').val(data[0].Registros);
            $('#txtTemReg').val(data[0].Registros);

        },
        error: function (error){
            console.log(error);
        }
      });      

    });     
   
     //// EVENTO CHECKBOX POR GESTORES

      $("#chkPorGest").change(function() {
        _gestores = [];


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

        totalreg = $('#txtTemReg').val();
        $('#txttotalreg').val(totalreg);


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

 

  //BOTON AGREGAR POR GESTOR

  $('#btnPorGestor').click(function(){


    let _cbociudad = $('#cboCiudad').val();
    let _cbocedente = $('#cboCedente').val();
    let _cboproducto = $('#cboProducto').val();
    let _cbocatalogo = $('#cboCatalogo').val();
    _continuar = true;

    if(_cbociudad == '0')
    {
        mensajesalertify("Seleccione Ciudad..!","W","top-right",3);
        return false;;
    }

    if(_cbocedente == '0')
    {
        mensajesalertify("Seleccione Cedente..!","W","top-right",3);
        return false;;
    }

    if(_cboproducto == '0')
    {
        mensajesalertify("Seleccione Producto..!","W","top-right",3);
        return false;;
    }

    if(_cbocatalogo == '0')
    {
        mensajesalertify("Seleccione Catalogo..!","W","top-right",3);
        return false;;
    }

   
    let _cbogestor = $('#cboGestor').val();
    let _gestor = $.trim($("#cboGestor option:selected").text()); 
    
    let _numregistros = $('#txtNumReg').val();

    
    if(_cbogestor == '0')
    {
        mensajesalertify("Seleccione Gestor..!","W","top-right",3);
        return false;;
    }

    if(_numregistros == '')
    {
        mensajesalertify("Ingrese numero de Registros..!","W","top-right",3);
        return false;;
    }

    _totalReg = $('#txttotalreg').val();
    _numReg = $('#txtNumReg').val();

    _asignarRegistros = _totalReg - _numReg;


    if(_gestores.length > 0){
      $.each(_gestores,function(i,item){
        if(item.arryid == _cbogestor){
            mensajesalertify("Gestor ya está Asignado..!!","W","top-right",3);                    
            _continuar = false;
            return false;
        }else _continuar = true;
      });
      
    }
    
   console.log(_continuar);
    if(_continuar)
    {
      

      $('#cboGestor').val('0').change(); 

      _objeto = 
      {
          arryid : _cbogestor,
          arrygestor : _gestor,
          arryregistros : _numReg,
      }

      _gestores.push(_objeto); 
      console.log(_gestores);    
      

      $('#txttotalreg').val(_asignarRegistros);

      _output = '<tr id="rowges_' + _cbogestor + '">';
      _output += '<td style="display: none;">' + _cbogestor + ' <input type="hidden" name="hidden_id[]" id="txtId' + _cbogestor + '" value="' + _cbogestor + '" /></td>';
      _output += '<td>' + _gestor + ' <input type="hidden" name="hidden_gestor[]" id="txtGestor' + _cbogestor + '" value="' + _gestor + '" /></td>';
      _output += '<td>' + _numReg + ' <input type="hidden" name="hidden_registros[]" id="txtRegistro' + _cbogestor + '" value="' + _numReg + '" /></td>';
      _output += '<td><div class="text-center"><div class="btn-group"><button type="button" class="btn btn-outline-danger btn-sm ml-3 btnDeletetg" id="' + _cbogestor + '"><i class="fa fa-trash-o"></i></button></div></div></td>';
      $('#tblagestor').append(_output);      

  
    }
    _numReg = $('#txtNumReg').val('');
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
          _totalgestores = data.length;
          _numregistros = $('#txtTemReg').val();
          _sobrante = 0;

          _registros = $('#txtTemReg').val()/_totalgestores; 
          _residuo = _numregistros % _totalgestores; //OBTENER EL RESIDUO (EL MOD)

          if(_residuo > 0)
          {
            _registrosrd = Math.floor(_registros); //OBTENER VALOR ENTERO DE DIVISION
            _totalregistro = _registrosrd * _totalgestores;
            _sobrante = _numregistros - _totalregistro;
            _registros = _registrosrd;

          }

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

              if(_sobrante > 0){
                if(i ==  (_totalgestores - 1)){
                  _registros = _registrosrd + _sobrante;
                }
              }

              _objeto = 
              {
                  arryid : _id,
                  arrygestor : _gestor,
                  arryregistros : _registros,
              }
        
              _gestores.push(_objeto);                   
              
              _output = '<tr id="rowges_' + _id + '">';
              _output += '<td style="display: none;">' + _id + ' <input type="hidden" name="hidden_id[]" id="txtId' + _id + '" value="' + _id + '" /></td>';
              _output += '<td>' + _gestor + ' <input type="hidden" name="hidden_gestor[]" id="txtGestor' + _id + '" value="' + _gestor + '" /></td>';
              _output += '<td>' + _registros + ' <input type="hidden" name="hidden_registros[]" id="txtRegistro' + _id + '" value="' + _registros + '" /></td>';
              _output += '<td><div class="text-center"><div class="btn-group"><button type="button" class="btn btn-outline-danger btn-sm ml-3 btnDeletetg" id="' + _id + '"><i class="fa fa-trash-o"></i></button></div></div></td></tr>';

              $('#tblagestor').append(_output); 
          });
          
          _output  = '</tbody>';
          $('#tblagestor').append(_output);   
        }, 
        error: function (error) {
          console.log(error);
        }          

    });    

     $('#txttotalreg').val('0');
   


  });

    //ELIMAR ARREGLOS GESTORES

    $(document).on("click",".btnDeletetg",function(){
      row_id = $(this).attr("id");
  
      _gestor = $('#txtGestor' + row_id + '').val();
      console.log(_gestor);
      _id = $('#txtId' + row_id + '').val();
      console.log(_id);
      _numreg = $('#txtRegistro' + row_id + '').val();
      console.log(_numreg);
      
      alertify.confirm('El Gestor sera eliminado..!!', 'Estas seguro de eliminar'+ ' ' + _gestor +'..?', function(){ 
                 FunRemoveItemFromArr(_gestores, _id,_numreg);
                  $('#rowges_' + row_id + '').remove();
                  _count--;
                
       }
              , function(){ });
  });

  console.log(_gestores);
  
  function FunRemoveItemFromArr(arr, deta, numreg)
  {
      $.each(arr,function(i,item){
          if(item.arryid == deta)
          {
             regis = item.arryregistros;
             temreg = $('#txtTemReg').val();
             totalreg = $('#txttotalreg').val();
             numero = regis.toString();
             if(totalreg == 0){
              $('#txttotalreg').val(numero);
            }else{
              newvalor = parseInt(numero) + parseInt(totalreg);
              $('#txttotalreg').val(newvalor);
            }
            
             console.log(newvalor);
           
              arr.splice(i, 1);
              return false;
              
          }else{
              continuar = true;
          }
      });        
  };

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

  

    if(_gestores.length == 0)
    {
      mensajesalertify("Seleccione Gestor..!","W","top-right",3);
      return false;

    }

    $.each(_gestores,function(i,item){        
        $.ajax({
          url: "../db/consultadatos.php",
          type: "POST",
          dataType: "json",
          data: {tipo:49, auxv1:"", auxv2:"", auxv3:"", auxv4:"", auxv5:"", auxv6:"", auxi1:_cbocedeid, auxi2:_cbopro, auxi3:_cbocatalogo, 
                auxi4:item.arryid, auxi5:item.arryregistros,  auxi6:0},
          success: function(data){
              console.log(data);
          },
          error: function (error) {
              console.log(error);
          }
        });      

    });

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
      
      $.redirect('asignarcartera.php', {'subiocartera': 'SI'});
      
  }



});