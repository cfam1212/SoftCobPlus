$(document).ready(function(){
    
    var _error_parametro = '', _tipoSave = 'add', _count = 0, _result = [], _continuar = true, _mensaje, __fila, __data,
    __id, _detalle, _valorv, _valori, _detalleold, __output;

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
        __fila = $(this).closest("tr");
        __data = $('#table_data')._dataTable().fnGet_data(__fila);
        __id = __data[0];
        $.redirect('parametroedit.php', {'id': __id});
    });

    $(document).on("click","#btnEliminar",function(){        
        _fila = $(this).closest("tr");
        _data = $('#table_data')._dataTable().fnGet_data(_fila);
        _id = _data[0];
        
        //$.redirect('parametroedit.php', {'id': _id});
    });

    $('#btnNext').click(function(){
        if($.trim($('#parametro').val()).length == 0)
        {
            _error_parametro = 'Nombre del Parámetro es requer_ido';
            $('#error_parametro').text(_error_parametro);
            $('#parametro').addClass('has-error');
        }else{
            error_parametro = '';
            $('#error_parametro').text(_error_parametro);
            $('#parametro').removeClass('has-error');
        }

        if(_error_parametro != '')
        {
            return false;
        }else
        {
            $('#list_parametrocab').removeClass('active active_tab1');
            $('#list_parametrocab').removeAttr('href _data-toggle');
            $('#parametrocab').removeClass('active');
            $('#list_parametrocab').addClass('inactive_tab1');
            $('#list_parametrodet').removeClass('inactive_tab1');
            $('#list_parametrodet').addClass('active_tab1 active');
            $('#list_parametrodet').attr('href', '#parametrodet');
            $('#list_parametrodet').attr('_data-toggle', 'tab');
            $('#parametrodet').addClass('active in');
        }
    });

    $('#btnPrev1').click(function(){
        $.redirect('parametroadmin.php');
    });

    $('#btnPrev2').click(function(){
        $('#list_parametrodet').removeClass('active active_tab1');
        $('#list_parametrodet').removeAttr('href _data-toggle');
        $('#parametrodet').removeClass('active in');
        $('#list_parametrodet').addClass('inactive_tab1');
        $('#list_parametrocab').removeClass('inactive_tab1');
        $('#list_parametrocab').addClass('active_tab1 active');
        $('#list_parametrocab').attr('href', '#parametrocab');
        $('#list_parametrocab').attr('_data-toggle', 'tab');
        $('#parametrocab').addClass('active in');
    });

    $("#btnAdd").click(function(){        
        $("#formParam").trigger("reset");
        $("#divcheck").hide();
        $("#header").css("background-color","#6491C2");
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
            Swal.fire({
                title: 'Información',
                type:'warning',
                text: 'Ingrese Detalle del Parámetro..!',
                showCloseButton: true,
            });
            return false;
        }

        if($.trim($('#txtValorv').val()).length == 0 && $.trim($('#txtValori').val()).length == 0 )
        {
            Swal.fire({
                title: 'Información',
                type:'warning',
                text: 'Ingrese Valor Texto o Valor Entero..!',
                showCloseButton: true,
            });
            return false;
        }

        if($.trim($('#txtValorv').val()).length > 0 && $.trim($('#txtValori').val()).length > 0 )
        {
            Swal.fire({
                title: 'Información',
                type:'warning',
                text: 'Ingrese Solo Valor Texto o Valor Entero..!',
                showCloseButton: true,
            });
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
                if(item.arrydetalle.toUpperCase() == detalle.toUpperCase())
                {
                    Swal.fire({
                        title: 'Información',
                        type:'warning',
                        text: 'Nombre del Parámetro ya Existe..!'
                    });                    
                    _continuar = false;
                    return false;
                }else{
                    $.each(result,function(i,item){
                        if(_valori == 0)
                        {
                            if(item.arryvalorv.toUpperCase() == _valorv.toUpperCase())
                            {
                                Swal.fire({
                                    title: 'Información',
                                    type:'warning',
                                    text: 'Valor Texto de Parámetro ya Existe..!'
                                });
                                _continuar = false;
                                return false;
                            }else{
                                _continuar = true;
                            }
                        }else
                        {
                            if(item.arryvalori == _valori)
                            {
                                Swal.fire({
                                    title: 'Información',
                                    type:'warning',
                                    text: 'Valor Entero de Parámetro ya Existe..!'
                                });
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
                let _deshabilitar = ''
                if(_count == 1){
                    _deshabilitar  = 'disabled="disabled"';
                }
                _output = '<tr id="row_' + _count + '">';
                _output += '<td style="display: none;">' + _count + ' <input type="h_idden" name="hidden_orden[]" id="orden' + _count + '" value="' + _count + '" /></td>';                
                _output += '<td>' + _detalle + ' <input type="hidden" name="hidden_detalle[]" id="detalle' + _count + '" value="' + _detalle + '" /></td>';
                _output += '<td>' + _valorv + ' <input type="hidden" name="hidden_valorv[]" id="valorv' +_count + '" value="' + _valorv + '" /></td>';
                _output += '<td>' + _valori + ' <input type="hidden" name="hidden_valori[]" id="valori' + _count + '" value="' + _valori + '" /></td>';
                _output += '<td>' + _estado + ' <input type="hidden" name="hidden_estado[]" id="estado' + _count + '" value="' + _estado + '" /></td>';
                _output += '<td><div class="text-center"><div class="btn-group">'
                _output += '<button type="button" name="subirnivel" class="btn btn-outline-primary btn-sm btnUp" ' + _deshabilitar + ' id="btnUp' + _count + '"><i class="fa fa-arrow-up"></i></button>';
                _output += '<button type="button" name="btnEdit" class="btn btn-outline-info btn-sm ml-3 btnEdit" id="' + _count + '"><i class="fa fa-file"></i></button>';
                _output += '<button type="button" name="btnDelete" class="btn btn-outline-danger btn-sm ml-3 btnDelete" id="' + _count + '"><i class="fa fa-trash"></i></button></div></div></td>';
                _output += '</tr>';
                //console.log(_output);
                
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
                    if(item.arrydetalle.toUpperCase() == detalle.toUpperCase())
                    {
                        Swal.fire({
                            title: 'Información',
                            type:'warning',
                            text: 'Nombre del Parámetro ya Existe..!'
                        });                    
                        continuar = false;
                        return false;
                    }else{
                        continuar = true;
                    }
                });
            }else continuar = true;

            if(continuar)
            {
                if(valori != 0)
                {
                    if(valoriold != valori)
                    {
                        $.each(result,function(i,item)
                        {
                            if(item.arryvalori == valori)
                            {
                                Swal.fire({
                                    title: 'Información',
                                    type:'warning',
                                    text: 'Valor Entero de Parámetro ya Existe..!'
                                });                    
                                seguir = false;
                                return false;
                            }else{
                                seguir = true;
                            }
                        });                        
                    }
                }else{
                    if(valorvold.toUpperCase() != valorv.toUpperCase())
                    {
                        $.each(result,function(i,item)
                        {
                            if(item.arryvalorv.toUpperCase() == valorv.toUpperCase())
                            {
                                Swal.fire({
                                    title: 'Información',
                                    type:'warning',
                                    text: 'Valor Texto de Parámetro ya Existe..!'
                                });                    
                                seguir = false;
                                return false;
                            }else{
                                seguir = true;
                            }
                        });
                    }else seguir = true;    
                }
            }

            if(seguir)
            {
                row_id = $('#hidden_row_id').val();
                _output = '<td style="display: none;">' + norden + ' <input type="h_idden" name="h_idden_orden[]" id="orden' + row_id + '" value="'+ row_id + '" /></td>';
                _output += '<td>' + _detalle + ' <input type="h_idden" name="h_idden_detalle[]" _id="detalle' + row_id + '" value="' + detalle + '" /></td>';
                _output += '<td>' + _valorv + ' <input type="h_idden" name="h_idden_valorv[]" _id="valorv' + row_id + '" value="'+ valorv + '" /></td>';
                _output += '<td>' + _valori + ' <input type="h_idden" name="h_idden_valori[]" _id="valori' + row_id + '" value="'+ valori + '" /></td>';
                _output += '<td>' + _estado + ' <input type="h_idden" name="h_idden_estado[]" _id="estado' + row_id + '" value="'+ estado + '" /></td>';
    
                _output += '<td><div class="text-center"><div class="btn-group">'
                _output += '<button type="button" name="btnUp" class="btn btn-outline-primary btn-sm btnUp" ' + _deshabilitar + ' _id="btnUp' + row__id + '"><i class="fas fa-arrow-up"></i></button>';
                _output += '<button type="button" name="btnEdit" class="btn btn-outline-info btn-sm ml-3 btnEdit" _id="' + row__id + '"><i class="fas fa-file"></i></button>';
                _output += '<button type="button" name="btnDelete" class="btn btn-outline-danger btn-sm ml-3 btnDelete" _id="'+ row__id + '"><i class="fas fa-trash"></i></button></div></div></td>';
                $('#row_'+row_id+'').html(_output);

                objIndex = _result.findIndex((obj => obj.arry_id == row_id));
                result[objIndex].arrydetalle = _detalle;
                result[objIndex].arryvalorv = _valorv;
                result[objIndex].arryvalori = _valori;
                $("#modalPARAMETER").modal("hide");
            }
        }
    });

    $(document).on("click",".btnEdit",function(){
        $("#formParam").trigger("reset");
        row_id = $(this).attr("_id");
        norden = $('#orden'+row_id+'').val();
        detalleold = $('#detalle'+row_id+'').val();
        valorvold = $('#valorv'+row_id+'').val();
        valoriold = $('#valori'+row_id+'').val();
        estadoold = $('#estado'+row_id+'').val();
        _deshabilitar = $('#btnUp'+row_id+'').attr('disabled');
        _tipoSave = 'edit';

        if(_estadoold == "Activo"){
            $("#chkestado").prop("checked", true);
            $("#lblestado").text("Activo");
        }else{
            $("#chkestado").prop("checked", false);
            $("#lblestado").text("Inactivo");
        }
        $('#detalle').val(detalleold);
        $('#valorv').val(valorvold);
        $('#valori').val(valoriold == 0 ? '': valoriold);
        $('#h_idden_row__id').val(row__id);
        $("#header").css("background-color","#6491C2");
        $("#header").css("color","white");
        $(".modal-title").text("Editar Parametro");
        $("#divcheck").show();
        $("#btnAgregar").text("Modificar");
        $("#modalPARAMETER").modal("show");
    });

    $("#chkestado").click(function(){
        checked = $("#chkestado").is(":checked");
        if(checked){
            $("#lblestado").text("Activo");
            estado = 'Activo';
        }else{
            $("#lblestado").text("Inactivo");
            estado = 'Inactivo';
        }
    });

    $(document).on("click",".btnDelete",function(){
        row__id = $(this).attr("_id");
        detalle = $('#detalle'+row__id+'').val();
        Swal.fire({
            title: 'Está Seguro de Borrar '+ detalle ,
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
                    FunRemoveItemFromArr( result, detalle );
                    $('#row_'+row__id+'').remove();
                    _count--;
                    if(_count > 0)
                    {
                        FunInactivaButton();
                    }
                    FunReorganizarOrder(result);
                });
              }
        });
    });

    function FunInactivaButton() 
    {
        x = document.getElementsByClassName("btnUp");
        $("#"+x[0]._id).prop('disabled',true);
    }
    
    function FunRemoveItemFromArr (arr, deta)
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
            FunOrderDelete(otroval,item.arry_id,item.arrydetalle,item.arryvalorv,item.arryvalori,item.arryestado,item.arrydisable);
            item['arry_id'] = parseInt(otroval);
        });
        
        FunCambiar_id();
    }

    $(document).on("click",".btnUp",function(){
        row__id = $(this).attr("_id");

        _id_now = $('#orden'+row__id.substr(5)+'').val();
        ordennow = $('#orden'+_id_now+'').val();
        detallenow = $('#detalle'+_id_now+'').val();
        valorvnow = $('#valorv'+_id_now+'').val();
        valorinow = $('#valori'+_id_now+'').val();
        estadonow = $('#estado'+_id_now+'').val();
        disablenow = $('#btnUp'+_id_now+'').attr('disabled');
        //$('#h_idden_row__id').val(_id_now);
        //row_idnow = $('#h_idden_row__id').val();

        _id_ant = _id_now-1;
        ordenant = $('#orden'+_id_ant+'').val();
        detalleant = $('#detalle'+_id_ant+'').val();       
        valorvant = $('#valorv'+_id_ant+'').val();
        valoriant = $('#valori'+_id_ant+'').val();
        estadoant = $('#estado'+_id_ant+'').val();
        disableant = $('#btnUp'+_id_ant+'').attr('disabled');
        //$('#h_idden_row__id').val(_id_ant);
        //row_idant = $('#h_idden_row__id').val();

        // $.each(result,function(i,item){
        //     console.log(item);
        //     if(item.arrydetalle == detallenow){
        //         _filanow = item.arry_id;
        //         return false;
        //     }   
        // });

        // $.each(result,function(i,item){
        //     console.log(item);
        //     if(item.arrydetalle == detalleant){
        //         _filaant = item.arry_id;
        //     }
        //     if(item.arrydetalle == detallenow){
        //         _filanow = item.arry_id;
        //     }
        // });

        //_filanow = $(this).closest('tr').attr('_id');
        //$('tr').prop('_id','row_' + _id_ant);
        //_filaant = $(this).closest('tr').attr('_id');

        // resultado = result.find(deta => deta.arrydetalle == detallenow);
        // _filanow = resultado['arry_id'];
        // resultado = result.find(deta => deta.arrydetalle == detalleant);
        // _filaant = resultado['arry_id'];       
        // alert(_filanow+' '+_filaant);

        FunOrderFirts(_id_ant,ordenant,detallenow,valorvnow,valorinow,estadonow,disableant);
        FunOrderLast(_id_now,ordennow,detalleant,valorvant,valoriant,estadoant,disablenow);
        
    });

    function FunOrderFirts(row_id,orden,detalle,valorv,valori,estado,disable)
    {
        if(disable == 'disabled'){
            _deshabilitar  = 'disabled="disabled"';
        }
        else{
            _deshabilitar = ''
        }

        resultado = result.find(deta => deta.arrydetalle == detalle);
        resultado['arry_id'] = parseInt(orden);

        _output = '<td style="display: none;">' + orden + ' <input type="h_idden" name="h_idden_orden[]" _id="orden' + row_id + '" value="'+ row_id + '" /></td>';
        _output += '<td>' + detalle + ' <input type="h_idden" name="h_idden_detalle[]" _id="detalle' + row_id + '" value="' + detalle + '" /></td>';
        _output += '<td>' + valorv + ' <input type="h_idden" name="h_idden_valorv[]" _id="valorv' + row_id + '" value="'+ valorv + '" /></td>';
        _output += '<td>' + valori + ' <input type="h_idden" name="h_idden_valori[]" _id="valori' + row_id + '" value="'+ valori + '" /></td>';
        _output += '<td>' + estado + ' <input type="h_idden" name="h_idden_estado[]" _id="estado' + row_id + '" value="'+ estado + '" /></td>';
        _output += '<td><div class="text-center"><div class="btn-group">'
        _output += '<button type="button" name="btnUp" class="btn btn-outline-primary btn-sm btnUp" ' + _deshabilitar + ' _id="btnUp' + row_id + '"><i class="fas fa-arrow-up"></i></button>';
        _output += '<button type="button" name="btnEdit" class="btn btn-outline-info btn-sm ml-3 btnEdit" _id="' + row_id + '"><i class="fas fa-file"></i></button>';
        _output += '<button type="button" name="btnDelete" class="btn btn-outline-danger btn-sm ml-3 btnDelete" _id="'+ row_id + '"><i class="fas fa-trash"></i></button></div></div></td>';
        $('#row_' + row_id + '').html(_output);
    }

    function FunOrderLast(row_id,orden,detalle,valorv,valori,estado,disable)
    {
        if(disable == 'disabled'){
            _deshabilitar  = 'disabled="disabled"';
        }
        else{
            _deshabilitar = ''
        }

        resultado = result.find(deta => deta.arrydetalle == detalle);
        resultado['arry_id'] = parseInt(orden);

        _output = '<td style="display: none;">' + orden + ' <input type="h_idden" name="h_idden_orden[]" _id="orden' + row_id + '" value="'+ row_id + '" /></td>';
        _output += '<td>' + detalle + ' <input type="h_idden" name="h_idden_detalle[]" _id="detalle' + row_id + '" value="' + detalle + '" /></td>';
        _output += '<td>' + valorv + ' <input type="h_idden" name="h_idden_valorv[]" _id="valorv' + row_id + '" value="'+ valorv + '" /></td>';
        _output += '<td>' + valori + ' <input type="h_idden" name="h_idden_valori[]" _id="valori' + row_id + '" value="'+ valori + '" /></td>';
        _output += '<td>' + estado + ' <input type="h_idden" name="h_idden_estado[]" _id="estado' + row_id + '" value="'+ estado + '" /></td>';
        _output += '<td><div class="text-center"><div class="btn-group">'
        _output += '<button type="button" name="btnUp" class="btn btn-outline-primary btn-sm btnUp" ' + _deshabilitar + ' _id="btnUp' + row_id + '"><i class="fas fa-arrow-up"></i></button>';
        _output += '<button type="button" name="btnEdit" class="btn btn-outline-info btn-sm ml-3 btnEdit" _id="' + row_id + '"><i class="fas fa-file"></i></button>';
        _output += '<button type="button" name="btnDelete" class="btn btn-outline-danger btn-sm ml-3 btnDelete" _id="'+ row_id + '"><i class="fas fa-trash"></i></button></div></div></td>';
        $('#row_' + row_id + '').html(_output);
    }

    function FunOrderDelete(ordenx,rowmod,detalle,valorv,valori,estado,disable)
    {
        _output = '<td style="display: none;">' + ordenx + ' <input type="h_idden" name="h_idden_orden[]" _id="orden' + ordenx + '" value="'+ ordenx + '" /></td>';
        _output += '<td>' + detalle + ' <input type="h_idden" name="h_idden_detalle[]" _id="detalle' + ordenx + '" value="' + detalle + '" /></td>';
        _output += '<td>' + valorv + ' <input type="h_idden" name="h_idden_valorv[]" _id="valorv' + ordenx + '" value="'+ valorv + '" /></td>';
        _output += '<td>' + valori + ' <input type="h_idden" name="h_idden_valori[]" _id="valori' + ordenx + '" value="'+ valori + '" /></td>';
        _output += '<td>' + estado + ' <input type="h_idden" name="h_idden_estado[]" _id="estado' + ordenx + '" value="'+ estado + '" /></td>';
        _output += '<td><div class="text-center"><div class="btn-group">'
        _output += '<button type="button" name="btnUp" class="btn btn-outline-primary btn-sm btnUp" ' + disable + ' _id="btnUp' + ordenx + '"><i class="fas fa-arrow-up"></i></button>';
        _output += '<button type="button" name="btnEdit" class="btn btn-outline-info btn-sm ml-3 btnEdit" _id="' + ordenx + '"><i class="fas fa-file"></i></button>';
        _output += '<button type="button" name="btnDelete" class="btn btn-outline-danger btn-sm ml-3 btnDelete" _id="'+ ordenx + '"><i class="fas fa-trash"></i></button></div></div></td>';
        $('#row_' + rowmod + '').html(_output);
    }

    function FunCambiar_id()
    {
        $("#tblparameter tbody tr").each(function (index) {
            _id = $(this).attr('_id');
            underScoreIndex = _id.indexOf('_');
            _id = _id.substring(0,underScoreIndex+1)+(parseInt(index)+1);
            $(this).attr('_id',_id);
        });        
    }

    $('#btnSave').click(function(){
        nomparametro = $.trim($("#parametro").val());
        detalle = $.trim($("#descrip").val());

        if(nomparametro == ''){
            Swal.fire({
                title: 'Información',
                type:'warning',
                text: 'Ingrese Nombre del  Parámetro..!'
            });
            return false;            
        }

        if(_count == 0)
        {
            Swal.fire({
                title: 'Información',
                type:'warning',
                text: 'Ingrese al menos un Parámetro..!'
            });
            return false;
        }

        $.ajax({
            url: "../../bd/parametrocrud.php",
            type: "POST",
            _dataType: "json",
            _data: {nomparametro:nomparametro, detalle:detalle, result:result, estado:'Activo', _id:0, opcion:0},            
            success: function(_data){
                if(_data == 'OK-Insert'){
                    $.redirect('parametroadmin.php', {'mensaje': 'Grabado con Exito..!'}); 
                }else{
                    Swal.fire({
                        title: 'Información',
                        type:'warning',
                        text: 'Nombre del Parámetro ya Existe..!'
                    });
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