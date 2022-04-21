$(document).ready(function(){

    var  _cbocedente, _cboid;


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

    $('#cboCedente').change(function(){

      _cbocedeid = $(this).val();

      alert(_cbocedeid);

      $("#cboGestor").empty();
      $("#cboGestor").append('<option value=0>--Seleccione Gestor--</option>');

      $.ajax({
        dataType: 'html',
        type: 'POST',
        url: '../db/cargarcombos.php',
        data: {opcion:3},
      }).done(function(data){

        _cbogestor.html(data);
        _cbogestor.select2();
      });
       

    });

    //// EVENTO CHECK TODOS LOS GESTORES

      $("#chkTodosGest").change(function() {
        if(this.checked) {

            
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

        }
      });

      // EVENTO CHECK POR GESTOR

      $("#chkPorGest").change(function() {
       

        $("#divGestor").show();
        
      });

 

  //FUNCION AGREGAR POR GESTOR

  $('#btnPorGestor').click(function(){


     alert('listo');

  });



});