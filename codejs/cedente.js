$(document).ready(function(){

    var _count = 0,_objeto, _continuar,_opcaccion, _cbociudad, _cboid, _cedente, _cbocargo, _ext,_celular,_resultcon = [], 
    _resultpro = [], _cargo, _resultcat =[], _resultage = [],_codigo,_agencia,_cbosucursal,_sucursal,_zona,_estado, _producto,
    _descripcion, _newproducto, _codigocat, _catalogo, _estadocat, _produc, _email1, _email2, _countagen = 0, _codigoagen
    ,_continuamod, _countproduc = 0, _estadopro, _contactoold,_codcargoold,_celularold,_extold,_email1old,_estadoagen,_estadocat,
    _resultcattem =[];


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

    

    // nuevo-cedente
    $('#btnNuevo').click(function(){        
        $.redirect('newcede.php', {'mensaje': ''});
    });

    $('#btnRegresar').click(function(){        
      $.redirect("admincede.php");
    });  

      $('#cboProvincia').select2();
      $('#cboCiudad').select2();
      $('#cboArbol').select2();
      $('#cboSucursal').select2();
      $('#cboZona').select2();
      $('#cboCargo').select2();
      $('#cboCargoMo').select2();
      $('#cboSucursalMo').select2();
      $('#cboZonaMo').select2();

    
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

     //Contactos
    $('#btnContacto').click(function(){

        _contacto = $('#txtContacto').val();
        _cbocargo = $('#cboCargo').val();
        _cargo =$("#cboCargo option:selected").text();      
        _ext = $('#txtExt').val();
        _celular = $('#txtCelular').val();
        _email1 = $.trim($('#txtEmail1').val());
        _email2 = $.trim($('#txtEmail2').val());
        _continuar = true;

      if(_contacto == '')
      {
          mensajesalertify("Ingrese Contacto..!","W","top-center",5);
          return;
      }  

      if(_cbocargo == '0')
      {
          mensajesalertify("Seleccione Cargo..!","W","top-center",5);
          return;
      }
      
      $.each(_resultcon,function(i,item)
      {
          if(item.arrycontacto.toUpperCase() == _contacto.toUpperCase())
          {                        
              mensajesalertify("Contacto ya Existe..!","E","bottom-center",5); 
              _continuar = false;
              return;
          }
      });

    //   $.each(_resultcon,function(i,item)
    //   {
    //       if(item.arrycelular == _celular)
    //       {                        
    //           mensajesalertify("Celular ya Existe..!","E","bottom-center",5); 
    //           _continuar = false;
    //           return;
    //       }
    //   });

    //   $.each(_resultcon,function(i,item)
    //   {
    //       if(item.arryemail1.toUpperCase() == _email1.toUpperCase())
    //       {                        
    //           mensajesalertify("Email ya Existe..!","E","bottom-center",5); 
    //           _continuar = false;
    //           return;
    //       }
    //   });


      if(_email1 != '')
      {
        var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
    
        if (regex.test($('#txtEmail1').val().trim())) {
            console.log('correcto');                            
        } else {
            mensajesalertify("Email es invalido","E","bottom-right",5);
            _continuar = false;   
            return;
        }        
      }
      

      if(_continuar)
      {
          _count++;
          _output = '<tr id="row_' + _count + '">';
          _output += '<td style="display: none;">' + _count + ' <input type="hidden" name="hidden_codigo[]" id="codigo' + _count + '" value="' + _count + '" /></td>';                
          _output += '<td>' + _contacto + ' <input type="hidden" name="hidden_contacto[]" id="txtContacto' + _count + '" value="' + _contacto + '" /></td>';
          _output += '<td class="text-center">' + _cargo + ' <input type="hidden" name="hidden_cargo[]" id="cboCargo' + _count + '" value="' + _cbocargo + '" /></td>';
          _output += '<td style="display: none;" class="text-center">' + _cbocargo + ' <input type="hidden" name="hidden_codigocargo[]" id="codCargo' + _count + '" value="' + _cbocargo + '" /></td>';
          _output += '<td class="text-center">' + _celular + ' <input type="hidden" name="hidden_celular[]" id="txtCelular' + _count + '" value="' + _celular + '" /></td>';
          _output += '<td class="text-center">' + _ext + ' <input type="hidden" name="hidden_ext[]" id="txtExt' + _count + '" value="' + _ext + '" /></td>';
          _output += '<td class="text-center">' + _email1 + ' <input type="hidden" name="hidden_email1[]" id="txtEmail1' + _count + '" value="' + _email1 + '" /></td>';
          _output += '<td><div class="text-center"><div class="btn-group">'
          _output += '<button type="button" name="btnEditCon" class="btn btn-outline-info btnEditCon btn-sm ml-3" data-toggle="tooltip" data-placement="top" title="editar" id="' + _count + '"><i class="fa fa-pencil-square-o"></i></button>';
          _output += '<button type="button" name="btnDeleteCon" class="btn btn-outline-danger btnDeleteCon btn-sm ml-3" data-toggle="tooltip" data-placement="top" title="eliminar" id="' + _count + '"><i class="fa fa-trash-o"></i></button></div></div></td>';
          _output += '</tr>';

       
          
          $('#tblcontacto').append(_output);

          _objeto = {
              arrycodigo : parseInt(_count),
              arrycontacto : _contacto,
              arrycbocargo : _cbocargo,
              arrycelular : _celular,
              arryext : _ext,
              arryemail1 : _email1,
              arryemail2 : _email2
          }

          _resultcon.push(_objeto);   

          $('#txtContacto').val('');
          $('#cboCargo').val('0').change();
          $('#txtExt').val('');
          $('#txtCelular').val('');
          $('#txtEmail1').val('');                                
      }       
    });

    //Contacto-Editar-Modal

    $(document).on("click",".btnEditCon",function(){
      $("#formContacto").trigger("reset"); 
      _idcontacto = $(this).attr("id");
      _contactoold = $('#txtContacto' + _idcontacto + '').val();
      _codcargoold = $('#cboCargo' + _idcontacto + '').val();
      _celularold = $('#txtCelular' + _idcontacto + '').val();
      _extold = $('#txtExt' + _idcontacto + '').val();
      _email1old = $('#txtEmail1' + _idcontacto + '').val();   
      _tipoSave = 'edit';


      $('#txtContactoMo').val(_contactoold);
      $('#cboCargoMo').val(_codcargoold).change();
      $('#txtCelularMo').val(_celularold);
      $('#txtExtMo').val(_extold);
      $('#txtEmail1Mo').val(_email1old);

      $('#hidden_row_id').val(_idcontacto);
      $("#headercon").css("background-color","#183456");
      $("#headercon").css("color","white");
      $(".modal-title").text("Editar Contacto");       
      $("#btnAgregar").text("Modificar");
      $("#modalCONTACTO").modal("show");

  });

    //botton editar-contacto

  $('#btnEditarCon').click(function(){
      debugger;
    let _continuacon = false;
    let _newcontacto = $.trim($('#txtContactoMo').val());
    let _newcbocargo = $('#cboCargoMo').val();
    let _newcargo = $("#cboCargoMo option:selected").text(); 
    let _newext =  $.trim($('#txtExtMo').val());
    let _newcel = $.trim($('#txtCelularMo').val());
    let _newemail1 = $.trim($('#txtEmail1Mo').val());
    let _newemail2 = $.trim($('#txtEmail1Mo').val());

    if(_newcontacto == ''){
        mensajesalertify("Ingrese Contacto..!!","W","top-center",5);
        return;
    }

    if(_newcbocargo == '0')
    {
        mensajesalertify("Seleccione Cargo..!","W","top-center",5);
        return;
    }

    if(_newemail1 != '')
    {
      var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
  
      if (regex.test($('#txtEmail1Mo').val().trim())) {
          console.log('correcto');                            
      } else {
          mensajesalertify("Email es invalido","E","bottom-right",5);
          _continuar = false;   
          return;
      }        
    }

    if(_contactoold.toUpperCase() != _newcontacto.toUpperCase()){
        $.each(_resultcon,function(i,item)
        {
            if(item.arrycontacto.toUpperCase() == _newcontacto.toUpperCase())
            {
                mensajesalertify("Contacto ya Existe..!","E","bottom-center",5); 
                _continuacon = false;
                return false;
            }else
            {
                _continuacon = true;
            }

            // if(item.arrycelular == _newcel)
            // {
            //     mensajesalertify("Celular ya Existe..!","E","bottom-center",5); 
            //     _continuacon = false;
            //     return false;
            // }else
            // {
            //     _continuacon = true;
            // }
            
            // if(item.arryemail1 == _newemail1)
            // {
            //     mensajesalertify("Email ya Existe..!","E","bottom-center",5); 
            //     _continuacon = false;
            //     return false;
            // }else
            // {
            //     _continuacon = true;
            // }
        });
    }else  _continuacon = true;

    if(_continuacon)
    {
        FunRemoveContacto(_resultcon, _contactoold);

        _objeto = {
            arrycodigo : parseInt(_idcontacto),
            arrycontacto : _newcontacto,
            arrcargo : _newcargo,
            arrycbocargo : _newcbocargo,
            arrycelular : _newcel,
            arryext : _newext,
            arryemail1 : _newemail1
        }

        _resultcon.push(_objeto);  
        
        $("#modalCONTACTO").modal("hide"); 
        $("tbody").children().remove();

        _resultcon.sort((a,b) => a.arrycodigo - b.arrycodigo)

            $.each(_resultcon, function(i,item){
                _output = '<tr id="row_' + item.arrycodigo + '">';
                _output += '<td style="display: none;">' + item.arrycodigo + ' <input type="hidden" name="hidden_codigo[]" id="codigo' + item.arrycodigo + '" value="' + item.arrycodigo + '" /></td>';                
                _output += '<td>' + item.arrycontacto + ' <input type="hidden" name="hidden_contacto[]" id="txtContacto' + item.arrycodigo + '" value="' + item.arrycontacto + '" /></td>';
                _output += '<td class="text-center">' + item.arrcargo + ' <input type="hidden" name="hidden_cargo[]" id="cboCargo' + item.arrycodigo + '" value="' + item.arrycbocargo  + '" /></td>';
                _output += '<td style="display: none;" class="text-center">' + item.arrycbocargo + ' <input type="hidden" name="hidden_codigocargo[]" id="codCargo' + item.arrycodigo + '" value="' + item.arrycbocargo + '" /></td>';
                _output += '<td class="text-center">' + item.arrycelular + ' <input type="hidden" name="hidden_celular[]" id="txtCelular' + item.arrycodigo + '" value="' + item.arrycelular  + '" /></td>';
                _output += '<td class="text-center">' + item.arryext  + ' <input type="hidden" name="hidden_ext[]" id="txtExt' + item.arrycodigo + '" value="' + item.arryext  + '" /></td>';
                _output += '<td class="text-center">' + item.arryemail1 + ' <input type="hidden" name="hidden_email1[]" id="txtEmail1' + item.arrycodigo + '" value="' + item.arryemail1 + '" /></td>';
                _output += '<td><div class="text-center"><div class="btn-group">'
                _output += '<button type="button" name="btnEditCon" class="btn btn-outline-info btnEditCon btn-sm ml-3" data-toggle="tooltip" data-placement="top" title="editar" id="' + item.arrycodigo + '"><i class="fa fa-pencil-square-o"></i></button>';
                _output += '<button type="button" name="btnDeleteCon" class="btn btn-outline-danger btnDeleteCon btn-sm ml-3" data-toggle="tooltip" data-placement="top" title="eliminar" id="' + item.arrycodigo + '"><i class="fa fa-trash-o"></i></button></div></div></td>';
                _output += '</tr>';
                
                $('#tblcontacto').append(_output);

            });
    } 

  });

    //delete-contacto

    $(document).on("click",".btnDeleteCon",function(){
        row_id = $(this).attr("id");
        _contacto = $('#txtContacto' + row_id + '').val();

        alertify.confirm('El registro sera eliminado..!!', 'Esta seguro de eliminar Contacto' +' '+ _contacto +'..?' , function(){ 

            FunRemoveContacto(_resultcon, _contacto);
            $('#row_' + row_id + '').remove();
            _count--;

        }
        , function(){ });
    });

    //Remove contacto

    function FunRemoveContacto(arr, deta)
    {
        $.each(arr,function(i,item){
            if(item.arrycontacto == deta)
            {
                arr.splice(i, 1);
                return false;
            }else{
                continuar = true;
            }
        });        
    };  

    //Producto

    $('#btnProducto').click(function(){

        _producto = $('#txtProducto').val();
        _descripcion = $('#txtDescripcion').val();
        _estado = 'Activo';
        _continuarproduc = true;
        _tipoSave = 'add';
        

        let tableHeaderRowCount = 1;
        let table = document.getElementById('tblcatalogo');
        let rowCount = table.rows.length;

        for (var i = tableHeaderRowCount; i < rowCount; i++) {
            table.deleteRow(tableHeaderRowCount);
        }    

        if(_producto == '')
        {
            mensajesalertify("Ingrese Producto..!","W","top-center",5);
            return;
        } 
        
        $.each(_resultpro,function(i,item)
        {
            if(item.arryproducto.toUpperCase() == _producto.toUpperCase())
            {                        
                mensajesalertify("Producto ya Existe..!","E","bottom-center",5); 
                _continuarproduc = false;
                return false;
            }else{
                _continuarproduc = true;
            }
        });

        if(_continuarproduc)
        {
            _countproduc++;
            _output = '<tr id="row_' + _countproduc + '">';
            _output += '<td style="display: none;">' + _countproduc + ' <input type="hidden" name="hidden_codigo[]" id="codigo' + _countproduc + '" value="' + _countproduc + '" /></td>';                
            _output += '<td>' + _producto + ' <input type="hidden" name="hidden_producto[]" id="txtProducto' + _countproduc + '" value="' + _producto + '" /></td>';
            _output += '<td class="text-center">' + _estado + ' <input type="hidden" name="hidden_estado[]" id="txtEsTado' + _countproduc + '" value="' + _estado + '" /></td>';
            _output += '<td><div class="text-center"><div class="btn-group">'
            _output += '<button type="button" name="btnEditCon" class="btn btn-outline-success btn-sm ml-3 btnCatPro" data-toggle="tooltip" data-placement="top" title="agregar catalogo" id="' + _countproduc + '"><i class="fa fa-upload"></i></button>';
            _output += '<button type="button" name="btnEditCon" class="btn btn-outline-info btn-sm ml-3 btnEditPro" data-toggle="tooltip" data-placement="top" title="editar" id="' + _countproduc + '"><i class="fa fa-pencil-square-o"></i></button>';
            _output += '<button type="button" name="btnDeleteCon" class="btn btn-outline-danger btn-sm ml-3 btnDeletePro" data-toggle="tooltip" data-placement="top" title="eliminar" id="' + _countproduc + '"><i class="fa fa-trash-o"></i></button></div></div></td>';
            _output += '</tr>';
            
            $('#tblproducto').append(_output);

            _objeto = {
                arrycodigo : parseInt(_countproduc),
                arryproducto : _producto,
                arryestado : _estado,
            }

            _resultpro.push(_objeto);   
            $('#txtProducto').val('');
            $('#txtDescripcion').val('');                  
            
        }   
    });

    //editar producto
    $(document).on("click",".btnEditPro",function(){
        $("#formProducto").trigger("reset"); 
        _idproduc = $(this).attr("id");
        _productoant = $('#txtProducto' + _idproduc + '').val();
        _estadopro = $('#txtEsTado' + _idproduc + '').val();   
        _tipoSave = 'edit';
    
        $('#txtProductoMo').val(_productoant);

        if(_estadopro == "Activo"){
            $("#chkEstadoPro").prop("checked", true);
            $("#lblEstadoPro").text("Activo");
        }else{
            $("#chkEstadoPro").prop("checked", false);
            $("#lblEstadoPro").text("Inactivo");
        }

        $('#hidden_row_id').val(_idproduc);
        $("#headerpro").css("background-color","#183456");
        $("#headerpro").css("color","white");
        $(".modal-title").text("Editar Producto");       
        $("#btnModProduc").text("Modificar");
        $("#modalPRODUCTO").modal("show");

    });

    //cheked producto-modal
    $("#chkEstadoPro").click(function(){
        let _checkedPro = $("#chkEstadoPro").is(":checked");

        if(_checkedPro){
            $("#lblEstadoPro").text("Activo");
            _estadopro = 'Activo';
        }else{
            $("#lblEstadoPro").text("Inactivo");
            _estadopro = 'Inactivo';
        }
    });

    //button-editar-producto

    $('#btnModProduc').click(function(){

        let _continuamod = false;
        let _productonew = $.trim($('#txtProductoMo').val());

        if(_productonew == ''){
            mensajesalertify("Ingrese Producto..!!","W","top-center",5);
            return;
        }

        //debugger;

        if(_productoant.toUpperCase() != _productonew.toUpperCase()){
            $.each(_resultpro,function(i,item)
            {
                if(item.arryproducto.toUpperCase() == _productonew.toUpperCase())
                {
                    mensajesalertify("Producto ya Existe..!","E","bottom-center",5); 
                    _continuamod = false;
                    return false;
                }else
                {
                    _continuamod = true;
                }
            });
        }else  _continuamod = true;


        if(_continuamod)
        {
            FunRemoveProduc(_resultpro, _productoant);

            _objeto = {
                arrycodigo : parseInt(_idproduc),
                arryproducto : _productonew,
                arryestado : _estadopro,
            }

            _resultpro.push(_objeto);

            $("#modalPRODUCTO").modal("hide"); 

            //$("tbody").children().remove();
            $("#tblproducto").empty();

            _output = '<thead class="text-center"';
            _output += '<tr><th style="display: none;">Id</th>';
            _output += '<th>Producto</th><th>Estado</th><th>Acciones</th></tr></thead>'
            $('#tblproducto').append(_output);  
            
            _output  = '<tbody>';
            $('#tblproducto').append(_output); 

            _resultpro.sort((a,b) => a.arrycodigo - b.arrycodigo)

            $.each(_resultpro, function(i,item){
                _output = '<tr id="row_' + item.arrycodigo + '">';
                _output += '<td style="display: none;">' + item.arrycodigo + ' <input type="hidden" name="hidden_codigo[]" id="codigo' + item.arrycodigo + '" value="' + item.arrycodigo + '" /></td>';                
                _output += '<td>' + item.arryproducto + ' <input type="hidden" name="hidden_producto[]" id="txtProducto' + item.arrycodigo + '" value="' + item.arryproducto + '" /></td>';
                _output += '<td class="text-center">' + item.arryestado + ' <input type="hidden" name="hidden_estado[]" id="txtEsTado' + item.arrycodigo + '" value="' + item.arryestado + '" /></td>';
                _output += '<td><div class="text-center"><div class="btn-group">'
                _output += '<button type="button" name="btnEditCon" class="btn btn-outline-success btn-sm ml-3 btnCatPro" data-toggle="tooltip" data-placement="top" title="agregar catalogo" id="' + item.arrycodigo + '"><i class="fa fa-upload"></i></button>';
                _output += '<button type="button" name="btnEditCon" class="btn btn-outline-info btn-sm ml-3 btnEditPro" data-toggle="tooltip" data-placement="top" title="editar" id="' + item.arrycodigo + '"><i class="fa fa-pencil-square-o"></i></button>';
                _output += '<button type="button" name="btnDeleteCon" class="btn btn-outline-danger btn-sm ml-3 btnDeletePro" data-toggle="tooltip" data-placement="top" title="eliminar" id="' + item.arrycodigo + '"><i class="fa fa-trash-o"></i></button></div></div></td>';
                _output += '</tr>';
                
                $('#tblproducto').append(_output);  
            });
            _output  = '</tbody>';
            $('#tblproducto').append(_output);             
        }

    });

    //Remove Producto
    function FunRemoveProduc(arr, deta)
    {
        $.each(arr,function(i,item){
            if(item.arryproducto == deta)
            {
                arr.splice(i, 1);
                return false;
            }
        });        
    };  

    //delete producto

    $(document).on("click",".btnDeletePro",function(){
        _idproduc = $(this).attr("id");
        _producto = $('#txtProducto' + _idproduc + '').val();
        let _contdelcat = true;

        $.each(_resultcat,function(i,item){
            if(item.arryproductocat == _producto)
            {
                mensajesalertify("Existen Catalagos Asociados al Producto..!","E","bottom-right",5); 
                _contdelcat = false;
                return false;
            }
        });          

        if(_contdelcat)
        {
            alertify.confirm('El registro sera eliminado..!', 'Esta seguro de eliminar Producto' +' '+ _producto +'..?' , function(){ 

                FunRemoveProduc(_resultpro, _producto);
                $('#row_' + _idproduc + '').remove();
                _countproduc--;

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
        $("#headercat").css("background-color","#183456");
        $("#headercat").css("color","white");
        $(".modal-title").text("Agregar Catalogo");       
        $("#btnAgregar").text("Agregar");
        $("#modalCATALOGO").modal("show");

    });

    function FunBuscarDatos(codproduc){
        $("#tblcatalogo").empty();
     
        _output = '<thead class="text-center"';
        _output += '<tr><th style="display: none;">Id</th>';
        _output += '<th>Producto</th><th>Cod.Catalogo</th><th>Catalogo</th><th>Estado</th><th>Acciones</th>'
        $('#tblcatalogo').append(_output);  
        
        _output  = '<tbody>';
        $('#tblcatalogo').append(_output);   
                
       if(_resultcat.length > 0)
       {
        $.each(_resultcat, function(i,item){
            
            if(item.arryproductocat == codproduc)
            {
                _output = '<tr id="row_' + item.arrycodigo + '">';
                _output += '<td style="display: none;">' + item.arrycodigo + ' <input type="hidden" name="hidden_codigo[]" id="codigo' + item.arrycodigo + '" value="' + item.arrycodigo + '" /></td>';                
                _output += '<td>' + item.arryproductocat + ' <input type="hidden" name="hidden_producto[]" id="txtProducto' + item.arrycodigo + '" value="' + item.arryproductocat + '" /></td>';
                _output += '<td class="text-center">' + item.arrycodigocat + ' <input type="hidden" name="hidden_codigocat[]" id="txtCodigoCat' + item.arrycodigo + '" value="' + item.arrycodigocat + '" /></td>';
                _output += '<td class="text-center">' + item.arrycatalogo + ' <input type="hidden" name="hidden_catalogo[]" id="txtCatalogo' + item.arrycodigo + '" value="' + item.arrycatalogo + '" /></td>';
                _output += '<td class="text-center">' + item.arryestado + ' <input type="hidden" name="hidden_estado[]" id="txtEsTadoCat' + item.arrycodigo + '" value="' + item.arryestado  + '" /></td>';
                _output += '<td><div class="text-center"><div class="btn-group">'
                _output += '<button type="button" name="btnEditCat" class="btn btn-outline-info btn-sm ml-3 btnEditCat" data-toggle="tooltip" data-placement="top" title="editar" id="' + item.arrycodigo + '"><i class="fa fa-pencil-square-o"></i></button>';
                _output += '<button type="button" name="btnDeleteCat" class="btn btn-outline-danger btn-sm ml-3 btnDeleteCat" data-toggle="tooltip" data-placement="top" title="eliminar" id="' + item.arrycodigo + '"><i class="fa fa-trash-o"></i></button></div></div></td>';
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

    //_newproducto = $('#txtProductoMo').val(_produc);
    _codigocat = $('#txtCodigoMo').val();
    _catalogo = $('#txtCatalogoMo').val();
    _estadocat = 'Activo';
    _continuar = true;

    if(_codigocat == '')
        {
            mensajesalertify("Ingrese Codigo..!","W","top-center",5);
            return;
        } 

        if(_catalogo == '')
        {
            mensajesalertify("Ingrese Catalogo..!","W","top-center",5);
            return;
        } 
        
        $.each(_resultcat,function(i,item)
        {
            if(item.arryproductocat.toUpperCase() == _produc.toUpperCase() && item.arrycodigocat.toUpperCase() == _codigocat.toUpperCase())
            {                        
                mensajesalertify("Catalogo ya Existe..!","E","bottom-center",5); 
                _continuar = false;
                return;
            }
        });

        if(_continuar)
        {
            _count++;
            _output = '<tr id="row_' + _count + '">';
            _output += '<td style="display: none;">' + _count + ' <input type="hidden" name="hidden_codigo[]" id="codigo' + _count + '" value="' + _count + '" /></td>';                
            _output += '<td>' + _produc + ' <input type="hidden" name="hidden_producto[]" id="txtProducto' + _count + '" value="' + _produc + '" /></td>';
            _output += '<td class="text-center">' + _codigocat + ' <input type="hidden" name="hidden_codigocat[]" id="txtCodigoCat' + _count + '" value="' + _codigocat + '" /></td>';
            _output += '<td class="text-center">' + _catalogo + ' <input type="hidden" name="hidden_catalogo[]" id="txtCatalogo' + _count + '" value="' + _catalogo + '" /></td>';
            _output += '<td class="text-center">' + _estadocat + ' <input type="hidden" name="hidden_estado[]" id="txtEsTadoCat' + _count + '" value="' + _estadocat + '" /></td>';
            _output += '<td><div class="text-center"><div class="btn-group">'
            _output += '<button type="button" name="btnEditCat" class="btn btn-outline-info btn-sm ml-3 btnEditCat" data-toggle="tooltip" data-placement="top" title="editar" id="' + _count + '"><i class="fa fa-pencil-square-o"></i></button>';
            _output += '<button type="button" name="btnDeleteCat" class="btn btn-outline-danger btn-sm ml-3 btnDeleteCat" data-toggle="tooltip" data-placement="top" title="eliminar" id="' + _count + '"><i class="fa fa-trash-o"></i></button></div></div></td>';
            _output += '</tr>';
            
            $('#tblcatalogo').append(_output);

            _objeto = {
                arrycodigo : parseInt(_count),
                arryproductocat : _produc,
                arrycodigocat : _codigocat,
                arrycatalogo : _catalogo,
                arryestado : _estadocat,
            }

            _resultcat.push(_objeto);
            $("#modalCATALOGO").modal("hide");                                     
        }   
    });

    //editar-catalogo-modal
    $(document).on("click",".btnEditCat",function(){
        $("#formEditCatalogo").trigger("reset"); 
        _idcatalogo = $(this).attr("id");
        
        _codcatold = $('#txtCodigoCat' + _idcatalogo + '').val();
        _catalogoold = $('#txtCatalogo' + _idcatalogo + '').val();
        _estadocat = $('#txtEsTadoCat' + _idcatalogo + '').val(); 
        
        $('#txtCodMo').val(_codcatold);
        $('#txtCatMo').val(_catalogoold);
    
        if(_estadocat == "Activo"){
            $("#chkEstadoCat").prop("checked", true);
            $("#lblEstadoCat").text("Activo");
        }else{
            $("#chkEstadoCat").prop("checked", false);
            $("#lblEstadoCat").text("Inactivo");
        }
    
        $("#headercatalog").css("background-color","#183456");
        $("#headercatalog").css("color","white");
        $(".modal-title").text("Editar Catalogo");       
        $("#modalEDITCATALOGO").modal("show");
    });

    //checked modal-editar-catalogo

    $("#chkEstadoCat").click(function(){
        _checked = $("#chkEstadoCat").is(":checked");
        if(_checked){
            $("#lblEstadoCat").text("Activo");
            _estadocat = 'Activo';
        }else{
            $("#lblEstadoCat").text("Inactivo");
            _estadocat = 'Inactivo';
        }
    });

    //botton-editar-catalogo
     
    $('#btnEditCat').click(function(){

        let _continucat = false;
        let _newcodcat = $.trim($('#txtCodMo').val());
        let _newcatalogo = $.trim($('#txtCatMo').val());

        if(_newcodcat == ''){
            mensajesalertify("Ingrese Codigo..!!","W","top-center",5);
            return;
        }

        if(_newcatalogo == ''){
            mensajesalertify("Ingrese Catalogo..!!","W","top-center",5);
            return;
        }

        if(_catalogoold.toUpperCase() != _newcatalogo.toUpperCase()){
            $.each(_resultcat,function(i,item)
            {
                if(item.arrycatalogo.toUpperCase() == _newcatalogo.toUpperCase())
                {
                    mensajesalertify("Catalogo ya Existe..!","E","bottom-center",5); 
                    _continucat = false;
                    return false;
                }else
                {
                    _continucat = true;
                }
            });
        }else  _continucat = true;

        if(_continucat)
        {
            
            FunRemoveItemCatalogo(_resultcat, _catalogoold);

            _objeto = {
                arrycodigo : parseInt(_idcatalogo),
                arryproductocat : _produc,
                arrycodigocat : _newcodcat,
                arrycatalogo : _newcatalogo,
                arryestado : _estadocat,
            }

            _resultcat.push(_objeto);

            $("#modalEDITCATALOGO").modal("hide"); 
            $("#tblcatalogo").empty();
            
            _output = '<thead class="text-center"';
            _output += '<tr><th style="display: none;">Id</th>';
            _output += '<th>Producto</th><th>Cod.Catalogo</th><th>Catalogo</th><th>Estado</th><th>Acciones</th>'
            $('#tblcatalogo').append(_output);  
            
            _output  = '<tbody>';
            $('#tblcatalogo').append(_output);             

            _resultcat.sort((a,b) => a.arrycodigo - b.arrycodigo)

            $.each(_resultcat, function(i,item){
                
                _output = '<tr id="row_' + item.arrycodigo + '">';
                _output += '<td style="display: none;">' + item.arrycodigo + ' <input type="hidden" name="hidden_codigo[]" id="codigo' + item.arrycodigo + '" value="' + item.arrycodigo + '" /></td>';                
                _output += '<td>' + item.arryproductocat + ' <input type="hidden" name="hidden_producto[]" id="txtProducto' + item.arrycodigo + '" value="' + item.arryproductocat + '" /></td>';
                _output += '<td class="text-center">' + item.arrycodigocat + ' <input type="hidden" name="hidden_codigocat[]" id="txtCodigoCat' + item.arrycodigo + '" value="' + item.arrycodigocat + '" /></td>';
                _output += '<td class="text-center">' + item.arrycatalogo + ' <input type="hidden" name="hidden_catalogo[]" id="txtCatalogo' + item.arrycodigo + '" value="' + item.arrycatalogo + '" /></td>';
                _output += '<td class="text-center">' + item.arryestado + ' <input type="hidden" name="hidden_estado[]" id="txtEsTadoCat' + item.arrycodigo + '" value="' + item.arryestado  + '" /></td>';
                _output += '<td><div class="text-center"><div class="btn-group">'
                _output += '<button type="button" name="btnEditCat" class="btn btn-outline-info btn-sm ml-3 btnEditCat" data-toggle="tooltip" data-placement="top" title="editar" id="' + item.arrycodigo + '"><i class="fa fa-pencil-square-o"></i></button>';
                _output += '<button type="button" name="btnDeleteCat" class="btn btn-outline-danger btn-sm ml-3 btnDeleteCat" data-toggle="tooltip" data-placement="top" title="eliminar" id="' + item.arrycodigo + '"><i class="fa fa-trash-o"></i></button></div></div></td>';
                _output += '</tr>';
                
                $('#tblcatalogo').append(_output);

            });

            _output  = '</tbody>';
            $('#tblcatalogo').append(_output);              
        }
    });


    //delete catalogo

    $(document).on("click",".btnDeleteCat",function(){
        row_id = $(this).attr("id");
        _catalogo = $('#txtCatalogo' + row_id + '').val();

        alertify.confirm('El registro sera eliminado..!!', 'Esta seguro de eliminar Catalogo' +' '+ _catalogo +'..?' , function(){ 

            FunRemoveItemCatalogo(_resultcat, _catalogo);
            $('#row_' + row_id + '').remove();
            _count--;

        }
        , function(){ });
    });

    function FunRemoveItemCatalogo(arr, deta)
    {
        $.each(arr,function(i,item){
            if(item.arrycatalogo == deta)
            {
                arr.splice(i, 1);
                return false;
            }else{
                continuar = true;
            }
        });        
    };   

     //Agencias
    $('#btnAgencia').click(function(){

      _codigoagen = $('#txtCodigoAge').val();
      _agencia = $('#txtAgencia').val();      
      _cbosucursal = $('#cboSucursal').val();
      _sucursal =$("#cboSucursal option:selected").text(); 
      _cbozona = $('#cboZona').val();     
      _zona =$("#cboZona option:selected").text();
      _estadoagen = 'Activo';
      _continuaragen = true;

      if(_codigoagen == '')
      {
          mensajesalertify("Ingrese Codigo..!","W","top-center",5);
          return;
      } 
      
      if(_agencia == '')
      {
          mensajesalertify("Ingrese Agencia..!","W","top-center",5);
          return;
      } 

      if(_cbosucursal == '0')
      {
          mensajesalertify("Seleccione Sucursal..!","W","top-center",5);
          return;
      }
      
      $.each(_resultage,function(i,item)
      {
          if(item.arryagencia.toUpperCase() == _agencia.toUpperCase())
          {                        
              mensajesalertify("Agencia ya Existe..!","E","bottom-center",5); 
              _continuaragen = false;
              return false;
          }else{
            _continuaragen = true;
          }
      });

      if(_continuaragen)
      {
          _countagen++;
          _output = '<tr id="row_' + _countagen + '">';
          _output += '<td style="display: none;">' + _countagen + ' <input type="hidden" name="hidden_codigo[]" id="codigoagen' + _countagen + '" value="' + _countagen + '" /></td>';                
          _output += '<td>' + _agencia + ' <input type="hidden" name="hidden_agencia[]" id="txtAgencia' + _countagen + '" value="' + _agencia + '" /></td>';
          _output += '<td class="text-center">' + _codigoagen + ' <input type="hidden" name="hidden_codigo[]" id="txtCodigoAgen' + _countagen + '" value="' + _codigoagen + '" /></td>';
          _output += '<td style="display: none;" class="text-center">' + _cbosucursal + ' <input type="hidden" name="hidden_codigosucursal[]" id="codigoSucursal' + _countagen + '" value="' + _cbosucursal + '" /></td>';
          _output += '<td class="text-center">' + _sucursal + ' <input type="hidden" name="hidden_sucursal[]" id="cboSucursal' + _countagen + '" value="' + _sucursal + '" /></td>';
          _output += '<td style="display: none;" class="text-center">' + _cbozona + ' <input type="hidden" name="hidden_codigozona[]" id="codigoZona' + _countagen + '" value="' + _cbozona + '" /></td>';
          _output += '<td class="text-center">' + _zona + ' <input type="hidden" name="hidden_zona[]" id="cboZona' + _countagen + '" value="' + _zona + '" /></td>';
          _output += '<td class="text-center">' + _estadoagen + ' <input type="hidden" name="hidden_email1[]" id="txtEstadoAg' + _countagen + '" value="' + _estadoagen + '" /></td>';
          _output += '<td><div class="text-center"><div class="btn-group">'
          _output += '<button type="button" name="btnEdit" class="btn btn-outline-info btn-sm ml-3 btnEditAgencia" data-toggle="tooltip" data-placement="top" title="editar" id="' + _countagen + '"><i class="fa fa-pencil-square-o"></i></button>';
          _output += '<button type="button" name="btnDelete" class="btn btn-outline-danger btn-sm ml-3 btnDeleteAgencia" data-toggle="tooltip" data-placement="top" title="eliminar" id="' + _countagen + '"><i class="fa fa-trash-o"></i></button></div></div></td>';
          _output += '</tr>';
          
          $('#tblagencia').append(_output);

          _objeto = {
              arrycodigo : parseInt(_countagen),
              arryagencia : _agencia,
              arrycodigoagen : _codigoagen,
              arrysucursal : _sucursal,
              arryzona : _zona,
              arryestado : _estadoagen,
          }

          _resultage.push(_objeto);  

          $('#txtCodigoAge').val('');
          $('#txtAgencia').val('');          
          $('#cboSucursal').val('0').change();
          $('#cboZona').val('0').change();                             
      }       
    });

    //Modal Agencia-editar

    $(document).on("click",".btnEditAgencia",function(){
        $("#formAgencia").trigger("reset"); 
        _idagencia = $(this).attr("id");
        _agenciaold = $('#txtAgencia' + _idagencia + '').val();
        _codigoldagen = $('#txtCodigoAgen' + _idagencia + '').val();
        _sucursalold = $('#codigoSucursal' + _idagencia + '').val();
        _zonaold = $('#codigoZona' + _idagencia + '').val();
        _estadoagen = $('#txtEstadoAg' + _idagencia + '').val();
        _tipoSave = 'edit';


        $('#txtAgenciaMo').val(_agenciaold);
        $('#txtCodigoAgeMo').val(_codigoldagen);
        $('#cboSucursalMo').val(_sucursalold).change();
        $('#cboZonaMo').val(_zonaold).change();

        if(_estadoagen == "Activo"){
            $("#chkEstadoAg").prop("checked", true);
            $("#lblEstadoAg").text("Activo");
        }else{
            $("#chkEstadoAg").prop("checked", false);
            $("#lblEstadoAg").text("Inactivo");
        }
  
        // $('#hidden_row_id').val(row_id);
        $("#headeragencia").css("background-color","#183456");
        $("#headeragencia").css("color","white");
        $(".modal-title").text("Editar Agencia");       
        $("#btnAgregar").text("Modificar");
        $("#modalAGENCIA").modal("show");

    });

    //cheked agencia-modal
    $("#chkEstadoAg").click(function(){
        let _checkedAge = $("#chkEstadoAg").is(":checked");

        if(_checkedAge){
            $("#lblEstadoAg").text("Activo");
            _estadoagen = 'Activo';
        }else{
            $("#lblEstadoAg").text("Inactivo");
            _estadoagen = 'Inactivo';
        }
    });

    //button modificar agencia

    $('#btnEditAgencia').click(function(){

        let _continuage = false;
        let _newagencia = $.trim($('#txtAgenciaMo').val());
        let _newcodigo = $.trim($('#txtCodigoAgeMo').val());
        let _newcbosucursal = $('#cboSucursalMo').val();
        let _newsucursal = $("#cboSucursalMo option:selected").text();
        let _newcbozona = $('#cboZonaMo').val();
        let _newzona = $("#cboZonaMo option:selected").text();  
        
        
        if(_newagencia == ''){
            mensajesalertify("Ingrese Agencia..!!","W","top-center",5);
            return;
        }
        
        if(_agenciaold.toUpperCase() != _newagencia.toUpperCase()){
            $.each(_resultage,function(i,item)
            {
                if(item.arryagencia.toUpperCase() == _newagencia.toUpperCase())
                {
                    mensajesalertify("Agencia ya Existe..!","E","bottom-center",5); 
                    _continuage = false;
                    return false;
                }else
                {
                    _continuage = true;
                }

            });
        }else  _continuage = true;

        if(_continuage)
        {

            FunRemoveItemAgencia(_resultage, _agenciaold);

            _objeto = {
                arrycodigo : parseInt(_idagencia),
                arryagencia : _newagencia,
                arrycodigoagen : _newcodigo,
                arrsucur : _newsucursal,
                arrysucursal : _newcbosucursal,
                arrzo : _newzona,
                arryzona : _newcbozona,
                arryestado : _estadoagen,
            }
  
            _resultage.push(_objeto);
            
            $("#modalAGENCIA").modal("hide"); 
            $("tbody").children().remove();

            _resultage.sort((a,b) => a.arrycodigo - b.arrycodigo)

            $.each(_resultage, function(i,item){
               
                _output = '<tr id="row_' + item.arrycodigo + '">';
                _output += '<td style="display: none;">' + item.arrycodigo + ' <input type="hidden" name="hidden_codigo[]" id="codigoagen' + item.arrycodigo + '" value="' + item.arrycodigo + '" /></td>';                
                _output += '<td>' + item.arryagencia + ' <input type="hidden" name="hidden_agencia[]" id="txtAgencia' + item.arrycodigo + '" value="' + item.arryagencia + '" /></td>';
                _output += '<td class="text-center">' + item.arrycodigoagen + ' <input type="hidden" name="hidden_codigo[]" id="txtCodigoAgen' + item.arrycodigo + '" value="' + item.arrycodigoagen + '" /></td>';
                _output += '<td style="display: none;" class="text-center">' + item.arrysucursal + ' <input type="hidden" name="hidden_codigosucursal[]" id="codigoSucursal' + item.arrycodigo + '" value="' + item.arrysucursal + '" /></td>';
                _output += '<td class="text-center">' + item.arrsucur + ' <input type="hidden" name="hidden_sucursal[]" id="cboSucursal' + item.arrycodigo + '" value="' + item.arrsucur + '" /></td>';
                _output += '<td style="display: none;" class="text-center">' + item.arryzona + ' <input type="hidden" name="hidden_codigozona[]" id="codigoZona' + item.arrycodigo + '" value="' + item.arryzona + '" /></td>';
                _output += '<td class="text-center">' + item.arrzo + ' <input type="hidden" name="hidden_zona[]" id="cboZona' + item.arrycodigo + '" value="' + item.arrzo + '" /></td>';
                _output += '<td class="text-center">' + item.arryestado + ' <input type="hidden" name="hidden_email1[]" id="txtEstadoAg' + item.arrycodigo + '" value="' + item.arryestado + '" /></td>';
                _output += '<td><div class="text-center"><div class="btn-group">'
                _output += '<button type="button" name="btnEdit" class="btn btn-outline-info btn-sm ml-3 btnEditAgencia" data-toggle="tooltip" data-placement="top" title="editar" id="' + item.arrycodigo + '"><i class="fa fa-pencil-square-o"></i></button>';
                _output += '<button type="button" name="btnDelete" class="btn btn-outline-danger btn-sm ml-3 btnDeleteAgencia" data-toggle="tooltip" data-placement="top" title="eliminar" id="' + item.arrycodigo + '"><i class="fa fa-trash-o"></i></button></div></div></td>';
                _output += '</tr>';
                
                $('#tblagencia').append(_output);



            });
        }


    });


    //eliminar -agencia-modal

    $(document).on("click",".btnDeleteAgencia",function(){
        row_id = $(this).attr("id");

        _agencia = $('#txtAgencia' + row_id + '').val();
        
        alertify.confirm('El registro sera eliminado..!!', 'Esta seguro de eliminar Agencia' +' '+ _agencia +'..?' , function(){ 

            FunRemoveItemAgencia(_resultage, _agencia);
            $('#row_' + row_id + '').remove();
            _count--;

         }
        , function(){ });
    });

    //Remove Agencia
    function FunRemoveItemAgencia(arr, deta)
    {
        $.each(arr,function(i,item){
            if(item.arryagencia == deta)
            {
                arr.splice(i, 1);
                return false;
            }else{
                continuar = true;
            }
        });        
    };     

 

    //GRABAR CEDENTE

    $('#btnSave').click(function(){

      let _cedente = $('#txtCedente').val();

      let _cboprovincia = $('#cboProvincia').val();
      let _provincia =$("#cboProvincia option:selected").text();  

      let _cbocuidad = $('#cboCiudad').val();
      let _cuidad =$("#cboCiudad option:selected").text();  

      let _cboarbol = $('#cboArbol').val();
      let _arbol =$("#cboArbol option:selected").text(); 


      if(_cboprovincia == '0')
      {
          mensajesalertify("Seleccione Provincia..!","W","top-center",5);
          return;
      }	 
      
      if(_cbocuidad == '0')
      {
          mensajesalertify("Seleccione Cuidad..!","W","top-center",5);
          return;
      }	 


      if(_cedente == '')
      {
          mensajesalertify("Ingrese Cendente..!","W","top-center",5);
          return;
      } 
      

    });


});