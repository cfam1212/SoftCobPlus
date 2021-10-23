$(document).ready(function(){
    
    var _error_parametro = '', _tipoSave = 'add', _count = 0, _result = [], _continuar = true, _mensaje, _fila, _data,
    _id, _detalle, _valorv, _valori, _detalleold, _output, _seguir, _valoriold, _norden, _valorvold, _valoriold,
    _deshabilitar, id_now, _ordennow, _checked, _detallenow, _valorvnow, _valorinow, _estadonow, _disablenow, id_ant,
    _ordenant, _detalleant, _valorvant, _valoriant, _estadoant, _disableant, _resultado;

    // $('#parameter_dialog').dialog({
    //     autoOpen:false,
    //     w_idth:400
    // });
    
    _mensaje = $('input#mensaje').val();

    if(_mensaje != ''){

        mensajesalertify(_mensaje,"E","bottom-right",5);
    }

    $('#btnNuevo').click(function(){        
        //$.redirect('parametronew.php', {'mensaje': ''});
        $.redirect('parametronew.php');
    });

    $(document).on("click","#btnEditar",function(){        
        _fila = $(this).closest("tr");
        _data = $('#table_data')._dataTable().fnGet_data(_fila);
        _id = _data[0];
        $.redirect('parametroedit.php', {'id': _id});
    });

    $(document).on("click","#btnEliminar",function(){        
        _fila = $(this).closest("tr");
        _data = $('#table_data')._dataTable().fnGet_data(_fila);
        _id = _data[0];
        
        //$.redirect('parametroedit.php', {'id': _id});
    });

    // $('#btnNext').click(function(){
    //     if($.trim($('#parametro').val()).length == 0)
    //     {
    //         _error_parametro = 'Nombre del Parámetro es requer_ido';
    //         $('#error_parametro').text(_error_parametro);
    //         $('#parametro').addClass('has-error');
    //     }else{
    //         _error_parametro = '';
    //         $('#error_parametro').text(_error_parametro);
    //         $('#parametro').removeClass('has-error');
    //     }

    //     if(_error_parametro != '')
    //     {
    //         return false;
    //     }else
    //     {
    //         $('#list_parametrocab').removeClass('active active_tab1');
    //         $('#list_parametrocab').removeAttr('href _data-toggle');
    //         $('#parametrocab').removeClass('active');
    //         $('#list_parametrocab').addClass('inactive_tab1');
    //         $('#list_parametrodet').removeClass('inactive_tab1');
    //         $('#list_parametrodet').addClass('active_tab1 active');
    //         $('#list_parametrodet').attr('href', '#parametrodet');
    //         $('#list_parametrodet').attr('_data-toggle', 'tab');
    //         $('#parametrodet').addClass('active in');
    //     }
    // });

    $('#btnPrev1').click(function(){
        $.redirect('parametroadmin.php');
    });

    // $('#btnPrev2').click(function(){
    //     $('#list_parametrodet').removeClass('active active_tab1');
    //     $('#list_parametrodet').removeAttr('href _data-toggle');
    //     $('#parametrodet').removeClass('active in');
    //     $('#list_parametrodet').addClass('inactive_tab1');
    //     $('#list_parametrocab').removeClass('inactive_tab1');
    //     $('#list_parametrocab').addClass('active_tab1 active');
    //     $('#list_parametrocab').attr('href', '#parametrocab');
    //     $('#list_parametrocab').attr('_data-toggle', 'tab');
    //     $('#parametrocab').addClass('active in');
    // });

    $("#btnAdd").click(function(){        
        $("#formParam").trigger("reset");
        $("#divcheck").hide();
        $("#header").css("background-color","#183456");
        $("#header").css("color","white");
        $(".modal-title").text("Nuevo Parametro");  
        $("#btnAgregar").text("Agregar");
        $("#modalPARAMETER").modal("show");
        _tipoSave = 'add';
        _estado = 'Activo';
    });    

    $('#btnAgregar').click(function(){
        if($.trim($('#txtDetalle').val()).length == 0)
        {
           
            mensajesalertify("Ingrese Detalle del Parámetro..!","W","top-center",5);
            return false;
        }

        if($.trim($('#txtValorv').val()).length == 0 && $.trim($('#txtValori').val()).length == 0 )
        {
            
            mensajesalertify("Ingrese Valor Texto o Valor Entero..!","W","top-center",5);
            return false;
        }

        if($.trim($('#txtValorv').val()).length > 0 && $.trim($('#txtValori').val()).length > 0 )
        {
          
            mensajesalertify("Ingrese Solo Valor Texto o Valor Entero..!","E","bottom-center",5);
            return false;
        }

        _detalle = $.trim($('#txtDetalle').val());
        _valorv = $.trim($('#txtValorv').val());
        
        if($.trim($('#txtValori').val()).length == 0){
            _valori = 0;
        }else{
            _valori = $.trim($('#txtValori').val());
        }

        if(_tipoSave == 'add')
        {
            $.each(_result,function(i,item){
                if(item.arrydetalle.toUpperCase() == _detalle.toUpperCase())
                {                  
                    mensajesalertify("Nombre del Parámetro ya Existe..!","E","bottom-center",5);                    
                    _continuar = false;
                    return false;
                }else{
                    $.each(_result,function(i,item){
                        if(_valori == 0)
                        {
                            if(item.arryvalorv.toUpperCase() == _valorv.toUpperCase())
                            {                               
                                mensajesalertify("Valor Texto de Parámetro ya Existe..!","E","bottom-center",5);    
                                _continuar = false;
                                return false;
                            }else{
                                _continuar = true;
                            }
                        }else
                        {
                            if(item.arryvalori == _valori)
                            {                               
                                mensajesalertify("Valor Entero de Parámetro ya Existe..!","E","bottom-center",5); 
                                _continuar = false;
                                return false;
                            }else{
                                _continuar = true;
                            }                            
                        }
                    });
                }
            });

            if(_continuar){
                _count = _count + 1;
                //let _deshabilitar = ''
                if(_count == 1){
                    //_deshabilitar  = 'disabled="disabled"';
                    _deshabilitar  = 'disabled';
                }else{
                    _deshabilitar = '" "';
                }
                _output = '<tr id="row_' + _count + '">';
                _output += '<td style="display: none;">' + _count + ' <input type="hidden" name="hidden_orden[]" id="orden' + _count + '" value="' + _count + '" /></td>';                
                _output += '<td>' + _detalle + ' <input type="hidden" name="hidden_detalle[]" id="txtDetalle' + _count + '" value="' + _detalle + '" /></td>';
                _output += '<td class="text-center">' + _valorv + ' <input type="hidden" name="hidden_valorv[]" id="txtValorv' +_count + '" value="' + _valorv + '" /></td>';
                _output += '<td class="text-center">' + _valori + ' <input type="hidden" name="hidden_valori[]" id="txtValori' + _count + '" value="' + _valori + '" /></td>';
                _output += '<td class="text-center">' + _estado + ' <input type="hidden" name="hidden_estado[]" id="txtEstado' + _count + '" value="' + _estado + '" /></td>';
                _output += '<td><div class="text-center"><div class="btn-group">'
                _output += '<button type="button" name="subirnivel" class="btn btn-outline-primary btn-sm btnUp" ' + _deshabilitar + ' id="btnUp' + _count + '"><i class="fa fa-arrow-up"></i></button>';
                _output += '<button type="button" name="btnEdit" class="btn btn-outline-info btn-sm ml-3 btnEdit" id="' + _count + '"><i class="fa fa-pencil-square-o"></i></button>';
                _output += '<button type="button" name="btnDelete" class="btn btn-outline-danger btn-sm ml-3 btnDelete" id="' + _count + '"><i class="fa fa-trash-o"></i></button></div></div></td>';
                _output += '</tr>';
                
                $('#tblparameter').append(_output);

                _objeto = {
                    arry_id : _count,
                    arrydetalle : _detalle,
                    arryvalorv : _valorv,
                    arryvalori : _valori,
                    arryestado : _estado,
                    arrydisable : _deshabilitar
                }

                _result.push(_objeto);
                $("#modalPARAMETER").modal("hide");
            }
        }
        else
        {
            _continuar = false, _seguir = false;
            if(_detalleold.toUpperCase() != _detalle.toUpperCase())
            {
                $.each(_result,function(i,item)
                {
                    if(item.arrydetalle.toUpperCase() == _detalle.toUpperCase())
                    {                        
                        mensajesalertify("Nombre del Parámetro ya Existe..!","E","bottom-center",5); 
                        _continuar = false;
                        return false;
                    }else{
                        _continuar = true;
                    }
                });
            }else _continuar = true;

            if(_continuar)
            {
                if(_valori != 0)
                {
                    if(_valoriold != _valori)
                    {
                        $.each(_result,function(i,item)
                        {
                            if(item.arryvalori == _valori)
                            {
                             
                                mensajesalertify("Valor Entero de Parámetro ya Existe..!","E","bottom-center",5);                     
                                _seguir = false;
                                return false;
                            }else{
                                seguir = true;
                            }
                        });                        
                    }
                }else{
                    if(_valorvold.toUpperCase() != _valorv.toUpperCase())
                    {
                        $.each(_result,function(i,item)
                        {
                            if(item.arryvalorv.toUpperCase() == _valorv.toUpperCase())
                            {                              
                                mensajesalertify("Valor Texto de Parámetro ya Existe..!","E","bottom-center",5);                     
                                _seguir = false;
                                return false;
                            }else{
                                _seguir = true;
                            }
                        });
                    }else _seguir = true;    
                }
            }

            if(_seguir)
            {
                // row_id = $('#hidden_row_id').val();
                // _output = '<td style="display: none;">' + _norden + ' <input type="hidden" name="hidden_orden[]" id="orden' + row_id + '" value="'+ row_id + '" /></td>';
                // _output += '<td>' + _detalle + ' <input type="hidden" name="hidden_detalle[]" id="txtDetalle' + row_id + '" value="' + _detalle + '" /></td>';
                // _output += '<td>' + _valorv + ' <input type="hidden" name="hidden_valorv[]" id="txtValorv' + row_id + '" value="'+ _valorv + '" /></td>';
                // _output += '<td>' + _valori + ' <input type="hidden" name="hidden_valori[]" id="txtValori' + row_id + '" value="'+ _valori + '" /></td>';
                // _output += '<td>' + _estado + ' <input type="hidden" name="hidden_estado[]" id="txtEstado' + row_id + '" value="'+ _estado + '" /></td>';
    
                // _output += '<td><div class="text-center"><div class="btn-group">'
                // _output += '<button type="button" name="btnUp" class="btn btn-outline-primary btn-sm btnUp" ' + _deshabilitar + ' _id="btnUp' + row_id + '"><i class="fa fa-arrow-up"></i></button>';
                // _output += '<button type="button" name="btnEdit" class="btn btn-outline-info btn-sm ml-3 btnEdit" _id="' + row_id + '"><i class="fa fa-pencil-square-o"></i></button>';
                // _output += '<button type="button" name="btnDelete" class="btn btn-outline-danger btn-sm ml-3 btnDelete" _id="'+ row_id + '"><i class="fa fa-trash-o"></i></button></div></div></td>';                
               
                // $('#row_'+row_id+'').html(_output);

                // _objIndex = _result.findIndex((obj => obj.arry_id == row_id));
                // _result[_objIndex].arrydetalle = _detalle;
                // _result[_objIndex].arryvalorv = _valorv;
                // _result[_objIndex].arryvalori = _valori;
                // $("#modalPARAMETER").modal("hide");

                FunRemoveItemFromArr(_result, _detalleold);

                //$('#row_' + row_id + '').remove();                
                
                // _output = '<tr id="row_' + _norden + '">';
                // _output += '<td style="display: none;">' + _norden + ' <input type="hidden" name="hidden_orden[]" id="orden' + _norden + '" value="' + _norden + '" /></td>';                
                // _output += '<td>' + _detalle + ' <input type="hidden" name="hidden_detalle[]" id="txtDetalle' + _norden + '" value="' + _detalle + '" /></td>';
                // _output += '<td class="text-center">' + _valorv + ' <input type="hidden" name="hidden_valorv[]" id="txtValorv' +_norden + '" value="' + _valorv + '" /></td>';
                // _output += '<td class="text-center">' + _valori + ' <input type="hidden" name="hidden_valori[]" id="txtValori' + _norden + '" value="' + _valori + '" /></td>';
                // _output += '<td class="text-center">' + _estado + ' <input type="hidden" name="hidden_estado[]" id="txtEstado' + _norden + '" value="' + _estado + '" /></td>';
                // _output += '<td><div class="text-center"><div class="btn-group">'
                // _output += '<button type="button" name="subirnivel" class="btn btn-outline-primary btn-sm btnUp" ' + _deshabilitar + ' id="btnUp' + _norden + '"><i class="fa fa-arrow-up"></i></button>';
                // _output += '<button type="button" name="btnEdit" class="btn btn-outline-info btn-sm ml-3 btnEdit" id="' + _norden + '"><i class="fa fa-pencil-square-o"></i></button>';
                // _output += '<button type="button" name="btnDelete" class="btn btn-outline-danger btn-sm ml-3 btnDelete" id="' + _norden + '"><i class="fa fa-trash-o"></i></button></div></div></td>';
                // _output += '</tr>';
                                
                //$('#tblparameter').append(_output);

                _objeto = {
                    arry_id : parseInt(_norden),
                    arrydetalle : _detalle,
                    arryvalorv : _valorv,
                    arryvalori : _valori,
                    arryestado : _estado,
                    arrydisable : _deshabilitar
                }

                _result.push(_objeto);
                $("#modalPARAMETER").modal("hide");

                //console.log(_result.sort((a,b) => a.arry_id - b.arry_id));
                
               $("tbody").children().remove();

                FunReorganizarEdit(_result.sort((a,b) => a.arry_id - b.arry_id));            
                
            }
        }
    });

    $(document).on("click",".btnEdit",function(){
        $("#formParam").trigger("reset"); 
        row_id = $(this).attr("id");
        _norden = $('#orden' + row_id + '').val();
        _detalleold = $('#txtDetalle' + row_id + '').val();
        _valorvold = $('#txtValorv' + row_id + '').val();
        _valoriold = $('#txtValori' + row_id + '').val();
        _estadoold = $('#txtEstado' + row_id + '').val();
        _deshabilitar = $('#btnUp' + row_id + '').attr('disabled');        
        _tipoSave = 'edit';

        if(_estadoold == "Activo"){
            $("#chkEstado").prop("checked", true);
            $("#lblEstado").text("Activo");
        }else{
            $("#chkEstado").prop("checked", false);
            $("#lblEstado").text("Inactivo");
        }

        $('#txtDetalle').val(_detalleold);
        $('#txtValorv').val(_valorvold);
        $('#txtValori').val(_valoriold == 0 ? '': _valoriold);
        $('#hidden_row_id').val(row_id);
        $("#header").css("background-color","#183456");
        $("#header").css("color","white");
        $(".modal-title").text("Editar Parametro");
        $("#divcheck").show();
        $("#btnAgregar").text("Modificar");
        $("#modalPARAMETER").modal("show");
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

    $(document).on("click",".btnDelete",function(){
        row_id = $(this).attr("id");
        _detalle = $('#txtDetalle' + row_id + '').val();
        Swal.fire({
            title: 'Está Seguro de Borrar ' + _detalle ,
            text: 'El registro será eliminado..',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Eliminar',
            showLoaderOnConfirm: true,
            preConfirm: function() {
                return new Promise(function(resolve) {
                    Swal.close();                    
                    FunRemoveItemFromArr( _result, _detalle );
                    $('#row_' + row_id + '').remove();
                    _count--;
                    FunReorganizarOrder(_result);
                });
              }
        });
    });

    // function FunInactivaButton() 
    // {
    //     x = document.getElementsByClassName("btnUp");
    //     console.log(x);
    //     id = $("#" + x[0].id);
    //     alert(id);
    //     $("#"+x[0].id).prop('disabled',true);
    // }
    
    function FunRemoveItemFromArr(arr, deta)
    {
        $.each(arr,function(i,item){
            if(item.arrydetalle == deta)
            {
                arr.splice(i, 1);
                return false;
            }else{
                continuar = true;
            }
        });        
    };

    function FunReorganizarOrder(arr)
    {
        otroval = 0;
        $.each(arr,function(i,item){
            otroval = otroval + 1; 
            FunOrderDelete(otroval,item.arry_id,item.arrydetalle,item.arryvalorv,item.arryvalori,item.arryestado);
            item['arry_id'] = parseInt(otroval);
        });
        
        FunCambiar_id();
    }

    function FunCambiar_id()
    {
        $("#tblparameter tbody tr").each(function (index) {
            _id = $(this).attr('id');
            underScoreIndex = _id.indexOf('_');
            _id = _id.substring(0,underScoreIndex+1)+(parseInt(index)+1);
            $(this).attr('id',_id);
        });        
    }    

    function FunReorganizarEdit(arr)
    {        
        $.each(arr,function(i,item){            
            FunOrderEdit(item.arry_id,item.arrydetalle,item.arryvalorv,item.arryvalori,item.arryestado,item.arrydisable);
        });

    }    

    $(document).on("click",".btnUp",function(){

        row_id = $(this).attr("id");

        id_now = $('#orden' + row_id.substr(5) + '').val();
        console.log(id_now);
        _ordennow = $('#orden' + id_now + '').val();
        _detallenow = $('#txtDetalle' + id_now + '').val();
        _valorvnow = $('#txtValorv' + id_now + '').val();
        _valorinow = $('#txtValori' + id_now + '').val();
        _estadonow = $('#txtEstado' + id_now + '').val();
        _disablenow = $('#btnUp' + id_now + '').attr('disabled');

        id_ant = id_now - 1;
        _ordenant = $('#orden' + id_ant + '').val();
        _detalleant = $('#txtDetalle' + id_ant + '').val();       
        _valorvant = $('#txtValorv' + id_ant + '').val();
        _valoriant = $('#txtValori' + id_ant + '').val();
        _estadoant = $('#txtEstado' + id_ant + '').val();
        _disableant = $('#btnUp' + id_ant + '').attr('disabled');

        alert(_detallenow);
        FunOrderFirts(id_ant,_ordenant,_detallenow,_valorvnow,_valorinow,_estadonow,_disableant);
        FunOrderLast(id_now,_ordennow,_detalleant,_valorvant,_valoriant,_estadoant,_disablenow);
        
    });

    function FunOrderFirts(rowid,orden,detalle,valorv,valori,estado,disable)
    {
        if(disable == 'disabled'){
            _deshabilitar  = 'disabled="disabled"';
        }
        else{
            _deshabilitar = ''
        }

        _resultado = _result.find(d => d.arrydetalle == detalle);
        _resultado['arry_id'] = parseInt(orden);

        _output = '<td style="display: none;">' + orden + ' <input type="hidden" name="hidden_orden[]" id="orden' + rowid + '" value="'+ rowid + '" /></td>';
        _output += '<td>' + detalle + ' <input type="hidden" name="hidden_detalle[]" id="txtDetalle' + rowid + '" value="' + detalle + '" /></td>';
        _output += '<td class="text-center">' + valorv + ' <input type="hidden" name="hidden_valorv[]" id="txtValorv' + rowid + '" value="'+ valorv + '" /></td>';
        _output += '<td class="text-center">' + valori + ' <input type="hidden" name="hidden_valori[]" id="txtValori' + rowid + '" value="'+ valori + '" /></td>';
        _output += '<td class="text-center">' + estado + ' <input type="hidden" name="hidden_estado[]" id="txtEstado' + rowid + '" value="'+ estado + '" /></td>';
        _output += '<td><div class="text-center"><div class="btn-group">'
        _output += '<button type="button" name="btnUp" class="btn btn-outline-primary btn-sm btnUp" ' + _deshabilitar + ' id="btnUp' + row_id + '"><i class="fa fa-arrow-up"></i></button>';
        _output += '<button type="button" name="btnEdit" class="btn btn-outline-info btn-sm ml-3 btnEdit" id="' + rowid + '"><i class="fa fa-pencil-square-o"></i></button>';
        _output += '<button type="button" name="btnDelete" class="btn btn-outline-danger btn-sm ml-3 btnDelete" id="'+ rowid + '"><i class="fa fa-trash-o"></i></button></div></div></td>';
        $('#row_' + rowid + '').html(_output);
    }

    function FunOrderLast(rowid,orden,detalle,valorv,valori,estado,disable)
    {
        if(disable == 'disabled'){
            _deshabilitar  = 'disabled="disabled"';
        }
        else{
            _deshabilitar = ''
        }

        _resultado = _result.find(d => d.arrydetalle == detalle);
        _resultado['arry_id'] = parseInt(orden);

        _output = '<td style="display: none;">' + orden + ' <input type="hidden" name="hidden_orden[]" id="orden' + rowid + '" value="'+ rowid + '" /></td>';
        _output += '<td>' + detalle + ' <input type="hidden" name="hidden_detalle[]" id="txtDetalle' + rowid + '" value="' + detalle + '" /></td>';
        _output += '<td class="text-center">' + valorv + ' <input type="hidden" name="hidden_valorv[]" id="txtValorv' + rowid + '" value="'+ valorv + '" /></td>';
        _output += '<td class="text-center">' + valori + ' <input type="hidden" name="hidden_valori[]" id="txtValori' + rowid + '" value="'+ valori + '" /></td>';
        _output += '<td class="text-center">' + estado + ' <input type="hidden" name="hidden_estado[]" id="txtEstado' + rowid + '" value="'+ estado + '" /></td>';
        _output += '<td><div class="text-center"><div class="btn-group">'
        _output += '<button type="button" name="btnUp" class="btn btn-outline-primary btn-sm btnUp" ' + _deshabilitar + ' id="btnUp' + rowid + '"><i class="fa fa-arrow-up"></i></button>';
        _output += '<button type="button" name="btnEdit" class="btn btn-outline-info btn-sm ml-3 btnEdit" id="' + rowid + '"><i class="fa fa-pencil-square-o"></i></button>';
        _output += '<button type="button" name="btnDelete" class="btn btn-outline-danger btn-sm ml-3 btnDelete" id="'+ rowid + '"><i class="fa fa-trash-o"></i></button></div></div></td>';
        $('#row_' + rowid + '').html(_output);
    }

    function FunOrderDelete(ordenx,rowmod,detalle,valorv,valori,estado)
    {        
        if(ordenx == 1){
            _deshabilitar  = 'disabled="disabled"';
        }else{
            _deshabilitar = '';
        }

        _output = '<td style="display: none;">' + ordenx + ' <input type="hidden" name="hidden_orden[]" id="orden' + ordenx + '" value="'+ ordenx + '" /></td>';
        _output += '<td>' + detalle + ' <input type="hidden" name="hidden_detalle[]" id="txtDetalle' + ordenx + '" value="' + detalle + '" /></td>';
        _output += '<td class="text-center">' + valorv + ' <input type="hidden" name="hidden_valorv[]" id="txtValorv' + ordenx + '" value="'+ valorv + '" /></td>';
        _output += '<td class="text-center">' + valori + ' <input type="hidden" name="hidden_valori[]" id="txtValori' + ordenx + '" value="'+ valori + '" /></td>';
        _output += '<td class="text-center">' + estado + ' <input type="hidden" name="hidden_estado[]" id="txtEstado' + ordenx + '" value="'+ estado + '" /></td>';
        _output += '<td><div class="text-center"><div class="btn-group">'
        _output += '<button type="button" name="btnUp" class="btn btn-outline-primary btn-sm btnUp" ' + _deshabilitar + ' id="btnUp' + ordenx + '"><i class="fa fa-arrow-up"></i></button>';
        _output += '<button type="button" name="btnEdit" class="btn btn-outline-info btn-sm ml-3 btnEdit" id="' + ordenx + '"><i class="fa fa-pencil-square-o"></i></button>';
        _output += '<button type="button" name="btnDelete" class="btn btn-outline-danger btn-sm ml-3 btnDelete" id="'+ ordenx + '"><i class="fa fa-trash-o"></i></button></div></div></td>';
        $('#row_' + rowmod + '').html(_output);
    }

    function FunOrderEdit(norden,detalle,valorv,valori,estado,disable)
    {
        _output = '<tr id="row_' + norden + '">';
        _output += '<td style="display: none;">' + norden + ' <input type="hidden" name="hidden_orden[]" id="orden' + norden + '" value="' + norden + '" /></td>';                
        _output += '<td>' + detalle + ' <input type="hidden" name="hidden_detalle[]" id="txtDetalle' + norden + '" value="' + detalle + '" /></td>';
        _output += '<td class="text-center">' + valorv + ' <input type="hidden" name="hidden_valorv[]" id="txtValorv' + norden + '" value="' + valorv + '" /></td>';
        _output += '<td class="text-center">' + valori + ' <input type="hidden" name="hidden_valori[]" id="txtValori' + norden + '" value="' + valori + '" /></td>';
        _output += '<td class="text-center">' + estado + ' <input type="hidden" name="hidden_estado[]" id="txtEstado' + norden + '" value="' + estado + '" /></td>';
        _output += '<td><div class="text-center"><div class="btn-group">'
        _output += '<button type="button" name="subirnivel" class="btn btn-outline-primary btn-sm btnUp" ' + disable + ' id="btnUp' + norden + '"><i class="fa fa-arrow-up"></i></button>';
        _output += '<button type="button" name="btnEdit" class="btn btn-outline-info btn-sm ml-3 btnEdit" id="' + norden + '"><i class="fa fa-pencil-square-o"></i></button>';
        _output += '<button type="button" name="btnDelete" class="btn btn-outline-danger btn-sm ml-3 btnDelete" id="' + norden + '"><i class="fa fa-trash-o"></i></button></div></div></td>';
        _output += '</tr>';
                        
        $('#tblparameter').append(_output);        
    }

    $('#btnSave').click(function(){
        nomparametro = $.trim($("#txtParametro").val());
        detalle = $.trim($("#txtDescripcion").val());

        if(nomparametro == ''){
          
            mensajesalertify("Ingrese Nombre del  Parámetro..!","W","top-center",5);
            return false;            
        }

        if(_count == 0)
        {
         
            mensajesalertify("Ingrese al menos un Detalle..!","W","top-center",5);
            return false;
        }

        $.ajax({
            url: "../../db/parametrocrud.php",
            type: "POST",
            _dataType: "json",
            _data: {nomparametro:nomparametro, detalle:detalle, result:result, estado:'Activo', _id:0, opcion:0},            
            success: function(_data){
                if(_data == 'OK-Insert'){
                    $.redirect('parametroadmin.php', {'mensaje': 'Grabado con Exito..!'}); 
                }else{
                  
                    mensajesalertify("Nombre del Parámetro ya Existe..!","E","bottom-right",5);
                }                
            },
            error: function (error) {
                console.log(error);
            }                            
        }); 

        // $("#tblparameter tbody tr").each(function (items) {
        //     var _orden, _detalle, _valorv, _valori, _estado;
        //     //console.log($(this).closest('tr').attr('_id'));
        //     $(this).children("td").each(function (index) {
        //         switch(index){
        //             case 0:
        //                 _orden = $(this).text();
        //                 break;
        //             case 1:
        //                 _detalle = $(this).text();
        //                 break;
        //             case 2:
        //                 _valorv = $(this).text();
        //                 break;
        //             case 3:
        //                 _valori = $(this).text();
        //                 break;
        //             case 4:
        //                 _estado = $(this).text();
        //                 break;
        //         }
               
        //     });
        //     alert(_orden+' '+_detalle+' '+_valorv+' '+_valori+' '+_estado);
        // });
    });

});