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
        
        //$("#modalEDITCONTACTO").trigger("reset"); 
        //debugger;

        _fila = $(this).closest("tr");
        _data = $('#tblcontacto').dataTable().fnGetData(_fila);

        _id = _data[0];
        _contactoold = _data[1];
        _codcargoold = _data[3];
        _celularold = _data[4];
        _extold = _data[5];
        _email1old = _data[6];
        _email2old = _data[7]

        $('#txtContactoMo').val(_contactoold); 
        $('#cboCargoMo').val(_codcargoold).change();
        $('#txtCelularMo').val(_celularold);
        $('#txtExtMo').val(_extold);
        $('#txtEmail1Mo').val(_email1old);
        $('#txtEmail2Mo').val(_email2old);
  
        $('#id').val(_id);
        $("#headercon").css("background-color","#BCBABE");
        $("#headercon").css("color","black");
        $(".modal-title").text("Editar Contacto");       
        $("#btnAgregar").text("Modificar");
        $("#modalEDITCONTACTO").modal("show");
  
    });

    $("#btnContacto").click(function(){
        let _id = $('#cedeid').val();
        let _contacto = $('#txtContacto').val();
        let _cargo = $('#cboCargo').val();
        let _ext = $('#txtExt').val();
        let _celular = $('#txtCelular').val();
        let _email1 = $('#txtEmail1').val();
        let _email2 = $('#txtEmail2').val();
        _continuaconedit = true;
  
        if(_cargo == '0')
        {
            mensajesalertify("Seleccione Cargo..!","W","top-right",5);
            return;
        }	 

        if(_contacto == '')
        {
            mensajesalertify("Ingrese Nombre del Contacto..!","W","top-right",5);
            return;
        }        
        
        if(_email1 != '')
        {
            var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
        
            if (regex.test($('#txtEmail1Mo').val().trim())) {
            } else {
                mensajesalertify("Email es invalido","E","top-right",5);
                _continuaconedit = false;   
                return;
            }        
        }

        if(_email2 != '')
        {
            var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
        
            if (regex.test($('#txtEmail1Mo').val().trim())) {
            } else {
                mensajesalertify("Email es invalido","E","top-right",5);
                _continuaconedit = false;   
                return;
            }        
        }        

        if(_celular != '')
        {
            $.each(_resultcon,function(i,item)
            {
                if(item.arrycelular == _celular)
                {                        
                    mensajesalertify("Celular ya Existe..!","W","top-right",5); 
                    _continuaconedit = false;
                    return false;
                }
            });

            valoredit = document.getElementById("_celular").value;
            if( !(/^\d{10}$/.test(valoredit)) ) {
                mensajesalertify("Celular incorrecto..!","E","top-right",5); 
                _continuaconedit = false;
                return false;
            }
        }

        if(_continuaconedit)
        {
            $.post({
                url: "../db/contactocrud.php",
                dataType: "json",
                data: {opcion:0, id:_id, tarea:_tarea, ruta:_ruta, icono:_icono, estado:_estado},            
                success: function(data){
                    if(data == 'SI'){
                        mensajesalertify("Tarea ya Existe..!!","W","top-right",5);                   
                    }else{
                        _contactoid = data[0].Id;
                        _tarea = data[0].Tarea;
                        _ruta = data[0].Ruta;
                        _icono = data[0].Icono
                        _estado = data[0].Estado;
 
                        _boton = '<td><div class="text-center"><div class="btn-group"><button class="btn btn-outline-info btn-sm ml-3 btnEditar"' +
                                 ' id="btnEditar'+ _tareaid +'"><i class="fa fa-pencil-square-o"></i></button><button class="btn btn-outline-danger btn-sm ml-3"'+
                                _desactivar + 'id="btnEliminar"><i class="fa fa-trash-o"></i></button></div></div></td>'
                        
                        TableDataContacto.row.add([_tareaid, _tarea, _ruta, _icono,_boton, _newestado]).draw();

                        _objeto = {
                            arrycodigo : parseInt(_contactoid),
                            arrycontacto : _newcontacto,
                            arrycargo : _newcargo,
                            arrycbocargo : _newcbocargo,
                            arrycelular : _newcel,
                            arryext : _newext,
                            arryemail1 : _newemail1,
                            arryemail2 : _newemail2
                        }
                
                        _resultcon.push(_objeto);                          
                    }
                },
                error: function (error) {
                    console.log(error);
                }                            
            }); 
        } 
    });

    function FunRemoveContacto(arrycon, detacon)
    {
        $.each(arrycon,function(i,item){
            if(item.arrycelular == detacon)
            {
                arrycon.splice(i, 1);
                return false;
            }else{
                continuar = true;
            }
        });        
    };     

    $("#formEditContacto").submit(function(e){
        e.preventDefault();
        _tarea = $.trim($("#txtTarea").val());
        _ruta = $.trim($("#txtRuta").val());
        _icono = $.trim($("#txtIcono").val());

        if(_tarea == ''){
            mensajesalertify("Ingrese Tarea!!.","W","top-right",5); 
            return;   
        }
        if(_ruta == ''){
            mensajesalertify("Ingrese una Ruta!!.","W","top-right",5); 
            return;   
        }

        if(_opcion == 2){            
            if(_nameoldtarea != _tarea){
                $.ajax({
                    url: "../db/tareacrud.php",
                    type: "POST",
                    dataType: "json",
                    data: {opcion:2, id: _id, tarea: _tarea, ruta:_ruta, icono:_icono, estado:_estado},            
                    success: function(data){
                        if(data == '1'){
                            mensajesalertify("Tarea ya Existe..!!","W","top-right",5);                   
                        }else{
                            FunGrabar();
                        }
                    },
                    error: function (error) {
                        console.log(error);
                    }                            
                });                
            }else{
                FunGrabar();
            }
        }else{
            FunGrabar();
        }        
    });    

});