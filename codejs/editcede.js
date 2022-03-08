$(document).ready(function(){
    
    var _provid, _ciudid, _nivelid, _resultcon = [];

    $('#btnRegresar').click(function(){        
        $.redirect("admincede.php");
    });  

    $("#modalEDITCONTACTO").draggable({
        handle: ".modal-header"
    }); 

    _provid = $.trim($("#provid").val());
    _ciudid = $.trim($("#ciudid").val());
    _nivelid = $.trim($("#nivelid").val());

    $('#cboProvincia').select2();
    $('#cboCiudad').select2();
    $('#cboArbol').select2();
    $('#cboSucursal').select2();
    $('#cboZona').select2();
    $('#cboCargo').select2();
    $('#cboCargoMo').select2();
    $('#cboSucursalMo').select2();
    $('#cboZonaMo').select2();

    $('#cboProvincia').val(_provid).change();
    $('#cboCiudad').val(_ciudid).change();
    $('#cboArbol').val(_nivelid).change();


    _opcaccion = $.trim($("#cboProvincia").val());
    _cbociudad = $('#cboCiudad');     

    $('#cboProvincia').change(function(){
        _cboid = $(this).val(); //obtener el id seleccionado
        
        $("#cboCiudad").empty();
        $("#cboCiudad").append('<option value=0>--Seleccione Ciudad--</option>');

        if(_cboid !== '0'){ 
          $.ajax({
            data: {opcion:0, id:_cboid},
            dataType: 'html',
            type: 'POST',
            url: '../db/cargarcombos.php'
          }).done(function(data){
            _cbociudad.html(data);
            _cbociudad.select2();
          });
        }else{
            _cbociudad.val('');
            _cbociudad.empty();
            _cbociudad.append('<option value=0>--Seleccione Ciudad--</option>');            
        }    
    });    

    $("#tblcontacto tbody tr").each(function (items) 
    {
        let _codigo, _contacto, _cargo, _cbocargo, _celular, _ext, _email1, _email2;
        
        $(this).children("td").each(function (index) 
        {
            switch(index){
                case 0:
                    _codigo = $.trim($(this).text());
                    break;
                case 1:
                    _contacto = $.trim($(this).text());
                    break;
                case 2:
                    _cargo = $.trim($(this).text());
                    break;
                case 3:
                    _cbocargo = $.trim($(this).text());
                    break;
                case 4:
                    _celular = $.trim($(this).text());
                    break;
                case 5:
                    _ext = $.trim($(this).text());
                    break;
                case 6:
                    _email1 = $.trim($(this).text());
                    break;
                case 7:
                    _email2 = $.trim($(this).text());
                    break;                    
            }
        });        
        
        _objeto = {
            arrycodigo : parseInt(_codigo),
            arrycontacto : _contacto,
            arrycargo : _cargo,
            arrycbocargo : _cbocargo,
            arrycelular : _celular,
            arryext : _ext,
            arryemail1 : _email1,
            arryemail2 : _email2
        }

        _resultcon.push(_objeto);

        console.log(_resultcon);




    });   
    
    //EDITAR CONTACTO VENTANA MODAL
    $(document).on("click",".btnEditConMo",function(){
        $("#formEditContacto").trigger("reset"); 
        debugger;
         _idcontacto = $(this).attr("id");
         alert(_idcontacto);
         _contactoold = $('#txtContactoMo' + _idcontacto + '').val();
         _codcargoold = $('#codCargo' + _idcontacto + '').val();
         _celularold = $('#txtCelularMo' + _idcontacto + '').val();
         _extold = $('#txtExtMo' + _idcontacto + '').val();
         _email1old = $('#txtEmail1Mo' + _idcontacto + '').val();   
         _tipoSave = 'edit';
  
        $('#txtContactoMo').val(_contactoold);
        $('#cboCargoMo').val(_codcargoold).change();
        $('#txtCelularMo').val(_celularold);
        $('#txtExtMo').val(_extold);
        $('#txtEmail1Mo').val(_email1old);
  
        $('#hidden_row_id').val(_idcontacto);
        $("#headercon").css("background-color","#BCBABE");
        $("#headercon").css("color","black");
        $(".modal-title").text("Editar Contacto");       
        $("#btnAgregar").text("Modificar");
        $("#modalEDITCONTACTO").modal("show");
  
    });

});