$(document).ready(function()
{

    var _estado, _result = [], _id, _count, _deshabilitar, _deshabilitae, _resultado = [], _padeid, _estadocab, _checkedcab;

    $("#modalPARAMETER").draggable({
        handle: ".modal-header"
    }); 

    _estadocab = $("#lblEstadoCab").text();   
    _id = $("#paraid").val();
    
    $('#btnRegresar').click(function()
    {        
        $.redirect("parametroadmin.php");
    });  

    if(_estadocab == "Activo")
    {
        $("#chkEstadoCab").prop("checked", true);
    }

    $("#chkEstadoCab").click(function()
    {
        _checkedcab = $("#chkEstadoCab").is(":checked");

        if(_checkedcab)
        {
            $("#lblEstadoCab").text("Activo");
            _estadocab = 'Activo';
        }else{
            $("#lblEstadoCab").text("Inactivo");
            _estadocab = 'Inactivo';
        }
    });    

    $("#tblparameter tbody tr").each(function (items) 
    {
        let _orden, _detalle, _valorv, _valori, _estado, _idpade;
        
        $(this).children("td").each(function (index) 
        {
            switch(index){
                case 0:
                    _idpade = $.trim($(this).text());
                    break;
                case 1:
                    _orden = $.trim($(this).text());
                    break;
                case 2:
                    _detalle = $.trim($(this).text());
                    break;
                case 3:
                    _valorv = $.trim($(this).text());
                    break;
                case 4:
                    _valori = $.trim($(this).text());
                    break;
                case 6:
                    _estado = $.trim($(this).text());
                    break;
            }
        });        
        
        if(_orden == 1)
        {
           _deshabilitar  = 'disabled';
        }  

        _objeto = 
        {
            arryid : parseInt(_idpade),
            arryorden : parseInt(_orden),
            arrydetalle : _detalle,
            arryvalorv : _valorv,
            arryvalori : parseInt(_valori),
            arryestado : _estado,
            arrydisable : _deshabilitar        
        }

        _result.push(_objeto);
        _count =  parseInt(_orden);
      
    });       
       
    //modal
    $("#btnAdd").click(function()
    {        
        $("#formParam").trigger("reset");
        $("#divcheckedit").hide();
        $("#header").css("background-color","#BCBABE");
        $("#header").css("color","white");
        $(".modal-title").text("Nuevo Detalle");  
        $("#btnBoton").html("<i class='fa fa-plus-circle'> Agregar</i>");
        $("#btnBoton").removeClass("btn btn-outline-info");
        $("#btnBoton").addClass("btn btn-outline-primary");  
        $("#modalPARAMETER").modal("show");
        _tipoSave = 'add';
        _estado = 'Activo';
    }); 
    
   $('#btnBoton').click(function() 
   {
       _continuar = true;

        if($.trim($('#txtDetalle').val()).length == 0)
        {           
            mensajesalertify("Ingrese Detalle del Parámetro..!!","W","top-right",3);
            return false;
        }

        if($.trim($('#txtValorv').val()).length == 0 && $.trim($('#txtValori').val()).length == 0 )
        {            
            mensajesalertify("Ingrese Valor Texto o Valor Entero..!!","W","top-right",3);
            return false;
        }

        if($.trim($('#txtValorv').val()).length > 0 && $.trim($('#txtValori').val()).length > 0 )
        {          
            mensajesalertify("Ingrese Solo Valor Texto o Valor Entero..!!","E","top-center",5);
            return false;
        }

        _detalle = $.trim($('#txtDetalle').val());
        _valorv = $.trim($('#txtValorv').val());
        _valori = $.trim($('#txtValori').val());

        if($.trim($('#txtValori').val()).length == 0)
        {
            _valori = 0;
        }
        else _valori = $.trim($('#txtValori').val());
        
        if(_tipoSave == 'add')
        {
            $.each(_result,function(i,item){
                if(item.arrydetalle.toUpperCase() == _detalle.toUpperCase())
                {                  
                    mensajesalertify("Nombre del Parámetro ya Existe..!!","W","top-right",3);                    
                    _continuar = false;
                    return false;
                }
                else
                {
                    $.each(_result,function(i,item)
                    {
                        if(_valori == 0)
                        {
                            if(item.arryvalorv.toUpperCase() == _valorv.toUpperCase())
                            {                               
                                mensajesalertify("Valor Texto de Parámetro ya Existe..!!","W","top-right",3);    
                                _continuar = false;
                                return false;
                            }
                            else  _continuar = true;
                        }
                        else
                        {
                            if(item.arryvalori == _valori)
                            {                               
                                mensajesalertify("Valor Entero de Parámetro ya Existe..!!","W","top-right",3); 
                                _continuar = false;
                                return false;
                            }
                            else _continuar = true;
                        }
                    });
                }
            });

            if(_continuar){

                //GRABAR EN LA BASE DE DATOS 
                $.ajax({
                    url: "../db/parametrocrud.php",
                    type: "POST",
                    dataType: "json",
                    data: {id:_id , detalle:_detalle, valorv:_valorv, valori:_valori, estado: _estado, opcion: 5},            
                    success: function(data){
                        _padeid = data[0].Padeid;
                        _orden  = data[0].Orden;
                        _detalle  = data[0].Detalle;
                        _valorv  = data[0].ValorV;
                        _valori  = data[0].ValorI;
                        _estado  = data[0].Estado;

                        _deshabibtnup = '';

                        if(_orden == '1'){
                            _deshabibtnup  = 'disabled';
                        }

                        _output = '<tr id="row_' + _orden + '">';
                        _output += '<td style="display: none;">' + _padeid + ' <input type="hidden" name="hidden_padeid[]" id="padeid' + _orden + '" value="' + _padeid + '" /></td>';
                        _output += '<td style="display: none;">' + _orden + ' <input type="hidden" name="hidden_orden[]" id="orden' + _orden + '" value="' + _orden + '" /></td>';
                        _output += '<td>' + _detalle + ' <input type="hidden" name="hidden_detalle[]" id="txtDetalle' + _orden + '" value="' + _detalle + '" /></td>';
                        _output += '<td>' + _valorv + ' <input type="hidden" name="hidden_valorv[]" id="txtValorv' +_orden + '" value="' + _valorv + '" /></td>';
                        _output += '<td>' + _valori + ' <input type="hidden" name="hidden_valori[]" id="txtValori' + _orden + '" value="' + _valori + '" /></td>';
                        _output += '<td><div class="text-center"><div class="btn-group">'
                        _output += '<button type="button" name="btnUp" class="btn btn-outline-primary btn-sm btnUp"' + ' id="btnUp' + _orden + '" ' + _deshabibtnup + 
                                    ' ><i class="fa fa-arrow-up"></i></button>';                          
                        _output += '<button type="button" name="btnEdit" class="btn btn-outline-info btn-sm ml-2 btnEdit" data-toggle="tooltip" data-placement="top" title="editar" id="btnEdit' + _orden + '"><i class="fa fa-pencil-square-o"></i></button>';
                        _output += '</div></div></td><td><div class="text-center"><input type="checkbox" class="form-check-input chkEstadoDe" id="chk' + _orden +
                                    '" checked value=' + _padeid + '/></div></td></tr>';

                        $('#tblparameter').append(_output);
        
                        _objeto = {
                            arryid : 0,
                            arryorden : _count,
                            arrydetalle : _detalle,
                            arryvalorv : _valorv,
                            arryvalori : _valori,
                            arryestado : _estado,
                            arrydisable : _deshabilitar
                        }
        
                        _result.push(_objeto);                        
                    },
                    error: function (error) {
                        console.log(error);
                    } 
                }); 


                $("#modalPARAMETER").modal("hide");
            }
        }
        else
        {
            _continuar = true, _seguir = true;

            if(_detalleold.toUpperCase() != _detalle.toUpperCase())
            {
                $.each(_result,function(i,item)
                {
                    if(item.arrydetalle.toUpperCase() == _detalle.toUpperCase())
                    {                        
                        mensajesalertify("Nombre del Parámetro ya Existe..!!","W","top-right",3); 
                        _continuar = false;
                        return false;
                    }
                    else _continuar = true;
                });
            }
            else _continuar = true;

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
                                mensajesalertify("Valor Entero de Parámetro ya Existe..!!","W","top-right",3);                     
                                _seguir = false;
                                return false;
                            }
                            else seguir = true;
                        });                        
                    }
                }
                else
                {
                    if(_valorvold.toUpperCase() != _valorv.toUpperCase())
                    {
                        $.each(_result,function(i,item)
                        {
                            if(item.arryvalorv.toUpperCase() == _valorv.toUpperCase())
                            {                              
                                mensajesalertify("Valor Texto de Parámetro ya Existe..!!","W","top-right",3);                     
                                _seguir = false;
                                return false;
                            }
                            else _seguir = true;
                        });
                    }
                    else _seguir = true;    
                }
            }

            if(_seguir)
            {

                $.ajax({
                    url: "../db/parametrocrud.php",
                    type: "POST",
                    dataType: "json",
                    data: {id:_padeid, detalle: _detalle, valorv:_valorv,valori:_valori, opcion: 7},            
                    success: function(data){
                        _padeid = data[0].Padeid;
                        _orden  = data[0].Orden;
                        _detalle  = data[0].Detalle;
                        _valorv  = data[0].ValorV;
                        _valori  = data[0].ValorI;
                        _estado  = data[0].Estado;

                        _deshabibtnup = '';
                        _checknew = '';
                        _deshabieditar = '';

                        if(_orden == '1'){
                            _deshabibtnup  = 'disabled';
                        }
                        
                        if(_estado == 'Activo'){
                            _checknew = 'checked';
                        }else _deshabieditar = 'disabled';
                
                        row_id = $('#hidden_row_id').val();
                        _output = '<td style="display: none;">' + _padeid + ' <input type="hidden" name="hidden_padeid[]" id="padeid' + _orden + '" value="' + _padeid + '" /></td>';
                        _output += '<td style="display: none;">' + _orden + ' <input type="hidden" name="hidden_orden[]" id="orden' + _orden + '" value="'+ _orden + '" /></td>';
                        _output += '<td>' + _detalle + ' <input type="hidden" name="hidden_detalle[]" id="txtDetalle' + _orden + '" value="' + _detalle + '" /></td>';
                        _output += '<td class="text-center">' + _valorv + ' <input type="hidden" name="hidden_valorv[]" id="txtValorv' + _orden + '" value="'+ _valorv + '" /></td>';
                        _output += '<td class="text-center">' + _valori + ' <input type="hidden" name="hidden_valori[]" id="txtValori' + _orden + '" value="'+ _valori + '" /></td>';      
                        _output += '<td><div class="text-center"><div class="btn-group">'
                        _output += '<button type="button" name="btnUp" class="btn btn-outline-primary btn-sm btnUp"' + ' id="btnUp' + _orden + '" ' + _deshabibtnup + 
                                    ' ><i class="fa fa-arrow-up"></i></button>';
                        _output += '<button type="button" name="btnEdit" class="btn btn-outline-info btn-sm ml-2 btnEdit" data-toggle="tooltip" data-placement="top" title="editar" id="btnEdit' + 
                                    _orden + '" ' + _deshabieditar + ' ><i class="fa fa-pencil-square-o"></i></button>';
                        _output += '</div></div></td><td><div class="text-center"><input type="checkbox" class="form-check-input chkEstadoDe" id="chk' + _orden + '" ' + _checknew +
                                    ' value=' + _padeid + '/></div></td></tr>';   
        
                        $('#row_' + row_id + '').html(_output);
        
                        _objIndex = _result.findIndex(obj => obj.arryorden == _orden);
                        _result[_objIndex].arrydetalle = _detalle;
                        _result[_objIndex].arryvalorv = _valorv;
                        _result[_objIndex].arryvalori = _valori;

                                    
                    },
                    error: function (error) {
                        console.log(error);
                    }                          
                });

                $("#modalPARAMETER").modal("hide");
                
            }
        } 
    });

    //CAMBIAR ESTADO PARAMETRO DETALLE BDD

    $(document).on("click",".chkEstadoDe",function(){ 
        let _rowid = $(this).attr("id");
        let _idpade = _rowid.substring(3);
        let _check = $("#chk" + _idpade).is(":checked");
        let _padeid = $("#chk" + _idpade).val();
        let _estadopade;

        if(_check){
            _estadopade = 'Activo';
            $('#btnEdit' + _idpade).prop("disabled","");
        }else 
        {
            _estadopade = 'Inactivo';
            $('#btnEdit' + _idpade).prop("disabled","disabled");
        }

         $.ajax({
            url: "../db/parametrocrud.php",
            type: "POST",
            dataType: "json",
            data: {id: _padeid, estado: _estadopade, opcion: 4},
            success: function(data){
               
            },
            error: function (error) {
                console.log(error);
            }                 
        });

    });  
    
    //BOTON EDITAR DETALLE MODAL

    $(document).on("click",".btnEdit",function(){
        $("#formParam").trigger("reset"); 

        let _row_id = $(this).attr("id");
        _row_id = _row_id.substring(7);
        _padeid = $('#padeid' + _row_id).val();
        _norden = $('#orden' + _row_id).val();
        _detalleold = $('#txtDetalle' + _row_id).val();
        _valorvold = $('#txtValorv' + _row_id).val();
        _valoriold = $('#txtValori' + _row_id ).val();
        _estadoold = $('#txtEstado' + _row_id ).val();    
        _tipoSave = 'edit';

        $('#txtDetalle').val(_detalleold);
        $('#txtValorv').val(_valorvold);
        $('#txtValori').val(_valoriold == 0 ? '': _valoriold);
        $('#hidden_row_id').val(_row_id);
        $("#header").css("background-color","#BCBABE");
        $("#header").css("color","white");
        $(".modal-title").text("Editar Detalle");       
        $("#divcheckedit").show();
        $("#btnBoton").text("Modificar");
        $("#btnBoton").removeClass("btn btn-outline-primary");
        $("#btnBoton").addClass("btn btn-outline-info");
        $("#modalPARAMETER").modal("show");
    });

    //SUBIR DETALLE MODAL
    $(document).on("click",".btnUp",function(){
        
        let row_id = $(this).attr("id");
        let id_now = $('#orden' + row_id.substr(5)).val();
        let _padeidnow = $('#padeid' + id_now).val();

        $.ajax({
            url: "../db/parametrocrud.php",
            type: "POST",
            dataType: "json",
            data: {idpa: _id, id: _padeidnow, opcion: 6},            
            success: function(data){

                $("#tblparameter").empty();

                _output = '<thead>';
                _output += '<tr><th style="display: none;">Id</th>';
                _output += '<th style="display: none;">NOrden</th>';
                _output += '<th>Detalle</th>';
                _output += '<th>Valor Texto</th>';
                _output += '<th>Valor Entero</th>';
                _output += '<th style="width:13% ; text-align: center">Opciones</th>';
                _output += '<th style="width:10% ; text-align: center">Estado</th>';
                _output += '</tr></thead>';

                $('#tblparameter').append(_output); 
        
                _output = '<tbody>';
                $('#tblparameter').append(_output); 

                $.each(data,function(i,item){  
                    _padeid = data[i].Padeid;
                    _orden  = data[i].Orden;
                    _detalle  = data[i].Detalle;
                    _valorv  = data[i].ValorV;
                    _valori  = data[i].ValorI;
                    _estado  = data[i].Estado;

                    _deshabibtnup = '';
                    _deshabieditar = '';
                    _checknew = '';

                    if(_orden == '1'){
                        _deshabibtnup  = 'disabled';
                    }
                    
                    if(_estado == 'Activo'){
                        _checknew = 'checked';
                    }else{
                        _deshabieditar = 'disabled';
                    }
            
                    _output = '<tr id="row_' + _orden + '">';
                    _output += '<td style="display: none;">' + _padeid + ' <input type="hidden" name="hidden_padeid[]" id="padeid' + _orden + '" value=' + _padeid + ' /></td>';
                    _output += '<td style="display: none;">' + _orden + ' <input type="hidden" name="hidden_orden[]" id="orden' + _orden + '" value=' + _orden + ' /></td>';
                    _output += '<td>' + _detalle + ' <input type="hidden" name="hidden_detalle[]" id="txtDetalle' + _orden + '" value="' + _detalle + '" /></td>';
                    _output += '<td class="text-center">' + _valorv + ' <input type="hidden" name="hidden_valorv[]" id="txtValorv' +_orden + '" value="' + _valorv + '" /></td>';
                    _output += '<td class="text-center">' + _valori + ' <input type="hidden" name="hidden_valori[]" id="txtValori' + _orden + '" value="' + _valori + '" /></td>';
                    _output += '<td><div class="text-center"><div class="btn-group">'
                    _output += '<button type="button" name="btnUp" class="btn btn-outline-primary btn-sm btnUp"' + ' id="btnUp' + _orden + '" ' + _deshabibtnup + 
                                ' ><i class="fa fa-arrow-up"></i></button>';
                    _output += '<button type="button" name="btnEdit" class="btn btn-outline-info btn-sm ml-2 btnEdit" data-toggle="tooltip" data-placement="top" title="editar" id="btnEdit' + 
                                _orden + '" ' + _deshabieditar + ' ><i class="fa fa-pencil-square-o"></i></button>';
                    _output += '</div></div></td><td><div class="text-center"><input type="checkbox" class="form-check-input chkEstadoDe" id="chk' + _orden + '" ' + _checknew +
                                ' value=' + _padeid + '/></div></td></tr>';

                    //console.log(_output);
                    
                    $('#tblparameter').append(_output);
                });

                _output = '</tbody>';
                $('#tblparameter').append(_output);      
                
                //console.log(_output);
                      
            },
            error: function (error) {
                console.log(error);
            } 
        });     

        // FunOrderFirts(_ordenant,_detallenow,_valorvnow,_valorinow,_estadonow,_padeidnow);
        // FunOrderLast(_ordennow,_detalleant,_valorvant,_valoriant,_estadoant,_padeidant);
        
    });

    // function FunOrderFirts(orden,detalle,valorv,valori,estado,padeid)
    // {        
    //     if(orden == '1'){
    //         _deshabilitar  = 'disabled';
    //     }
    //     else{
    //         _deshabilitar = ''
    //     }

    //     if(estado == 'Activo'){
    //         _checknew = 'checked';
    //     }else{
    //         _checknew = ' ';
    //     }

    //     if(padeid != 0){
    //         _deshabilitae = 'disabled';
    //         _deshabilitachk = '';
    //     }else{
    //         _deshabilitae = '';
    //         _deshabilitachk = 'disabled';
    //     }    

    //     _resultado = _result.find(d => d.arrydetalle == detalle);
    //     _resultado['arryorden'] = parseInt(orden);

    //     _output = '<td style="display: none;">' + padeid + ' <input type="hidden" name="hidden_padeid[]" id="padeid' + orden + '" value="' + padeid + '" /></td>';
    //     _output += '<td style="display: none;">' + orden + ' <input type="hidden" name="hidden_orden[]" id="orden' + orden + '" value="'+ orden + '" /></td>';
    //     _output += '<td>' + detalle + ' <input type="hidden" name="hidden_detalle[]" id="txtDetalle' + orden + '" value="' + detalle + '" /></td>';
    //     _output += '<td class="text-center">' + valorv + ' <input type="hidden" name="hidden_valorv[]" id="txtValorv' + orden + '" value="'+ valorv + '" /></td>';
    //     _output += '<td class="text-center">' + valori + ' <input type="hidden" name="hidden_valori[]" id="txtValori' + orden + '" value="'+ valori + '" /></td>';      
    //     _output += '<td><div class="text-center"><div class="btn-group">'
    //     _output += '<button type="button" name="btnUp" class="btn btn-outline-primary btn-sm btnUp" ' + _deshabilitar + ' id="btnUp' + orden + '"><i class="fa fa-arrow-up"></i></button>';
    //     _output += '<button type="button" name="btnEdit" class="btn btn-outline-info btn-sm ml-2 btnEdit" data-toggle="tooltip" data-placement="top" title="editar" id="' + orden + '"><i class="fa fa-pencil-square-o"></i></button>';
    //     _output += '</div></div></td><td><div class="text-center"><input type="checkbox" class="form-check-input chkEstadoDe" id="chk' + orden +
    //                '" ' + _checknew + ' ' + _deshabilitachk + ' value=' + orden + '/></div></td>'
                                                 
    //     $('#row_' + orden + '').html(_output);

    // }

    // function FunOrderLast(orden,detalle,valorv,valori,estado,padeid)
    // {        

    //     _deshabilitar = '';

    //     if(estado == 'Activo'){
    //         _checknew = 'checked';
    //     }else{
    //         _checknew = ' ';
    //     }

    //     if(padeid != 0){
    //         _deshabilitae = 'disabled';
    //         _deshabilitachk = '';
    //     }else{
    //         _deshabilitae = '';
    //         _deshabilitachk = 'disabled';
    //     }  

    //     _resultado = _result.find(d => d.arrydetalle == detalle);
    //     _resultado['arryorden'] = parseInt(orden);

    //     _output = '<td style="display: none;">' + padeid + ' <input type="hidden" name="hidden_padeid[]" id="padeid' + orden + '" value="' + padeid + '" /></td>';
    //     _output += '<td style="display: none;">' + orden + ' <input type="hidden" name="hidden_orden[]" id="orden' + orden + '" value="'+ orden + '" /></td>';
    //     _output += '<td>' + detalle + ' <input type="hidden" name="hidden_detalle[]" id="txtDetalle' + orden + '" value="' + detalle + '" /></td>';
    //     _output += '<td class="text-center">' + valorv + ' <input type="hidden" name="hidden_valorv[]" id="txtValorv' + orden + '" value="'+ valorv + '" /></td>';
    //     _output += '<td class="text-center">' + valori + ' <input type="hidden" name="hidden_valori[]" id="txtValori' + orden + '" value="'+ valori + '" /></td>';     
    //     _output += '<td><div class="text-center"><div class="btn-group">'
    //     _output += '<button type="button" name="btnUp" class="btn btn-outline-primary btn-sm btnUp" ' + _deshabilitar + ' id="btnUp' + orden + '"><i class="fa fa-arrow-up"></i></button>';
    //     _output += '<button type="button" name="btnEdit" class="btn btn-outline-info btn-sm ml-2 btnEdit" data-toggle="tooltip" data-placement="top" title="editar" id="' + orden + '"><i class="fa fa-pencil-square-o"></i></button>';
    //     _output += '</div></div></td><td><div class="text-center"><input type="checkbox" class="form-check-input chkEstadoDe" id="chk' + orden +
    //                '" ' + _checknew + ' ' + _deshabilitachk + ' value=' + orden + '/></div></td>'   

    //     $('#row_' + orden + '').html(_output);

    // }

    // function FunOrderDelete(orden,rowmod,detalle,valorv,valori,estado,padeid)
    // {        
    //     if(orden == 1){
    //         _deshabilitar  = 'disabled';
    //     }else{
    //         _deshabilitar = '';
    //     }

    //     if(estado == 'Activo'){
    //         _checknew = 'checked';
    //     }else{
    //         _checknew = '';
    //     }

    //     if(padeid != 0){
    //         _deshabilitae = 'disabled';
    //         _deshabilitachk = '';
            
    //     }else{
    //         _deshabilitae = '';
    //         _deshabilitachk = 'disabled';
    //     } 

    //     _output = '<td style="display: none;">' + padeid + ' <input type="hidden" name="hidden_padeid[]" id="padeid' + orden + '" value="' + padeid + '" /></td>';
    //     _output += '<td style="display: none;">' + orden + ' <input type="hidden" name="hidden_orden[]" id="orden' + orden + '" value="'+ orden + '" /></td>';
    //     _output += '<td>' + detalle + ' <input type="hidden" name="hidden_detalle[]" id="txtDetalle' + orden + '" value="' + detalle + '" /></td>';
    //     _output += '<td class="text-center">' + valorv + ' <input type="hidden" name="hidden_valorv[]" id="txtValorv' + orden + '" value="'+ valorv + '" /></td>';
    //     _output += '<td class="text-center">' + valori + ' <input type="hidden" name="hidden_valori[]" id="txtValori' + orden + '" value="'+ valori + '" /></td>';      
    //     _output += '<td><div class="text-center"><div class="btn-group">'
    //     _output += '<button type="button" name="btnUp" class="btn btn-outline-primary btn-sm btnUp" ' + _deshabilitar + ' id="btnUp' + orden + '"><i class="fa fa-arrow-up"></i></button>';
    //     _output += '<button type="button" name="btnEdit" class="btn btn-outline-info btn-sm ml-2 btnEdit" data-toggle="tooltip" data-placement="top" title="editar" id="' + orden + '"><i class="fa fa-pencil-square-o"></i></button>';
    //     _output += '</div></div></td><td><div class="text-center"><input type="checkbox" class="form-check-input chkEstadoDe" id="chk' + orden +
    //                '" ' + _checknew + ' ' + _deshabilitachk + ' value=' + orden + '/></div></td>'  

    //     $('#row_' + rowmod + '').html(_output);
    // }

    $('#btnSave').click(function(){
        _nomparametro = $.trim($("#txtParametro").val());
        _descripcion = $.trim($("#txtDescripcion").val());

        if(_nomparametro == ''){
        
            mensajesalertify("Ingrese Nombre del  Parámetro..!!","W","top-center",5);
            return false; 
        }

        if(_count == 0)
        {         
            mensajesalertify("Ingrese al menos un Detalle..!!","W","top-center",5);
            return false;
        }
        
        $.ajax({
            url: "../db/parametrocrud.php",
            type: "POST",
            dataType: "json",
            data: {nomparametro:_nomparametro, descripcion:_descripcion, id:_id, opcion:1},            
            success: function(data){
            
            
                 if(data[0].OK == 'OK-Update'){

                    $.redirect('parametroadmin.php', {'mensaje': 'Guardado con Exito..!'}); 
                }else{
                
                    mensajesalertify("Nombre del Parámetro ya Existe..!","W","top-center",5);
                }                
            },
            error: function (error) {
                console.log(error);
            }                            
        }); 

    });

  

});




