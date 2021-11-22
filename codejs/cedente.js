$(document).ready(function(){

    var _count = 0,_objeto, _continuar,_opcaccion, _cbociudad, _cboid,_cedente, _cbocargo, _ext,_celular,_result = [], _cargo,
    _codigo,_agencia,_cbosucursal,_sucursal,_zona,_estado;

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
      
      $.each(_result,function(i,item)
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
          _output += '<td class="text-center">' + _celular + ' <input type="hidden" name="hidden_fax[]" id="txtFax' + _count + '" value="' + _celular + '" /></td>';
          _output += '<td class="text-center">' + _ext + ' <input type="hidden" name="hidden_celular[]" id="txtCelular' + _count + '" value="' + _ext + '" /></td>';
          _output += '<td class="text-center">' + _email1 + ' <input type="hidden" name="hidden_email1[]" id="txtEmail1' + _count + '" value="' + _email1 + '" /></td>';
          _output += '<td><div class="text-center"><div class="btn-group">'
          _output += '<button type="button" name="btnEditCon" class="btn btn-outline-info btn-sm ml-3 btnEditCon" id="' + _count + '"><i class="fa fa-pencil-square-o"></i></button>';
          _output += '<button type="button" name="btnDeleteCon" class="btn btn-outline-danger btn-sm ml-3 btnDeleteCon" id="' + _count + '"><i class="fa fa-trash-o"></i></button></div></div></td>';
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

          _result.push(_objeto);   
          $('#txtContacto').val('');
          $('#cboCargo').val('');
          $('#txtExt').val('');
          $('#txtCelular').val('');
          $('#txtEmail1').val('');                      
          
      }   
    

    });

    $(document).on("click",".btnEditCon",function(){
      $("#formContacto").trigger("reset"); 
      row_id = $(this).attr("id");
      _norden = $('#orden' + row_id + '').val();
      _detalleold = $('#txtDetalle' + row_id + '').val();
      _valorvold = $('#txtValorv' + row_id + '').val();
      _valoriold = $('#txtValori' + row_id + '').val();
      _estadoold = $('#txtEstado' + row_id + '').val();
      _deshabilitar = $('#btnUp' + row_id + '').attr('disabled');        
      _tipoSave = 'edit';


      $('#txtDetalle').val(_detalleold);
      $('#txtValorv').val(_valorvold);
      $('#txtValori').val(_valoriold == 0 ? '': _valoriold);
      $('#hidden_row_id').val(row_id);
      $("#header").css("background-color","#183456");
      $("#header").css("color","white");
      $(".modal-title").text("Editar Parametro");       
      $("#btnAgregar").text("Modificar");
      $("#modalPARAMETER").modal("show");
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
      
      $.each(_result,function(i,item)
      {
          if(item.arryagencia.toUpperCase() == _contacto.toUpperCase())
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

          _result.push(_objeto);   
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