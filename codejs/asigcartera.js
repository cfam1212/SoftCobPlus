$(document).ready(function(){

    var  _cbocedente, _cboid;


    $('#cboCiudad').select2();
    $('#cboCedente').select2();
    $('#cboProducto').select2();
    $('#cboCatalogo').select2();
    $('#cboGestor').select2();

  

    _opcaccion = $.trim($("#cboCiudad").val());
    _cbocedente = $('#cboCedente'); 
    _cbogestor = $('#cboGestor'); 

    $('#cboCiudad').change(function(){
        _cboid = $(this).val(); //obtener el id seleccionado

        
        $("#cboCedente").empty();
        $("#cboCedente").append('<option value=0>--Seleccione Cedente--</option>');
       

        if(_cboid !== '0'){ 
          $.ajax({
            data: {opcion:2, idciu:_cboid},
            dataType: 'html',
            type: 'POST',
            url: '../db/cargarcombos.php'
          }).done(function(data){

            _cbocedente.html(data);
            _cbocedente.select2();
          });
        }else{
            _cbocedente.val('');
            _cbocedente.empty();
            _cbocedente.append('<option value=0>--Seleccione Cedente--</option>');            
        }    
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
        if(this.checked) {

          $("#cboGestor").empty();
          $("#cboGestor").append('<option value=0>--Seleccione Gestor--</option>');
            
          $.ajax({
            data: {opcion:3},
            dataType: 'html',
            type: 'POST',
            url: '../db/cargarcombos.php'
          }).done(function(data){

            _cbogestor.html(data);
            _cbogestor.select2();
          });
        }else{
            _cbogestor.val('');
            _cbogestor.empty();
            _cbogestor.append('<option value=0>--Seleccione Gestor--</option>');            
        }  

        
      });



  //FUNCION AGREGAR POR GESTOR

  $('#btnPorGestor').click(function(){


     alert('listo');

  });

});