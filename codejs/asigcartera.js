$(document).ready(function(){

    var  _cbocedente, _cboid, _cboproducto, _cbocatalogo,_cbogestor,_cbocedeid, _cbopro ;


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
       

    });

      //COMOBO PARA LLENAR PRODUCTO CON ID CEDENTE
      
    $('#cboCedente').change(function(){

    

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

   



     //// EVENTO POR GESTORES

      $("#chkPorGest").change(function() {
       
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
     

  });



});