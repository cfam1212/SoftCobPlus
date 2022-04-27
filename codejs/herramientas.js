$(document).ready(function(){

  var  _cbocedente, _cboid, _cboproducto, _cbocatalogo,_cbocedeid, _cbopro, _catalogoid, _result = [];

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

    $('#cboCatalogo').change(function(){

      _catalogoid = $(this).val();

    });    


    $("#btnProcesar").click(function(){

      /*let tbldatos = document.getElementById('tablecartera');
      rowCount = tbldatos.rows.length;*/

      alert(_catalogoid);
      
        $("#tablecartera tbody tr").each(function (items) 
        {
            let _orden, _detalle, _valorv, _valori, _estado, _idpade;
            
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
                        _valorv = $.trim($(this).text());
                        break;
                    case 4:
                        _valori = $.trim($(this).text());
                        break;
                    case 6:
                        _estado = $.trim($(this).text());
                        break;
                }
            }); 
            
            console.log(_idpade);
            console.log(_orden);

            _objeto = 
            {
                arrycedula : parseInt(_idpade),
                arryorden : parseInt(_orden),
                arrydetalle : _detalle,
                arryvalorv : _valorv,
                arryvalori : parseInt(_valori),
                arryestado : _estado,
                arrydisable : _deshabilitar        
            }
    
            _result.push(_objeto);            
          
        });
        
        $.ajax({
          url: "../herramientacrud.php",
          type: "POST",
          dataType: "json",
          data: {cedeid: _padeid, producid: _estadopade, catalogoid: _catalogoid, cartera: _result, opcion: 4},
          success: function(data){
             
          },
          error: function (error) {
              console.log(error);
          }                 
      });          
    });



  

});