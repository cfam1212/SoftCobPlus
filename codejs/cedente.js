$(document).ready(function(){

    var _count = 0,_objeto, _continuar,_opcaccion, _cbociudad, _cboid,_cedente, _cbocargo, _ext,_celular,_resultcon = [],_resultpro = [], _cargo,_resultcat =[],
    _resultage = [],_codigo,_agencia,_cbosucursal,_sucursal,_zona,_estado, _producto,_descripcion,_newproducto,_codigocat,_catalogo,_estadocat,_produc;

    
    //validar email ingresado
    $('#btnSave').click(function() {

        _email = $('#txtEmail1').val();

        if(_email != '')
        {
            var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
    
            if (regex.test($('#txtEmail1').val().trim())) {
                console.log('correcto');
                
        
            } else {
                mensajesalertify("Email es invalido","E","bottom-right",5);
            }
        }
        
    });

    
    
    
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
      _email1 = $('#txtEmail1').val();
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
              return false;
          }else{
              _continuar = true;
          }
      });

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
          _output += '<button type="button" name="btnEditCon" class="btn btn-outline-info btnEditCon  data-toggle="tooltip" data-placement="top" title="editar" btn-sm ml-3" id="' + _count + '"><i class="fa fa-pencil-square-o"></i></button>';
          _output += '<button type="button" name="btnDeleteCon" class="btn btn-outline-danger btnDeleteCon data-toggle="tooltip" data-placement="top" title="eliminar" btn-sm ml-3" id="' + _count + '"><i class="fa fa-trash-o"></i></button></div></div></td>';
          _output += '</tr>';
          
          $('#tblcontacto').append(_output);

          _objeto = {
              arrycodigo : parseInt(_count),
              arrycontacto : _contacto,
              arrycbocargo : _cbocargo,
              arrycelular : _celular,
              arryext : _ext,
              arryemail1 : _email1,
          }

          _resultcon.push(_objeto);   
          $('#txtContacto').val('');
          $('#cboCargo').val('');
          $('#txtExt').val('');
          $('#txtCelular').val('');
          $('#txtEmail1').val('');                      
          
      }   
    

    });

    //Contacto-Editar-Modal

    $(document).on("click",".btnEditCon",function(){
      $("#formContacto").trigger("reset"); 
      row_id = $(this).attr("id");
      _contactoold = $('#txtContacto' + row_id + '').val();
      _codcargoold = $('#cboCargo' + row_id + '').val();
      _celularold = $('#txtCelular' + row_id + '').val();
      _extold = $('#txtExt' + row_id + '').val();
      _email1old = $('#txtEmail1' + row_id + '').val();   
      _tipoSave = 'edit';


    //   alert(_codcargoold);
      _newcontacto = $('#txtContactoMo').val(_contactoold);
      //$('#cboCargo1').val('GRF');
      //$('#cboCargo1').prop('selectedIndex', 1);
      //$("#cboCargo1").prop("selectedIndex", 2);
      //$("#cboCargo1").change();

      $('#hidden_row_id').val(row_id);
      $("#header").css("background-color","#183456");
      $("#header").css("color","white");
      $(".modal-title").text("Editar Contacto");       
      $("#btnAgregar").text("Modificar");
      $("#modalCONTACTO").modal("show");




  });

  //Producto

  $('#btnProducto').click(function(){

    _producto = $('#txtProducto').val();
    _descripcion = $('#txtDescripcion').val();
    _estado = 'Activo';
    _continuar = true;

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
              _continuar = false;
              return false;
          }else{
              _continuar = true;
          }
      });

      if(_continuar)
      {
          _count++;
          _output = '<tr id="row_' + _count + '">';
          _output += '<td style="display: none;">' + _count + ' <input type="hidden" name="hidden_codigo[]" id="codigo' + _count + '" value="' + _count + '" /></td>';                
          _output += '<td>' + _producto + ' <input type="hidden" name="hidden_producto[]" id="txtProducto' + _count + '" value="' + _producto + '" /></td>';
          _output += '<td class="text-center">' + _estado + ' <input type="hidden" name="hidden_estado[]" id="txtEsTado' + _count + '" value="' + _estado + '" /></td>';
          _output += '<td><div class="text-center"><div class="btn-group">'
          _output += '<button type="button" name="btnEditCon" class="btn btn-outline-success btn-sm ml-3 btnCatPro" id="' + _count + '"><i class="fa fa-upload"></i></button>';
          _output += '<button type="button" name="btnEditCon" class="btn btn-outline-info btn-sm ml-3 btnEditPro" id="' + _count + '"><i class="fa fa-pencil-square-o"></i></button>';
          _output += '<button type="button" name="btnDeleteCon" class="btn btn-outline-danger btn-sm ml-3 btnDeletePro" id="' + _count + '"><i class="fa fa-trash-o"></i></button></div></div></td>';
          _output += '</tr>';
          
          $('#tblproducto').append(_output);

          _objeto = {
              arrycodigo : parseInt(_count),
              arryproducto : _producto,
              arryestado : _estado,
          }

          _resultpro.push(_objeto);   
          $('#txtProducto').val('');
          $('#txtDescripcion').val('');                  
          
      }   

  });

  //Catalogo-Producto-Modal

  $(document).on("click",".btnCatPro",function(){
    $("#formCatalogo").trigger("reset"); 
    row_id = $(this).attr("id");
    _produc = $('#txtProducto' + row_id + '').val();
    _tipoSave = 'save';


    _newproducto = $('#txtProductoMo').val(_produc);
    _codigocat = $('txtCodigoMo').val();
    _catalogo = $('txtCatalogoMo').val();
    _estadocat = 'Activo';
    
    if(_estadocat == "Activo"){
        $("#chkEstado").prop("checked", true);
        $("#lblEstado").text("Activo");
    }else{
        $("#chkEstado").prop("checked", false);
        $("#lblEstado").text("Inactivo");
    }
   

    $('#hidden_row_id').val(row_id);
    $("#header").css("background-color","#183456");
    $("#header").css("color","white");
    $(".modal-title").text("Agregar Catalogo");       
    $("#btnAgregar").text("Agregar");
    $("#modalCATALOGO").modal("show");

});

$("#chkEstado").click(function(){
    _checked = $("#chkEstado").is(":checked");
    if(_checked){
        $("#lblEstado").text("Activo");
        _estado = 'Activo';
    }else{
        $("#lblEstado").text("Inactivo");
        _estado = 'Inactivo';
    }
});

//agregar -catalogo-modal
$('#btnAddCatalogo').click(function(){

    _newproducto = $('#txtProductoMo').val(_produc);
    _codigocat = $('txtCodigoMo').val();
    _catalogo = $('txtCatalogoMo').val();
    _estadocat = 'Activo';
    _continuar = true;

    alert(_codigocat);

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
          if(item.arrycodigocat.toUpperCase() == _codigocat.toUpperCase())
          {                        
              mensajesalertify("Producto ya Existe..!","E","bottom-center",5); 
              _continuar = false;
              return false;
          }else{
              _continuar = true;
          }
      });

      if(_continuar)
      {
          _count++;
          _output = '<tr id="row_' + _count + '">';
          _output += '<td style="display: none;">' + _count + ' <input type="hidden" name="hidden_codigo[]" id="codigo' + _count + '" value="' + _count + '" /></td>';                
          _output += '<td>' + _newproducto + ' <input type="hidden" name="hidden_producto[]" id="txtProducto' + _count + '" value="' + _newproducto + '" /></td>';
          _output += '<td class="text-center">' + _codigocat + ' <input type="hidden" name="hidden_estado[]" id="txtEsTado' + _count + '" value="' + _codigocat + '" /></td>';
          _output += '<td class="text-center">' + _catalogo + ' <input type="hidden" name="hidden_estado[]" id="txtEsTado' + _count + '" value="' + _catalogo + '" /></td>';
          _output += '<td class="text-center">' + _estadocat + ' <input type="hidden" name="hidden_estado[]" id="txtEsTado' + _count + '" value="' + _estadocat + '" /></td>';
          _output += '<td><div class="text-center"><div class="btn-group">'
          _output += '<button type="button" name="btnEditCon" class="btn btn-outline-info btn-sm ml-3 btnEditPro" id="' + _count + '"><i class="fa fa-pencil-square-o"></i></button>';
          _output += '<button type="button" name="btnDeleteCon" class="btn btn-outline-danger btn-sm ml-3 btnDeletePro" id="' + _count + '"><i class="fa fa-trash-o"></i></button></div></div></td>';
          _output += '</tr>';
          
          $('#tblcatalogo').append(_output);

          _objeto = {
              arrycodigo : parseInt(_count),
              arryproductocat : _newproducto,
              arrycodigocat : _codigocat,
              arrycatalogo : _catalogo,
              arryestado : _estadocat,
          }

          _resultcat.push(_objeto);
          $("#modalCATALOGO").modal("hide");   
                        
          
      }   

  });



     //Agencias
    $('#btnAgencia').click(function(){

      _agencia = $('#txtAgencia').val();
      _codigo = $('#txtCodigo').val();
      _cbosucursal = $('#cboSucursal').val();
      _sucursal =$("#cboSucursal option:selected").text(); 
      _cbozona = $('#cboZona').val();     
      _zona =$("#cboZona option:selected").text();
      _estado = 'Activo';
      _continuar = true;

      if(_codigo == '')
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
              _continuar = false;
              return false;
          }else{
              _continuar = true;
          }
      });

      if(_continuar)
      {
          _count++;
          _output = '<tr id="row_' + _count + '">';
          _output += '<td style="display: none;">' + _count + ' <input type="hidden" name="hidden_codigo[]" id="codigo' + _count + '" value="' + _count + '" /></td>';                
          _output += '<td>' + _agencia + ' <input type="hidden" name="hidden_agencia[]" id="txtAgencia' + _count + '" value="' + _agencia + '" /></td>';
          _output += '<td class="text-center">' + _codigo + ' <input type="hidden" name="hidden_codigo[]" id="txtCodigo' + _count + '" value="' + _codigo + '" /></td>';
          _output += '<td class="text-center">' + _sucursal + ' <input type="hidden" name="hidden_sucursal[]" id="cboSucursal' + _count + '" value="' + _sucursal + '" /></td>';
          _output += '<td class="text-center">' + _zona + ' <input type="hidden" name="hidden_zona[]" id="cboZona' + _count + '" value="' + _zona + '" /></td>';
          _output += '<td class="text-center">' + _estado + ' <input type="hidden" name="hidden_email1[]" id="txtEstado' + _count + '" value="' + _estado + '" /></td>';
          _output += '<td><div class="text-center"><div class="btn-group">'
          _output += '<button type="button" name="btnEdit" class="btn btn-outline-info btn-sm ml-3 btnEditAgencia" id="' + _count + '"><i class="fa fa-pencil-square-o"></i></button>';
          _output += '<button type="button" name="btnDelete" class="btn btn-outline-danger btn-sm ml-3 btnDeleteAgencia" id="' + _count + '"><i class="fa fa-trash-o"></i></button></div></div></td>';
          _output += '</tr>';
          
          $('#tblagencia').append(_output);

          _objeto = {
              arrycodigo : parseInt(_count),
              arryagencia : _agencia,
              arrycodigo : _codigo,
              arrysucursal : _sucursal,
              arryzona : _zona,
              arryestado : _estado,
          }

          _resultage.push(_objeto);   
          $('#txtAgencia').val('');
          $('#txtCodigo').val('');
          $('#_cbosucursal').val('');
          $('#_cbozona').val('');                    
          
      }   
    

    });




    $('#btnSave').click(function(){

      _cedente = $('#txtCedente').val();

      //  if(_opcaccion == '0')
      //  {
      //   mensajesalertify("Seleccione Provincia..!","W","top-center",5);
      //   return;
      //  }

      if(_cedente == '')
      {
          mensajesalertify("Ingrese Cendente..!","W","top-center",5);
          return;
      } 
      

    });


});