$(document).ready(function(){
    
    var _provid, _ciudid, _nivelid,_idproduc, _resultcon = [], _resulcatalogo = [],_catalogold, _idcat;
   

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

        if(_contacto == '')
        {
            mensajesalertify("Ingrese Nombre del Contacto..!","W","top-right",3);
            return;
        }     
  
        if(_cargo == '0')
        {
            mensajesalertify("Seleccione Cargo..!","W","top-right",3);
            return;
        }	 
   
        
        if(_email1 != '')
        {
            var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
        
            if (regex.test($('#txtEmail1').val().trim())) {
            } else {
                mensajesalertify("Email 1 es invalido","E","top-right",3);
                _continuaconadd = false;   
                return;
            }        
        }

        if(_email2 != '')
        {
            var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
        
            if (regex.test($('#txtEmail2').val().trim())) {
            } else {
                mensajesalertify("Email 2 es invalido","E","top-right",3);
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
                    mensajesalertify("Celular ya Existe..!","W","top-right",3); 
                    _continuaconadd = false;
                    return false;
                }
            });
        }
            if(_ext != '')
            {
                valoredit = document.getElementById("txtExt").value;
                if( !(/^\d{9}$/.test(valoredit)) ) {
                    mensajesalertify("Telefono incorrecto..!","E","top-right",3); 
                    _continuaconadd = false;
                    return false;
                }
            }

            if(_celular != '')
            {
                valoredit = document.getElementById("txtCelular").value;
                if( !(/^\d{10}$/.test(valoredit)) ) {
                    mensajesalertify("Celular incorrecto..!","E","top-right",3); 
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
            mensajesalertify("Seleccione Cargo..!","W","top-right",3);
            return;
        }	 

        if(_contacto == '')
        {
            mensajesalertify("Ingrese Nombre del Contacto..!","W","top-right",3);
            return;
        }        
        
        if(_email1 != '')
        {
            var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
        
            if (regex.test($('#txtEmail1Mo').val().trim())) {
            } else {
                mensajesalertify("Email es invalido","E","top-right",3);
                _continuaconedit = false;   
                return;
            }        
        }

        if(_email2 != '')
        {
            var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
        
            if (regex.test($('#txtEmail2Mo').val().trim())) {
            } else {
                mensajesalertify("Email es invalido","E","top-right",3);
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
                        mensajesalertify("Celular ya Existe..!","W","top-right",3); 
                        _continuaconedit = false;
                        return false;
                    }
                });
            }

            valoredit = document.getElementById("txtCelularMo").value;
            if( !(/^\d{10}$/.test(valoredit)) ) {
                mensajesalertify("Celular incorrecto..!","E","top-right",3); 
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
     
    $(document).on("click",".btnEditPro",function(){
        
        let _row_id = $(this).attr("id");
        _row_id = _row_id.substring(10);
        _productoold = $('#txtProducto' + _row_id).val();
        _dscripcionold = $('#txtDescripcion' + _row_id).val();


        $('#txtProductoEdit').val(_productoold); 
        $('#txtDescripcionEdit').val(_dscripcionold);
  
        $('#hidden_row_id').val(_row_id);
        $("#headercon").css("background-color","#BCBABE");
        $("#headercon").css("color","black");
        $(".modal-title").text("Editar Producto");       
        //$("#btnAgregar").text("Modificar");
        $("#modalEDITPRODUCTO").modal("show");
  
    });


    //***EDITAR PRODUCTO-CEDENTE */
    $("#btnprodedit").click(function(e){
        e.preventDefault();
        _idcede = $.trim($("#cedeid").val()); 
        _idprod = $.trim($("#hidden_row_id").val());
        _producto = $.trim($("#txtProductoEdit").val());
        _descripcion = $.trim($("#txtDescripcionEdit").val());
        let _continuar = true;

        if(_producto == ''){
            mensajesalertify("Ingrese Producto!.","W","top-right",3); 
            return false;   
        }

        if(_productoold != _producto){
            $.post({
                url: "../db/cedentecrud.php",
                dataType: "json",
                data: {opcion:7, cedeid: _idcede, producto: _producto},            
                success: function(data){
                    if(data[0].Existe == 'Existe'){
                        mensajesalertify("Producto ya Existe!.","W","top-right",3);
                        _continuar = false; 
                        return false;
                    }
                },
                error: function (error) {
                    console.log(error);
                }                            
            }); 
        }

        if(_continuar){
            $.post({
                url: "../db/cedentecrud.php",
                dataType: "json",
                data: {opcion:8, idpro: _idprod, producto: _producto, descripcion: _descripcion},            
                success: function(data){
                    //debugger;
                    _idpro = data[0].Idpro;
                    _producto = data[0].Producto;
                    _descripcion = data[0].Descripcion;
                    _estado = data[0].Estado;          
                    
                    _checked = '';

                    if(_estado == 'A'){
                        _checked = 'checked';
                    }                      

                    //row_id = $('#hidden_row_id').val();
                    _output = '<td style="display: none;">' + _idpro + ' <input type="hidden" name="hidden_idpro[]" id="idpro' + _idpro + '" value="' + _idpro + '" /></td>';                
                    _output += '<td>' + _producto + ' <input type="hidden" name="hidden_producto[]" id="txtProducto' + _idpro + '" value="' + _producto + '" /></td>';
                    _output += '<td>' + _descripcion + ' <input type="hidden" name="hidden_descripcion[]" id="txtDescripcion' + _idpro + '" value="' + _descripcion + '" /></td>';
                    _output += '<td><div class="text-center"><div class="btn-group">'
                    _output += '<button type="button" name="btnProCat" class="btn btn-outline-primary btn-sm ml-2 btnProCat" data-toggle="tooltip" data-placement="top" title="catalogos" id="btnProCat' + _idpro + '"><i class="fa fa-upload"></i></button>';
                    _output += '<button type="button" name="btnEditPro" class="btn btn-outline-info btn-sm ml-2 btnEditPro" data-toggle="tooltip" data-placement="top" title="editar" id="btnEditPro' + _idpro + '"><i class="fa fa-pencil-square-o"></i></button></div></div></td>';
                    _output += '<td><div class="text-center"><input type="checkbox" class="form-check-input chkEstadoTa" id="chk' + _idpro +
                            '" ' + _checked + ' value=' + _idpro + '/></div></td>';


                  
                    $('#rowpro_' + _idpro + '').html(_output);  
                    
                    console.log(_output);
                    
                    $("#modalEDITPRODUCTO").modal("hide");

                    $("#tblcatalogo").empty();
                    _output = '<thead>';
                    _output += '<tr><th style="display: none;">Id</th>';
                    _output += '<th>Producto</th><th>Cod.Catalogo</th><th>Catalogo</th><th style="text-align: center;">Opciones</th><th style="width:10% ; text-align: center">Estado</th></tr></thead>'
                    $('#tblcatalogo').append(_output);
            
                    _output  = '<tbody></tbody>';
                    $('#tblcatalogo').append(_output);  

                },
                error: function (error) {
                    console.log(error);
                }                            
            }); 
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

    //AGREGAR PRODUCTO 
    $("#btnProducto").click(function(){
     let _idcede = $('#cedeid').val();
     let _producto = $('#txtProducto').val();
     let _descripcion = $('#txtDescripcion').val();
     let _estado = 'A';
     let _continuarproduc = true;


     if(_producto == '')
     {
         mensajesalertify("Ingrese Nombre del Producto..!","W","top-right",3);
         _continuarproduc = false;
         return false;
     }  
     
     if(_continuarproduc)
        {
            $.ajax({
                url: "../db/cedentecrud.php",
                type: "POST",
                dataType: "json",
                data: {opcion:6, cedeid: _idcede, producto: _producto, descripcion:_descripcion, estado:_estado},            
                success: function(data){
                    if(data[0].Existe == 'Existe'){
                        mensajesalertify("Producto ya Existe..!!","W","top-right",3); 
                    }else{
                        _idpro = data[0].Idpro;
                        _producto = data[0].Producto;
                        _descripcion = data[0].Descripcion;
                        _estado = data[0].Estado;

                        _checked = '';

                        if(_estado == 'A'){
                            _checked = 'checked';
                        }  

                        _output = '<tr id="rowpro_' + _idpro + '">';
                        _output += '<td style="display: none;">' + _idpro + ' <input type="hidden" name="hidden_idpro[]" id="idpro' + _idpro + '" value="' + _idpro + '" /></td>';                
                        _output += '<td>' + _producto + ' <input type="hidden" name="hidden_producto[]" id="txtProducto' + _idpro + '" value="' + _producto + '" /></td>';
                        _output += '<td>' + _descripcion + ' <input type="hidden" name="hidden_descripcion[]" id="txtDescripcion' + _idpro + '" value="' + _descripcion + '" /></td>';
                        _output += '<td><div class="text-center"><div class="btn-group">'
                        _output += '<button type="button" name="btnProCat" class="btn btn-outline-primary btn-sm ml-2 btnProCat" data-toggle="tooltip" data-placement="top" title="catalogos" id="btnProCat' + _idpro + '"><i class="fa fa-upload"></i></button>';
                        _output += '<button type="button" name="btnEditPro" class="btn btn-outline-info btn-sm ml-2 btnEditPro" data-toggle="tooltip" data-placement="top" title="editar" id="btnEditPro' + _idpro + '"><i class="fa fa-pencil-square-o"></i></button>';
                        _output +=  '<td><div class="text-center"><input type="checkbox" class="form-check-input chkEstadoTa" id="chk' + _idpro +
                                '" ' + _checked + ' value=' + _idpro + '/></div></td>';

                        $('#tblproducto').append(_output);
                    }
                    
                },
                error: function (error) {
                    console.log(error);
                }                            
            });             
        } 
    });

    //UPDATE ESTADO PRODUCTO BDD

    $(document).on("click",".chkEstadoPro",function(){ 
        let _rowid = $(this).attr("id");
        let _idproducto = _rowid.substring(3);
        let _check = $("#chk" + _idproducto).is(":checked");
       
           
        let _estadopro;
    
    
        if(_check){
            _estadopro = 'A';
            $("#btnEditPro" + _idproducto).prop("disabled", "");
            $("#btnProCat" + _idproducto).prop("disabled", "");
           
        }else 
        {
            _estadopro = 'I';
            $("#btnEditPro" + _idproducto).prop("disabled", "disabled");
            $("#btnProCat" + _idproducto).prop("disabled", "disabled");
        }
    
        $.ajax({
            url: "../db/cedentecrud.php",
            type: "POST",
            dataType: "json",
            data: {idpro: _idproducto, estado: _estadopro, opcion: 3},
            success: function(data){
               
            },
            error: function (error) {
                console.log(error);
            }                 
        });
    
    });


    //MODAL CATALOGO
    $(document).on("click",".btnProCat",function(){

        $("#formCatalogoEdit").trigger("reset"); 
        row_id = $(this).attr("id");
        _idproduc = row_id.substring(9);
       


        FunBuscarCatalogo(_idproduc);

        $('#hidden_row_id').val(_idproduc);
        $("#headercat").css("background-color","#BCBABE");
        $("#headercat").css("color","black");
        $(".modal-title").text("Agregar Catalogo");       
        $("#btnAgregar").text("Agregar");
        $("#modalCATALOGOEDIT").modal("show");

    });

    //FUNCION QUE LISTA CATALOGOS EN FUNCION DEL ID DEL PRODUCTO

    function FunBuscarCatalogo(idpro){

        $("#tblcatalogo").empty();
        _output = '<thead>';
        _output += '<tr><th style="display: none;">Id</th>';
        _output += '<th>Producto</th><th>Cod.Catalogo</th><th>Catalogo</th><th style="text-align: center;">Opciones</th><th style="width:10% ; text-align: center">Estado</th></tr></thead>'
        $('#tblcatalogo').append(_output);

        _output  = '<tbody>';
        $('#tblcatalogo').append(_output);  
        
        $.ajax({
            url: "../db/cedentecrud.php",
            type: "POST",
            dataType: "json",
            data: {opcion:9, idpro:idpro},            
            success: function(data){
                $.each(data,function(i,item){                    
                    _idcat = data[i].Id;
                    _producto = data[i].Producto;
                    _codigocat = data[i].Codigo;
                    _catalogo = data[i].Catalogo;
                    _estado = data[i].Estado;

                    _checked = '';
                    _deshabilitar = '';

                    if(_estado == 'A'){
                        _checked = 'checked';
                    } else _deshabilitar = 'disabled';    
                   
                    _output =  '<tr id="rowcat_' + _idcat + '">';
                    _output += '<td style="display: none;">' + _idcat + ' <input type="hidden" name="hidden_codigo[]" id="codigo' + _idcat + '" value="' + _idcat + '" /></td>';                
                    _output += '<td>' + _producto + ' <input type="hidden" name="hidden_producto[]" id="txtProducto' + _idcat + '" value="' + _producto + '" /></td>';
                    _output += '<td>' + _codigocat + ' <input type="hidden" name="hidden_codigocat[]" id="txtCodigoCat' + _idcat + '" value="' + _codigocat + '" /></td>';
                    _output += '<td>' + _catalogo + ' <input type="hidden" name="hidden_catalogo[]" id="txtCatalogo' + _idcat + '" value="' + _catalogo + '" /></td>';
                    _output += '<td><div class="text-center"><div class="btn-group">'
                    _output += '<button type="button" name="btnEditCat" class="btn btn-outline-info btn-sm ml-2 btnEditCat" id="edit' + _idcat + '" ' + _deshabilitar + ' data-toggle="tooltip" data-placement="top" title="editar"><i class="fa fa-pencil-square-o"></i></button></div></div></td>';
                    _output += '<td><div class="text-center"><input type="checkbox" class="form-check-input chkEstadoCa" id="chkcat' + _idcat +
                                '" ' + _checked + ' value=' + _idcat + '/></div></td>';
                    _output += '</tr>';

                    $('#tblcatalogo').append(_output); 
                    // console.log(_output); 

                    _objeto = {
                        arrycodigo : parseInt(_idcat),
                        arryproducto : _producto,
                        arrycodigocat : _codigocat,
                        arrycatalogo : _catalogo
                            }
                    
                    _resulcatalogo.push(_objeto);
                 
                    
                    
                });
            },
            error: function (error) {
                console.log(error);
            }                            
        }); 

        _output  = '</tbody>';
        $('#tblcatalogo').append(_output);   
    }

   //AGREGAR CATALOGO-PRODUCTO DIRECTO A LA BDD
   $(document).on("click","#btnAddCatalogo",function(){


     let _codigo = $('#txtCodigoMo').val();
     let _catalogo = $('#txtCatalogoMo').val();
     let _estado = 'A';
     let _continuacat = true;

     if(_codigo == '')
     {
         mensajesalertify("Ingrese Codigo..!","W","top-right",3);
         _continuacat = false;
         return false;
        
     }

     if(_catalogo == '')
     {
         mensajesalertify("Ingrese Nombre del Catalogo..!","W","top-right",3);
         _continuacat = false;
         return false;
     }

    if(_continuacat)
    {

        $.ajax({
            url: "../db/cedentecrud.php",
            type: "POST",
            dataType: "json",
            data: {opcion:10, idpro:_idproduc, codigo:_codigo, catalogo:_catalogo, estado:_estado},            
            success: function(data){
                if(data[0].Existe == 'Existe'){
                    mensajesalertify("Catalogo ya Existe..!!","W","top-right",3); 
                }else{
                    _idcatalogo = data[0].Id;
                    _producto = data[0].Producto;
                    _codigocat = data[0].Codigo;
                    _catalogo = data[0].Catalogo
                    _estado = data[0].Estado;

                    _checked = '';
                    _deshabilitar = '';

                    if(_estado == 'A'){
                        _checked = 'checked';
                    } else _deshabilitar = 'disabled';  

                    _output =  '<tr id="rowcat_' + _idcatalogo + '">';
                    _output += '<td style="display: none;">' + _idcatalogo + ' <input type="hidden" name="hidden_codigo[]" id="codigo' + _idcatalogo + '" value="' + _idcatalogo + '" /></td>';                
                    _output += '<td>' + _producto + ' <input type="hidden" name="hidden_producto[]" id="txtProducto' + _idcatalogo + '" value="' + _producto + '" /></td>';
                    _output += '<td>' + _codigocat + ' <input type="hidden" name="hidden_codigocat[]" id="txtCodigoCat' + _idcatalogo + '" value="' + _codigocat + '" /></td>';
                    _output += '<td>' + _catalogo + ' <input type="hidden" name="hidden_catalogo[]" id="txtCatalogo' + _idcatalogo + '" value="' + _catalogo + '" /></td>';
                    _output += '<td><div class="text-center"><div class="btn-group">'
                    _output += '<button type="button" name="btnEditCat" class="btn btn-outline-info btn-sm ml-2 btnEditCat" id="edit' + _idcatalogo + '"  ' + _deshabilitar + ' data-toggle="tooltip" data-placement="top" title="editar"><i class="fa fa-pencil-square-o"></i></button></div></div></td>';
                    _output += '<td><div class="text-center"><input type="checkbox" class="form-check-input chkEstadoCa" id="chkcat' + _idcatalogo +
                               '" ' + _checked + ' value=' + _idcatalogo + '/></div></td>';
                    _output += '</tr>';
                    
                    $('#tblcatalogo').append(_output);

            
                    $("#modalCATALOGOEDIT").modal("hide");
                }
            },
            error: function (error) {
                console.log(error);
            }                            
        }); 


    }

   });

   //MODAL EDITAR CATALOGO

   $(document).on("click",".btnEditCat",function(){

    $("#formEdit").trigger("reset"); 
    let row_id = $(this).attr("id");
    _idcat = row_id.substring(4);

    _codigo = $('#txtCodigoCat' + _idcat).val();
    _catalogold = $('#txtCatalogo' + _idcat).val();



    $('#txtCodigo').val(_codigo);
    $('#txtCatalogo').val(_catalogold);

    $('#hidden_row_id').val(_idcat);
    $("#headercat").css("background-color","#BCBABE");
    $("#headercat").css("color","black");
    $(".modal-title").text("Editar Catalogo");       
    $("#btnEditCatalogo").text("Modificar");
    $("#modalEDITCATALOGO").modal("show");

});

// EDITAR CATALOGO DIRECTO A LA BDD

$("#btnEditCatalogo").click(function(){

    let  _continuacat = true;

    _newcatalogo = $('#txtCatalogo').val();

   

    if(_newcatalogo == '')
    {
        mensajesalertify("Ingrese Nombre del Catalogo..!","W","top-right",3);
        _continuacat = false;
        return false;
    }  

    

    if(_continuacat){

        $.ajax({
            url: "../db/cedentecrud.php",
            type: "POST",
            dataType: "json",
            data: {idcat:_idcat, idpro:_idproduc, catalogo:_newcatalogo, opcion:11},            
            success: function(data){

            if(data[0].Existe == 'Existe'){
                mensajesalertify("Catalogo ya Existe..!!","W","top-right",3); 
            }else{   

                _idcatalogo = data[0].Id;
                _producto = data[0].Producto;
                _codigocat = data[0].Codigo;
                _catalogo = data[0].Catalogo;
                _estado = data[0].Estado;

                _checked = '';
                _deshabilitar = '';

                if(_estado == 'A'){
                    _checked = 'checked';
                } else _deshabilitar = 'disabled';    


                _output = '<td style="display: none;">' + _idcatalogo + ' <input type="hidden" name="hidden_codigo[]" id="codigo' + _idcatalogo + '" value="' + _idcatalogo + '" /></td>';                
                _output += '<td>' + _producto + ' <input type="hidden" name="hidden_producto[]" id="txtProducto' + _idcatalogo + '" value="' + _producto + '" /></td>';
                _output += '<td>' + _codigocat + ' <input type="hidden" name="hidden_codigocat[]" id="txtCodigoCat' + _idcatalogo + '" value="' + _codigocat + '" /></td>';
                _output += '<td>' + _catalogo + ' <input type="hidden" name="hidden_catalogo[]" id="txtCatalogo' + _idcatalogo + '" value="' + _catalogo + '" /></td>';
                _output += '<td><div class="text-center"><div class="btn-group">'
                _output += '<button type="button" name="btnEditCat" class="btn btn-outline-info btn-sm ml-2 btnEditCat" id="edit' + _idcatalogo + '"  ' + _deshabilitar + ' data-toggle="tooltip" data-placement="top" title="editar"><i class="fa fa-pencil-square-o"></i></button></div></div></td>';
                _output += '<td><div class="text-center"><input type="checkbox" class="form-check-input chkEstadoCa" id="chkcat' + _idcatalogo +
                            '" ' + _checked + ' value=' + _idcatalogo + '/></div></td>';


              
                $('#rowcat_' + _idcatalogo + '').html(_output); 
                
                
                $("#modalEDITCATALOGO").modal("hide");
            }
                // console.log(_output);
            
                
        },
            error: function (error) {
                console.log(error);
            }                          
        });


    }

});

//UPDATE ESTADO CATALOGO

$(document).on("click",".chkEstadoCa",function(){ 
    let _rowid = $(this).attr("id");
    let _idcat = _rowid.substring(6);
    let _check = $("#chkcat" + _idcat).is(":checked");
    let _estado;


    if(_check){
        _estado = 'A'
        $("#edit" + _idcat).prop("disabled", "");
    }else{
        _estado = 'I'
        $("#edit" + _idcat).prop("disabled", "disabled");
    }

    $.ajax({
        url: "../db/cedentecrud.php",
        type: "POST",
        dataType: "json",
        data: {idcat: _idcat, estado: _estado, opcion: 12},
        success: function(data){
           
        },
        error: function (error) {
            console.log(error);
        }                 
    });

});


});