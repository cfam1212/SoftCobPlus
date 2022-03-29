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
    _cedeid = $.trim($("#cedeid").val());

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

    //alert(_cedeid);

    $.ajax({
        url: "../db/contactocrud.php",
        type: "POST",
        dataType: "json",
        data: {opcion:2, cedeid: _cedeid},            
        success: function(data){
            $.each(data,function(i,item){

                _contactoid = data[i].Id;
                _contacto = data[i].Contacto;
                _cargo = data[i].Cargo;
                _codcargo = data[i].CodCargo;
                _celular = data[i].Celular;
                _extension = data[i].Extension;
                _email1 = data[i].Email1;
                _email2 = data[i].Email2;

                _objeto = {
                    arrycodigo : parseInt(_contactoid),
                    arrycontacto : _contacto,
                    arrycargo : _cargo,
                    arrycbocargo : _codcargo,
                    arrycelular : _celular,
                    arryext : _extension,
                    arryemail1 : _email1,
                    arryemail2 : _email2
                }
        
                _resultcon.push(_objeto);                          
            });
        },
        error: function (error) {
            console.log(error);
        }                            
    });    

    //console.log(_resultcon);

    /*$("#tblcontacto tbody tr").each(function (items) 
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


    });   */
   
    // GRABAR EDITAR CEDENTE DIRECTO BDD

    $("#btnSave").click(function(){

        let _cedente = $('#txtCedente').val();
        let _ruc = $('#txtRuc').val();
        let _direccion = $('#txtDireccion').val();
        let _fono1 = $('#txtTel1').val();
        let _fono2 = $('#txtTel2').val();
        let _fax = $('#txtFax').val();
        let _url = $('#txtUrl').val();
  
        
        let _cboprovincia = $('#cboProvincia').val();
        let _cbocuidad = $('#cboCiudad').val();
        let _cboarbol = $('#cboArbol').val();


        if(_cboprovincia == '0')
        {
            mensajesalertify("Seleccione Provincia..!","W","top-right",3);
            return;
        }
        
        if(_cbocuidad == '0')
        {
            mensajesalertify("Seleccione Cuidad..!","W","top-right",3);
            return;
        }	 
  
  
        if(_cedente == '')
        {
            mensajesalertify("Ingrese Cendente..!","W","top-right",3);
            return;
        }
        
        if(_cboarbol == '0')
        {
          mensajesalertify("Ingrese Nivel del Árbol..!","W","top-right",3);
          return;
        }

        if(_fono1 != '')
        {

            valor = document.getElementById("txtTel1").value;
            if( !(/^\d{9}$/.test(valor)) ) {
                mensajesalertify("Telefono 1 incorrecto..!","E","top-right",3); 
                _continuarcon = false;
                return;
            }
        }

        if(_fono2 != '')
        {

            valor = document.getElementById("txtTel2").value;
            if( !(/^\d{9}$/.test(valor)) ) {
                mensajesalertify("Telefono 2 incorrecto..!","E","top-right",3); 
                _continuarcon = false;
                return;
            }
        }

        
      if(_ruc != '')
      {

          valor = document.getElementById("txtTel2").value;
          if( !(/^\d{13}$/.test(valor)) ) {
              mensajesalertify("Telefono 2 incorrecto..!","E","top-right",3); 
              _continuarcon = false;
              return;
          }
      }

        $.ajax({
            url: "../db/cedentecrud.php",
            type: "POST",
            dataType: "json",
            data: {cedeid: _cedeid, provid: _cboprovincia, ciudid: _cbocuidad, cedente: _cedente, ruc: _ruc, direccion: _direccion, 
                   telefono1: _fono1, telefono2: _fono2, fax: _fax, url: _url, nivel: _cboarbol, opcion: 5},            
            success: function(data){    
                //$.redirect("admincede.php");                
                mensajesalertify("Actualizado con Exito.!","E","top-right",3); 
                
            },
            error: function (error) {
                console.log(error);
              }                            
            });    


    });


    
    //EDITAR CONTACTO VENTANA MODAL
    $(document).on("click",".btnEditConMo",function(){
        

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
  
        $('#conid').val(_id);
        $("#headercon").css("background-color","#BCBABE");
        $("#headercon").css("color","black");
        $(".modal-title").text("Editar Contacto");       
        $("#btnAgregar").text("Modificar");
        $("#modalEDITCONTACTO").modal("show");
  
    });

    //AGREGAR NUEVO CONTACTO EN EDITAR DIRECTO A LA BASE DE DATOS

    $("#btnContacto").click(function(){
        let _id = $('#cedeid').val();
        let _contacto = $('#txtContacto').val();
        let _cargo = $('#cboCargo').val();
        let _ext = $('#txtExt').val();
        let _celular = $('#txtCelular').val();
        let _email1 = $('#txtEmail1').val();
        let _email2 = $('#txtEmail2').val();
        _continuaconadd = true;
  
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
        
            if (regex.test($('#txtEmail1').val().trim())) {
            } else {
                mensajesalertify("Email es invalido","E","top-right",5);
                _continuaconadd = false;   
                return;
            }        
        }

        if(_email2 != '')
        {
            var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
        
            if (regex.test($('#txtEmail2').val().trim())) {
            } else {
                mensajesalertify("Email es invalido","E","top-right",5);
                _continuaconadd = false;   
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
                    _continuaconadd = false;
                    return false;
                }
            });

            valoredit = document.getElementById("txtCelular").value;
            if( !(/^\d{10}$/.test(valoredit)) ) {
                mensajesalertify("Celular incorrecto..!","E","top-right",5); 
                _continuaconadd = false;
                return false;
            }
        }

        if(_continuaconadd)
        {
            $.ajax({
                url: "../db/contactocrud.php",
                type: "POST",
                dataType: "json",
                data: {opcion:0, cedeid:_id, contacto:_contacto, cargo:_cargo, ext:_ext, celular:_celular, email1: _email1, email2:_email2},            
                success: function(data){
                    _contactoid = data[0].Id;
                    _contacto = data[0].Contacto;
                    _cargo = data[0].Cargo;
                    _codcargo = data[0].CodCargo;
                    _celular = data[0].Celular;
                    _extension = data[0].Extension;
                    _email1 = data[0].Email1;
                    _email2 = data[0].Email2;

                    _boton = '<td><div class="text-center"><div class="btn-group"><button type="button" class="btn btn-outline-info btn-sm ml-2 btnEditConMo"  data-toggle="tooltip" data-placement="top" title="editar"' +
                                ' id="btnEdit"><i class="fa fa-pencil-square-o"></i></button><button type="button" class="btn btn-outline-danger btn-sm ml-2"' +
                                'id="btnDelete"><i class="fa fa-trash-o"></i></button></div></div></td>'
                    
                    //console.log(_boton);

                    TableDataContacto.row.add([_contactoid, _contacto, _cargo, _codcargo, _celular, _extension, _email1, _email2, _boton]).draw();

                    _objeto = {
                        arrycodigo : parseInt(_contactoid),
                        arrycontacto : _contacto,
                        arrycargo : _cargo,
                        arrycbocargo : _codcargo,
                        arrycelular : _celular,
                        arryext : _extension,
                        arryemail1 : _email1,
                        arryemail2 : _email2
                    }
            
                    _resultcon.push(_objeto);                          
                    
                },
                error: function (error) {
                    console.log(error);
                }                            
            }); 
        } 
    });

    //EDITAR CONTANTO-CEDENTE DEL MODAL DIRECTO A LA BASE DE DATOS

    $("#btnEditarCon").click(function(){
        let _conid = $('#conid').val();
        let _contacto = $('#txtContactoMo').val();
        let _cargo = $('#cboCargoMo').val();
        let _ext = $('#txtExtMo').val();
        let _celular = $('#txtCelularMo').val();
        let _email1 = $('#txtEmail1Mo').val();
        let _email2 = $('#txtEmail2Mo').val();
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
        
            if (regex.test($('#txtEmail2Mo').val().trim())) {
            } else {
                mensajesalertify("Email es invalido","E","top-right",5);
                _continuaconedit = false;   
                return;
            }        
        }        

        if(_celular != '' )
        {
            if(_celularold != _celular)
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
            }

            valoredit = document.getElementById("txtCelularMo").value;
            if( !(/^\d{10}$/.test(valoredit)) ) {
                mensajesalertify("Celular incorrecto..!","E","top-right",5); 
                _continuaconedit = false;
                return false;
            }
        }

        if(_continuaconedit)
        {
            $.ajax({
                url: "../db/contactocrud.php",
                type: "POST",
                dataType: "json",
                data: {opcion:3, conid: _conid, contacto: _contacto, cargo:_cargo, ext:_ext, celular: _celular, email1: _email1, email2:_email2},            
                success: function(data){
                    _contactoid = data[0].Id;
                    _contacto = data[0].Contacto;
                    _cargo = data[0].Cargo;
                    _codcargo = data[0].CodCargo;
                    _celular = data[0].Celular;
                    _extension = data[0].Extension;
                    _email1 = data[0].Email1;
                    _email2 = data[0].Email2;

                    _boton = '<td><div class="text-center"><div class="btn-group"><button type="button" class="btn btn-outline-info btn-sm ml-2 btnEditConMo" data-toggle="tooltip" data-placement="top" title="editar"' +
                                ' id="btnEdit"><i class="fa fa-pencil-square-o"></i></button><button type="button" class="btn btn-outline-danger btn-sm ml-2"' +
                                'id="btnDelete"><i class="fa fa-trash-o"></i></button></div></div></td>'
                    
                    TableDataContacto.row(_fila).data([_contactoid, _contacto, _cargo, _codcargo, _celular, _extension, _email1, _email2, _boton]).draw();

                    $.each(_resultcon,function(i,item){
                        if(item.arrycodigo == _contactoid)
                        {
                            _resultcon.splice(i, 1);
                            return false;
                        }
                    });        

                    _objeto = {
                        arrycodigo : parseInt(_contactoid),
                        arrycontacto : _contacto,
                        arrycargo : _cargo,
                        arrycbocargo : _codcargo,
                        arrycelular : _celular,
                        arryext : _extension,
                        arryemail1 : _email1,
                        arryemail2 : _email2
                    }
                    
                    $("#modalEDITCONTACTO").modal("hide");
            
                    _resultcon.push(_objeto);
                    // console.log(_resultcon);
                    
                },
                error: function (error) {
                    console.log(error);
                }                            
            });             
        } 
    });    

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
    
    //ELIMINAR CONTACTO 
    $(document).on("click","#btnDelete",function(e){   
        _fila = $(this);  
        _row = $(this).closest('tr');     
        _data = $('#tblcontacto').dataTable().fnGetData(_row);
        _idcon = _data[0];
        _contacto = _data[1];
        
        alertify.confirm('El Contacto será eliminado..!!', 'Esta seguro de eliminar' + ' ' + _contacto + '..?', function(){  
    
            $.ajax({
                url: "../db/contactocrud.php",
                type: "POST",
                dataType: "json",
                data: {opcion:1, conid: _idcon},
                success: function(data){
                    Swal.close();
                    TableDataContacto.row(_fila.parents('tr')).remove().draw();
                    mensajesalertify("Contacto Eliminado","E","top-center",3);		
                },
                error: function (error) {
                    console.log(error);
                }                  
            });	
    
       }
           , function(){ });
    });

});