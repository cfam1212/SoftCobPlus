$(document).ready(function(){

    var  _cbocedente, _cboid;


    $('#cboCiudad').select2();
    $('#cboCedente').select2();
    $('#cboProducto').select2();
    $('#cboCatalogo').select2();
    $('#cboGestor').select2();

  

    _opcaccion = $.trim($("#cboCiudad").val());
    _cbocedente = $('#cboCedente'); 

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





});