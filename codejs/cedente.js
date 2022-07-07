$(document).ready(function(){

    var _count = 0,_objeto, _cbociudad, _cboid, _resultcon = [],_codcargoold,_idproduc,_countcatalogo = 0, 
    _resultpro = [], _resultcat = [], _resultage = [], _agencia,_cbosucursal,_sucursal,_zona, _estado, _producto,
    _codigocat, _catalogo, _estadocat, _produc, _countagen = 0, _codigoagen,_countproduc = 0, _estadopro,_idcontacto, 
    _contactoold, _codcargoold, _celularold, _email1old, _estadoagen, _estadocat, _countcontacto = 0, _contactoold, _telefono,
    _descripant, _fila;

    $("#modalCONTACTO").draggable({
        handle: ".modal-header"
    }); 
    
    $("#modalCATALOGO").draggable({
        handle: ".modal-header"
    });  

    $("#modalAGENCIA").draggable({
        handle: ".modal-header"
    }); 

    $("#modalPRODUCTO").draggable({
        handle: ".modal-header"
    }); 

    $("#modalEDITCATALOGO").draggable({
        handle: ".modal-header"
    }); 

    $("#modalNewCedente").draggable({
        handle: ".modal-header"
    }); 
    
    //SELECT 2 MODAL CEDENTE
    $("#cboProvincia").select2({
        dropdownParent: $("#modalNewCedente")
    });     

    $("#cboCiudad").select2({
        dropdownParent: $("#modalNewCedente")
    }); 
    
    $("#cboArbol").select2({
        dropdownParent: $("#modalNewCedente")
    }); 

    
    $("#cboCargo").select2({
        dropdownParent: $("#modalNewCedente")
    });  
    
    $("#cboCargoMo").select2({
        dropdownParent: $("#modalCONTACTO")
    });     

   

 // MODAL PARA NUEVO CEDENTE

    $("#btnNuevo").click(function(){
        $("#modalNewCedente").trigger("reset");
        
        _resultpro = [];
        $('#txtCedente').val('');
        $('#txtRuc').val('');
        $("#cboProvincia").val('0').change();


        let tblrow = 1;
        let tblproducto = document.getElementById('tblproducto');
        let rowCount = tblproducto.rows.length;

        for (var i = tblrow; i < rowCount; i++) {
            tblproducto.deleteRow(tblrow);
        }

        tblrow = 1;
        let tblcontacto = document.getElementById('tblcontactonew');
        rowCount = tblcontacto.rows.length;

        for (var i = tblrow; i < rowCount; i++) {
            tblcontacto.deleteRow(tblrow);
        }        

        tblrow = 1;
        let tblcatalogo = document.getElementById('tblcatalogo');
        rowCount = tblcatalogo.rows.length;

        for (var i = tblrow; i < rowCount; i++) {
            tblcatalogo.deleteRow(tblrow);
        }          

        $("#headerce").css("background-color","#BCBABE");
        $("#headerce").css("color","black");
        $(".modal-titlece").text("Nuevo Cedente");  
        $("#modalNewCedente").modal("show");
    
    });


    //EDITAR CEDENTE
    $(document).on("click",".btnEditar",function(){        
        _fila = $(this).closest("tr");
        _data = $('#tabledata').dataTable().fnGetData(_fila);
        _id = _data[0];
       
        $.redirect('editcede.php', {'id': _id}); //POR METODO POST

    });  


    
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

     //AGREGAR NUEVO CONTACTO 
    $('#btnContacto').click(function(){

        let _contacto = $('#txtContacto').val();
        let _cbocargo = $('#cboCargo').val();
        let _cargo =$("#cboCargo option:selected").text();      
        let _telefono = $('#txtExt').val();
        let _celular = $('#txtCelular').val();
        let _email1 = $.trim($('#txtEmail1').val());
        let _email2 = $.trim($('#txtEmail2').val());
        let _continuarcon = true;

                if(_contacto == '')
                {
                    mensajesalertify("Ingrese Contacto..!","W","top-right",3);
                    return;
                }  

                if(_cbocargo == '0')
                {
                    mensajesalertify("Seleccione Cargo..!","W","top-right",3);
                    return;
                }
                
                $.each(_resultcon,function(i,item)
                {
                    if(item.arrycontacto.toUpperCase() == _contacto.toUpperCase())
                    {                        
                        mensajesalertify("Contacto ya Existe..!","W","top-right",3); 
                        _continuarcon = false;
                        return;
                    }
                });

                if(_telefono != '')
                {

                    valor = document.getElementById("txtExt").value;
                    if( !(/^\d{9}$/.test(valor)) ) {
                        mensajesalertify("Telefono incorrecto..!","E","top-right",3); 
                        //_continuarcon = false;
                        return false;
                    }
                }

                if(_celular != '')
                {
                    $.each(_resultcon,function(i,item)
                    {
                        if(item.arrycelular == _celular)
                        {                        
                            mensajesalertify("Celular ya Existe..!","W","top-right",3); 
                            _continuarcon = false;
                            return;
                        }
                    });

                        valor = document.getElementById("txtCelular").value;
                        if( !(/^\d{10}$/.test(valor)) ) {
                            mensajesalertify("Celular incorrecto..!","E","top-right",3); 
                            _continuarcon = false;
                            return;
                        }

                }


                if(_email1 != '')
                {
                    var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
                
                    if (regex.test($('#txtEmail1').val().trim())) {
                        console.log('correcto');                            
                    } else {
                        mensajesalertify("Email 1 es invalido","E","top-right",3);
                        _continuarcon = false;   
                        return;
                    }        
                }

                if(_email2 != '')
                {
                    var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
                
                    if (regex.test($('#txtEmail2').val().trim())) {
                        console.log('correcto');                            
                    } else {
                        mensajesalertify("Email 2 es invalido","E","top-right",3);
                        _continuarcon = false;   
                        return;
                    }        
                }
      

      if(_continuarcon)
      {
        _countcontacto++;
        _output = '<tr id="rowcon_' + _countcontacto + '">';
        _output += '<td style="display: none;">' + _countcontacto + '</td>';
        _output += '<td>' + _contacto + ' <input type="hidden" name="hidden_contacto[]" id="txtContacto' + _countcontacto + '" value="' + _contacto + '" /></td>';
        _output += '<td>' + _cargo + '</td>';
        _output += '<td style="display: none;" class="text-center">' + _cbocargo + '</td>';
        _output += '<td class="text-center">' + _telefono + '</td>';
        _output += '<td class="text-center">' + _celular + '</td>';
        _output += '<td class="text-center">' + _email1 + '</td>';
        _output += '<td style="display: none;">' + _email2 + '</td>';
        _output += '<td><div class="text-center"><div class="btn-group">'
        _output += '<button type="button" name="btnDeleteCon" class="btn btn-outline-danger btnDeleteCon btn-sm ml-2" data-toggle="tooltip" data-placement="top" title="eliminar" id="' + _countcontacto + '"><i class="fa fa-trash-o"></i></button></div></div></td>';
        _output += '</tr>';

        $('#tblcontactonew').append(_output);

          _objeto = {
              arrycodigo : parseInt(_countcontacto),
              arrycontacto : _contacto,
              arrycargo : _cargo,
              arrycbocargo : _cbocargo,
              arrycelular : _celular,
              arryext : _telefono,
              arryemail1 : _email1,
              arryemail2 : _email2
          }

          _resultcon.push(_objeto);
          
          $('#txtContacto').val('');
          $('#cboCargo').val('0').change();
          $('#txtExt').val('');
          $('#txtCelular').val('');
          $('#txtEmail1').val('');
          $('#txtEmail2').val('');      
      }       
    });

  

    //delete-contacto

    $(document).on("click",".btnDeleteCon",function(){
        _idcontacto = $(this).attr("id");
        _contactodelete = $('#txtContacto' + _idcontacto + '').val();

        alertify.confirm('El Contacto sera eliminado..!!', 'Esta seguro de eliminar' +' '+ _contactodelete +'..?' , function(){ 

            FunRemoveContacto(_resultcon, _contactodelete);
            $('#rowcon_' + _idcontacto + '').remove();
            _countcontacto--;
            mensajesalertify("Contacto Eliminado","E","top-center",2);
        }
        , function(){ });
    });

    //Remove contacto

    function FunRemoveContacto(arrycon, detacon)
    {
        $.each(arrycon,function(i,item){
            if(item.arrycontacto == detacon)
            {
                arrycon.splice(i, 1);
                return false;
            }else{
                continuar = true;
            }
        });        
    };  

    //Producto

    $('#btnProducto').click(function(){

        let _producto = $('#txtProducto').val();
        let _descripcion = $('#txtDescripcion').val();
        let _estado = 'Activo';
        let _continuarproduc = true;
        //let _tipoSave = 'add';
        

        let tableHeaderRowCount = 1;
        let table = document.getElementById('tblcatalogo');
        let rowCount = table.rows.length;

        for (var i = tableHeaderRowCount; i < rowCount; i++) {
            table.deleteRow(tableHeaderRowCount);
        }  
        

        if(_producto == '')
        {
            mensajesalertify("Ingrese Producto..!","W","top-right",3);
            return;
        } 
        
        $.each(_resultpro,function(i,item)
        {
            if(item.arryproducto.toUpperCase() == _producto.toUpperCase())
            {                        
                mensajesalertify("Producto ya Existe..!","W","top-right",3); 
                _continuarproduc = false;
                return false;
            }else{
                _continuarproduc = true;
            }
        });

        if(_continuarproduc)
        {
            _countproduc++;
            _output = '<tr id="rowpro_' + _countproduc + '">';
            _output += '<td style="display: none;">' + _countproduc + ' <input type="hidden" name="hidden_codigo[]" id="codigo' + _countproduc + '" value="' + _countproduc + '" /></td>';                
            _output += '<td>' + _producto + ' <input type="hidden" name="hidden_producto[]" id="txtProducto' + _countproduc + '" value="' + _producto + '" /></td>';
            _output += '<td>' + _descripcion + ' <input type="hidden" name="hidden_descripcion[]" id="txtDescripcion' + _countproduc + '" value="' + _descripcion + '" /></td>';
            _output += '<td><div class="text-center"><div class="btn-group">'
            _output += '<button type="button" name="btnCatPro" class="btn btn-outline-primary btn-sm ml-2 btnCatPro" data-toggle="tooltip" data-placement="top" title="agregar catalogo" id="' + _countproduc + '"><i class="fa fa-upload"></i></button>';
            // _output += '<button type="button" name="btnEditCon" class="btn btn-outline-info btn-sm ml-3 btnEditPro" data-toggle="tooltip" data-placement="top" title="editar" id="' + _countproduc + '"><i class="fa fa-pencil-square-o"></i></button>';
            _output += '<button type="button" name="btnDeleteCon" class="btn btn-outline-danger btn-sm ml-2 btnDeletePro" data-toggle="tooltip" data-placement="top" title="eliminar" id="' + _countproduc + '"><i class="fa fa-trash-o"></i></button></div></div></td>';
            _output += '</tr>';
            
            $('#tblproducto').append(_output);

            _objeto = {
                arrycodigo : parseInt(_countproduc),
                arryproducto : _producto,
                arrydescrip : _descripcion,
                arryestado : _estado,
            }

            _resultpro.push(_objeto);   
            $('#txtProducto').val('');
            $('#txtDescripcion').val('');                  
            
        }   
    });

 

    //Remove Producto
    function FunRemoveProduc(arrypro, detapro)
    {
        $.each(arrypro,function(i,item){
            if(item.arryproducto == detapro)
            {
                arrypro.splice(i, 1);
                return false;
            }
        });        
    };  

    //delete producto

    $(document).on("click",".btnDeletePro",function(){
        _idproduc = $(this).attr("id");
        _productodelete = $('#txtProducto' + _idproduc + '').val();
        let _contdelcat = true;

        $.each(_resultcat,function(i,item){
            if(item.arryproductocat == _productodelete)
            {
                mensajesalertify("Existen Catalagos Asociados al Producto..!","W","top-right",3); 
                _contdelcat = false;
                return false;
            }
        });          

        if(_contdelcat)
        {
            alertify.confirm('El Producto sera eliminado..!', 'Esta seguro de eliminar' +' '+ _productodelete +'..?' , function(){ 

                FunRemoveProduc(_resultpro, _productodelete);
                $('#rowpro_' + _idproduc + '').remove();
                _countproduc--;
                mensajesalertify("Producto Eliminado","E","top-center",2);
            }
            , function(){ });
        }
    });

    //Catalogo-Producto-Modal

    $(document).on("click",".btnCatPro",function(){

        $("#formCatalogo").trigger("reset"); 
        row_id = $(this).attr("id");
        _produc = $('#txtProducto' + row_id + '').val();
        _tipoSave = 'save';

        FunBuscarDatos(_produc);

        $('#hidden_row_id').val(row_id);
        $("#headercat").css("background-color","#BCBABE");
        $("#headercat").css("color","black");
        $(".modal-title").text("Agregar Catalogo");       
        $("#btnAgregar").text("Agregar");
        $("#modalCATALOGO").modal("show");

    });

        function FunBuscarDatos(codproduc){
        $("#tblcatalogo").empty();
     
        _output = '<thead>';
        _output += '<tr><th style="display: none;">Id</th>';
        _output += '<th>Producto</th><th>Cod.Catalogo</th><th>Catalogo</th><th style="text-align: center;">Opciones</th></tr></thead>'
        $('#tblcatalogo').append(_output);
        
        _output  = '<tbody>';
        $('#tblcatalogo').append(_output);   
               
       if(_resultcat.length > 0)
       {
        $.each(_resultcat, function(i,item){
            
            if(item.arryproductocat == codproduc)
            {
                _output = '<tr id="rowcat_' + item.arrycodigo + '">';
                _output += '<td style="display: none;">' + item.arrycodigo + ' <input type="hidden" name="hidden_codigo[]" id="codigo' + item.arrycodigo + '" value="' + item.arrycodigo + '" /></td>';                
                _output += '<td>' + item.arryproductocat + ' <input type="hidden" name="hidden_producto[]" id="txtProducto' + item.arrycodigo + '" value="' + item.arryproductocat + '" /></td>';
                _output += '<td>' + item.arrycodigocat + ' <input type="hidden" name="hidden_codigocat[]" id="txtCodigoCat' + item.arrycodigo + '" value="' + item.arrycodigocat + '" /></td>';
                _output += '<td>' + item.arrycatalogo + ' <input type="hidden" name="hidden_catalogo[]" id="txtCatalogo' + item.arrycodigo + '" value="' + item.arrycatalogo + '" /></td>';
                _output += '<td><div class="text-center"><div class="btn-group">'
                _output += '<button type="button" name="btnDeleteCat" class="btn btn-outline-danger btn-sm ml-2 btnDeleteCat" data-toggle="tooltip" data-placement="top" title="eliminar" id="' + item.arrycodigo + '"><i class="fa fa-trash-o"></i></button></div></div></td>';
                _output += '</tr>';
                
                $('#tblcatalogo').append(_output);
            }

        });

        _output  = '</tbody>';
        $('#tblcatalogo').append(_output);                  
       }
    }


    //botton-agregar -catalogo-modal
    $('#btnAddCatalogo').click(function(){


    _codigocat = $('#txtCodigoMo').val();
    _catalogo = $('#txtCatalogoMo').val();
    _estadocat = 'Activo';
    _continuarcat = true;    

    if(_codigocat == '')
        {
            mensajesalertify("Ingrese Codigo..!","W","top-right",3);
            return;
        } 

        if(_catalogo == '')
        {
            mensajesalertify("Ingrese Catalogo..!","W","top-right",3);
            return;
        } 
        
        $.each(_resultcat,function(i,item)
        {
            if(item.arryproductocat.toUpperCase() == _produc.toUpperCase() && item.arrycodigocat.toUpperCase() == _codigocat.toUpperCase()
               || (item.arryproductocat.toUpperCase() == _produc.toUpperCase() && item.arrycatalogo.toUpperCase() == _catalogo.toUpperCase())) 
            {                        
                mensajesalertify("Catalogo ya Existe..!","W","top-right",3); 
                _continuarcat = false;
                return;
            }
        });

        if(_continuarcat)
        {
            _countcatalogo++;
            _output = '<tr id="rowcat_' + _countcatalogo + '">';
            _output += '<td style="display: none;">' + _countcatalogo + ' <input type="hidden" name="hidden_codigo[]" id="codigo' + _countcatalogo + '" value="' + _countcatalogo + '" /></td>';                
            _output += '<td>' + _produc + ' <input type="hidden" name="hidden_producto[]" id="txtProducto' + _countcatalogo + '" value="' + _produc + '" /></td>';
            _output += '<td>' + _codigocat + ' <input type="hidden" name="hidden_codigocat[]" id="txtCodigoCat' + _countcatalogo + '" value="' + _codigocat + '" /></td>';
            _output += '<td>' + _catalogo + ' <input type="hidden" name="hidden_catalogo[]" id="txtCatalogo' + _countcatalogo + '" value="' + _catalogo + '" /></td>';
            _output += '<td><div class="text-center"><div class="btn-group">'
            _output += '<button type="button" name="btnDeleteCat" class="btn btn-outline-danger btn-sm ml-2 btnDeleteCat" data-toggle="tooltip" data-placement="top" title="eliminar" id="' + _countcatalogo + '"><i class="fa fa-trash-o"></i></button></div></div></td>';
            // _output += '<td><div class="text-center"><input type="checkbox" class="form-check-input chkEstadoCa" id="chk" "value"=' + _countcatalogo + '/></div></td>';
            _output += '</tr>';
            
            $('#tblcatalogo').append(_output);

            _objeto = {
                arrycodigo : parseInt(_countcatalogo),
                arryproductocat : _produc,
                arrycodigocat : _codigocat,
                arrycatalogo : _catalogo,
                arryestado : _estadocat,
            }

            _resultcat.push(_objeto);
            $("#modalCATALOGO").modal("hide");                                     
        }   
    });



    //delete catalogo

    $(document).on("click",".btnDeleteCat",function(){
        row_id = $(this).attr("id");
        _catalogodelete = $('#txtCatalogo' + row_id + '').val();

        alertify.confirm('El Catalogo sera eliminado..!!', 'Esta seguro de eliminar' +' '+ _catalogodelete +'..?' , function(){ 

            FunRemoveItemCatalogo(_resultcat, _catalogodelete);
            $('#rowcat_' + row_id + '').remove();
            _countcatalogo--;
            mensajesalertify("Catalogo Eliminado","E","top-center",2);
        }
        , function(){ });
    });

    function FunRemoveItemCatalogo(arrycat, detacat)
    {
        $.each(arrycat,function(i,item){
            if(item.arrycatalogo == detacat)
            {
                arrycat.splice(i, 1);
                return false;
            }else{
                continuar = true;
            }
        });        
    };   

  




    //UPDATE ESTADO CEDENTE BDD

    $(document).on("click",".chkEstado",function(){ 
        let _rowid = $(this).attr("id");
        let _idcedente = _rowid.substring(3);
        let _check = $("#chk" + _idcedente).is(":checked");
        let _estadocede;

        if(_check){
            _estadocede = 'Activo'
            $("#btnEditar" + _idcedente).prop("disabled", "");
        }else{
            _estadocede = 'Inactivo'
            $("#btnEditar" + _idcedente).prop("disabled", "disabled");
        }

        $.ajax({
            url: "../db/cedentecrud.php",
            type: "POST",
            dataType: "json",
            data: {cedeid: _idcedente, estado: _estadocede, opcion: 2},
            success: function(data){
               
            },
            error: function (error) {
                console.log(error);
            }                 
        });

    });

   

    //GRABAR CEDENTE

    $('#btnSave').click(function(){

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

      if(_ruc != '')
      {

          valor = document.getElementById("txtRuc").value;
          if( !(/^\d{13}$/.test(valor)) ) {
              mensajesalertify("Ruc incorrecto..!","E","top-right",3); 
              //_continuarcon = false;
              return false;
          }
      }
      
  
      if(_fono1 != '')
      {

          valor = document.getElementById("txtTel1").value;
          if( !(/^\d{9}$/.test(valor)) ) {
              mensajesalertify("Telefono 1 incorrecto..!","E","top-right",3); 
              //_continuarcon = false;
              return false;
          }
      }

      if(_fono2 != '')
      {

          valor = document.getElementById("txtTel2").value;
          if( !(/^\d{9}$/.test(valor)) ) {
              mensajesalertify("Telefono 2 incorrecto..!","E","top-right",3); 
              //_continuarcon = false;
              return false;
          }
      }

      if(_cboarbol == '0')
      {
        mensajesalertify("Ingrese Nivel del Árbol..!","W","top-right",3);
        return;
      }

   

      if(_resultpro.length == 0 ){
        mensajesalertify("Ingrese al menos un producto","E","top-right",3); 
        return false;
      }

      if(_resultcat.length == 0 ){
        mensajesalertify("Ingrese al menos un catalogo","E","top-right",3); 
        return false;
      }

        $.ajax({
            url: "../db/cedentecrud.php",
            type: "POST",
            dataType: "json",
            data: {cedeid: 0, provid: _cboprovincia, ciudid: _cbocuidad, cedente: _cedente, ruc: _ruc, direccion: _direccion, 
                telefono1: _fono1, telefono2: _fono2, fax: _fax, url: _url, estado: 'A', nivel: _cboarbol,
                resultcontacto: _resultcon, resultproducto: _resultpro, resultcatalogo: _resultcat, resultagencia: _resultage, opcion: 0},            
            success: function(data){   
                if(data == 'Existe'){     
                    mensajesalertify("Nombre del Cedente ya existe..!","W","top-right",3);  
                }else{
                    _idcedente = data[0].CedeId;
                    _cedente = data[0].Cedente;
                    _provincia = data[0].Provincia;
                    _cuidad = data[0].Ciudad;
                    _telefono = data[0].Telefono;
                    _estado  = data[0].Estado;

                    _checked = '';

                    if(_estado == 'Activo'){
                        _checked = 'checked';
                    }    

                    _btnestado = '<td><div class="text-center"><input type="checkbox" class="form-check-input chkEstadoTa" id="chk' + _idcedente +
                                    '" ' + _checked + ' value=' + _idcedente + '/></div></td>';

                    _boton = '<td><div class="text-center"><div class="btn-group"><button type="button" class="btn btn-outline-info btn-sm ml-2 btnEditar" data-toggle="tooltip" data-placement="top" title="editar"' +
                                ' id="btnEdit"><i class="fa fa-pencil-square-o"></i></button></div></div></td>'
                    
                    TableData.row.add([_idcedente, _cedente, _provincia, _cuidad, _telefono, _boton, _btnestado]).draw();              
                                
                }
                $("#modalNewCedente").modal("hide");
            },
            error: function (error) {
                console.log(error);
            }                            
        });             

    });

   //ELIMINAR CEDENTE 
    $(document).on("click","#btnEliminar",function(e){   
        _fila = $(this);  
        _row = $(this).closest('tr');     
        _data = $('#tabledata').dataTable().fnGetData(_row);
        _id = _data[0];
        _cedentename = _row.find('td:eq(0)').text();
        
        alertify.confirm('El Cedente será eliminado..!!', 'Esta seguro de eliminar' + ' ' + _cedentename + '..?', function(){  
    
            $.ajax({
                url: "../db/cedentecrud.php",
                type: "POST",
                dataType: "json",
                data: {opcion:4, cedeid:_id},
                success: function(data){
                    Swal.close();
                    TableData.row(_fila.parents('tr')).remove().draw();
                    mensajesalertify("Cedente Eliminado","E","top-center",2);		
                },
                error: function (error) {
                    console.log(error);
                }                  
            });	
    
       }
           , function(){ });
    });

});