$(document).ready(function(){

  var  _cbocedente, _cboid, _cboproducto, _cbocatalogo,_cbocedeid, _cbopro;

  $('#cboCiudad').select2();
  $('#cboCedente').select2();
  $('#cboProducto').select2();
  $('#cboCatalogo').select2();

  _cbocedente = $('#cboCedente');
  _cboproducto = $('#cboProducto'); 
  _cbocatalogo = $('#cboCatalogo');  



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

  $("#btnProcesar").click(function(){

    alert('ola');
    document.getElementById('file-input')
    .addEventListener('change', leerArchivo, false);

  });


  

});