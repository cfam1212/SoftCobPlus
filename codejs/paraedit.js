$(document).ready(function()
{

    var _estado, _result = [], _id, _count, _deshabilitar, _deshabilitae, _resultado = [], _checked, _estadocab, _checkedcab;

    $("#modalPARAMETER").draggable({
        handle: ".modal-header"
    }); 

    _estadocab = $("#lblEstadoCab").text();   
    _id = $("#paraid").val();
    // alert(_id);
    // console.log(_id);
    
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
        let _orden, _detalle, _valorv, _valori, _estado;
        
        $(this).children("td").each(function (index) 
        {
            switch(index){
                case 0:
                    _orden = $.trim($(this).text());
                    break;
                case 1:
                    _detalle = $.trim($(this).text());
                    break;
                case 2:
                    _valorv = $.trim($(this).text());
                    break;
                case 3:
                    _valori = $.trim($(this).text());
                    break;
                case 5:
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
            arryid : parseInt(_orden),
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
        $(".modal-title").text("Nuevo Parametro");  
        $("#btnAgregar").text("Agregar");
        $("#modalPARAMETER").modal("show");
        _tipoSave = 'add';
        _estado = 'Activo';
    }); 
    
   $('#btnAgregar').click(function()
   {
        if($.trim($('#txtDetalle').val()).length == 0)
        {           
            mensajesalertify("Ingrese Detalle del Parámetro..!!","W","top-center",5);
            return false;
        }

        if($.trim($('#txtValorv').val()).length == 0 && $.trim($('#txtValori').val()).length == 0 )
        {            
            mensajesalertify("Ingrese Valor Texto o Valor Entero..!!","W","top-center",5);
            return false;
        }

        if($.trim($('#txtValorv').val()).length > 0 && $.trim($('#txtValori').val()).length > 0 )
        {          
            mensajesalertify("Ingrese Solo Valor Texto o Valor Entero..!!","E","bottom-center",5);
            return false;
        }

        _detalle = $.trim($('#txtDetalle').val());
        _valorv = $.trim($('#txtValorv').val());
        
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
                    mensajesalertify("Nombre del Parámetro ya Existe..!!","E","bottom-center",5);                    
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
                                mensajesalertify("Valor Texto de Parámetro ya Existe..!!","E","bottom-center",5);    
                                _continuar = false;
                                return false;
                            }
                            else  _continuar = true;
                        }
                        else
                        {
                            if(item.arryvalori == _valori)
                            {                               
                                mensajesalertify("Valor Entero de Parámetro ya Existe..!!","E","bottom-center",5); 
                                _continuar = false;
                                return false;
                            }
                            else _continuar = true;
                        }
                    });
                }
            });

            if(_continuar){
                _count++;

                /*if(_count == 1){
                    _deshabilitar  = '';
                }else{
                    _deshabilitar = '';
                }*/

                _output = '<tr id="row_' + _count + '">';
                _output += '<td>' + _count + ' <input type="hidden" name="hidden_orden[]" id="orden' + _count + '" value="' + _count + '" /></td>';                
                _output += '<td>' + _detalle + ' <input type="hidden" name="hidden_detalle[]" id="txtDetalle' + _count + '" value="' + _detalle + '" /></td>';
                _output += '<td class="text-center">' + _valorv + ' <input type="hidden" name="hidden_valorv[]" id="txtValorv' +_count + '" value="' + _valorv + '" /></td>';
                _output += '<td class="text-center">' + _valori + ' <input type="hidden" name="hidden_valori[]" id="txtValori' + _count + '" value="' + _valori + '" /></td>';
                _output += '<td><div class="text-center"><input type="checkbox" class="form-check-input chkEstadoDe" id="chk' + _count +
                            '" checked disabled' + ' value=' + _count + '/></div></td>'
                _output += '<td>' + _estado + ' <input type="text" name="hidden_estado[]" id="txtEstado' + _count + '" value="' + _estado + '" /></td>';
                _output += '<td><div class="text-center"><div class="btn-group">'
                _output += '<button type="button" name="subirnivel" class="btn btn-outline-primary btn-sm btnUp"' + ' id="btnUp' + _count + '"><i class="fa fa-arrow-up"></i></button>';
                _output += '<button type="button" name="btnEdit" class="btn btn-outline-info btn-sm ml-3 btnEdit" data-toggle="tooltip" data-placement="top" title="editar" id="' + _count + '"><i class="fa fa-pencil-square-o"></i></button>';
                _output += '<button type="button" name="btnDelete" class="btn btn-outline-danger btn-sm ml-3 btnDelete" id="' + _count + '"><i class="fa fa-trash-o"></i></button></div></div></td>';
                _output += '</tr>';
                
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
                        mensajesalertify("Nombre del Parámetro ya Existe..!!","E","bottom-center",5); 
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
                                mensajesalertify("Valor Entero de Parámetro ya Existe..!!","E","bottom-center",5);                     
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
                                mensajesalertify("Valor Texto de Parámetro ya Existe..!!","E","bottom-center",5);                     
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
                FunRemoveItemFromArr(_result, _detalleold);

                /*alert('ParaID: ' + _id + ' DealleID: ' + _codigoold );
                $.ajax({
                    url: "../db/consultadatos.php",
                    type: "POST",
                    dataType: "json",
                    data: {tipo: 38, auxv1: _estadoold=='Activo' ? 'A' : 'I', auxi1: _id, auxi2: _codigoold, opcion: 0},            
                    success: function(data){
                        if(data == 'OK-Update'){
                             
                        }                
                    },
                    error: function (error) {
                        console.log(error);
                    }                          
                });*/

                _objeto = 
                {
                    arryid : parseInt(_codigoold),
                    arryorden : parseInt(_norden),
                    arrydetalle : _detalle,
                    arryvalorv : _valorv,
                    arryvalori : parseInt(_valori),
                    arryestado : _estadoold,
                    arrydisable : _deshabilitar
                }

                _result.push(_objeto);
            
                $("#modalPARAMETER").modal("hide");
                
                $("tbody").children().remove();

                FunReorganizarEdit(_result.sort((a,b) => a.arryorden - b.arryorden));  
            }
        } 
    });

    $(document).on("click",".chkEstadoDe",function(){ 
        let _rowid = $(this).attr("id");
        let _idpade = _rowid.substring(3);
        let _check = $("#chk" + _idpade).is(":checked");
        let _estadopade;

        if(_check){
            _estadopade = 'Activo';
            $("#txtEstado" + _idpade).val('Activo');
            //$('#tdestado' + _idpade).text('Activo');
        }else 
        {
            _estadopade = 'Inactivo';
            $("#txtEstado" + _idpade).val('Inactivo');
            //$('#tdestado' + _idpade).text('Inactivo');
        }

        /*$.ajax({
            url: "../db/depacrud.php",
            type: "POST",
            dataType: "json",
            data: {id: _iddepa, estado: _estadodepa, opcion: 4},
            success: function(data){
               
            },
            error: function (error) {
                console.log(error);
            }                 
        });*/

    });    

    $(document).on("click",".btnEdit",function(){
        $("#formParam").trigger("reset"); 
        row_id = $(this).attr("id");
        _codigoold = $('#codigo' + row_id + '').val();
        _norden = $('#orden' + row_id + '').val();
        _detalleold = $('#txtDetalle' + row_id + '').val();
        _valorvold = $('#txtValorv' + row_id + '').val();
        _valoriold = $('#txtValori' + row_id + '').val();
        _estadoold = $('#txtEstado' + row_id + '').val();
        _deshabilitar = $('#btnUp' + row_id + '').attr('disabled');        
        _tipoSave = 'edit';

        if(_estadoold == "Activo"){
            //$("#chkEstado").prop("checked", true);
            $("#lblEstado").text("Activo");
        }else{
            //$("#chkEstado").prop("checked", false);
            $("#lblEstado").text("Inactivo");
        }
        
        $('#txtDetalle').val(_detalleold);
        $('#txtValorv').val(_valorvold);
        $('#txtValori').val(_valoriold == 0 ? '': _valoriold);
        $('#hidden_row_id').val(row_id);
        $("#header").css("background-color","#BCBABE");
        $("#header").css("color","white");
        $(".modal-title").text("Editar Parametro");       
        $("#divcheckedit").show();
        $("#btnAgregar").text("Guardar");
        $("#modalPARAMETER").modal("show");
    });

    /*$("#chkEstado").click(function(){
        _checked = $("#chkEstado").is(":checked");
        if(_checked){
            $("#lblEstado").text("Activo");
            _estadoold = 'Activo';
        }else{
            $("#lblEstado").text("Inactivo");
            _estadoold = 'Inactivo';
        }
    });*/

    $(document).on("click",".btnDelete",function(){
        row_id = $(this).attr("id");
        _detalle = $('#txtDetalle' + row_id + '').val();
        alertify.confirm('El Registro seta eliminado..!!', 'Esta seguro de eliminar..' + ' ' + _detalle + '..?', function(){  mensajesalertify("Registro Eliminado","E","bottom-center",5)	
                                    
            FunRemoveItemFromArr(_result, _detalle);
            $('#row_' + row_id + '').remove();
            _count--;
            FunReorganizarOrder(_result);
            //DeletePara();
        }
        , function(){});
    });

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
            FunOrderDelete(otroval,item.arryorden,item.arrydetalle,item.arryvalorv,item.arryvalori,item.arryestado,item.arryid);
            item['arryorden'] = parseInt(otroval);
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
            FunOrderEdit(item.arry_id,item.arrydetalle,item.arryvalorv,item.arryvalori,item.arryestado,item.arrycodigo);
        });

    }

    function FunOrderEdit(orden,detalle,valorv,valori,estado,padeid)
    {
        if(orden == '1'){
            _deshabilitar  = 'disabled';
        }
        else{
            _deshabilitar = ''
        }

        if(estado == 'Activo'){
            _checknew = 'checked';
        }else{
            _checknew = ' ';
        }

        if(padeid != 0){
            _deshabilitae = 'disabled';
            _deshabilitachk = '';
        }else{
            _deshabilitae = '';
            _deshabilitachk = 'disabled';
        }

        _output = '<td style="display: none;">' + orden + ' <input type="hidden" name="hidden_orden[]" id="orden' + orden + '" value="'+ orden + '" /></td>';
        _output += '<td>' + detalle + ' <input type="hidden" name="hidden_detalle[]" id="txtDetalle' + orden + '" value="' + detalle + '" /></td>';
        _output += '<td class="text-center">' + valorv + ' <input type="hidden" name="hidden_valorv[]" id="txtValorv' + orden + '" value="'+ valorv + '" /></td>';
        _output += '<td class="text-center">' + valori + ' <input type="hidden" name="hidden_valori[]" id="txtValori' + orden + '" value="'+ valori + '" /></td>';
        _output += '<td><div class="text-center"><input type="checkbox" class="form-check-input chkEstadoDe" id="chk' + orden +
                '" ' + _checknew + ' ' + _deshabilitachk + ' value=' + orden + '/></div></td>'        
        _output += '<td style="display: none;">' + estado + ' <input type="hidden" name="hidden_estado[]" id="txtEstado' + orden + '" value="'+ estado + '" /></td>';
        _output += '<td><div class="text-center"><div class="btn-group">'
        _output += '<button type="button" name="btnUp" class="btn btn-outline-primary btn-sm btnUp" ' + _deshabilitar + ' id="btnUp' + orden + '"><i class="fa fa-arrow-up"></i></button>';
        _output += '<button type="button" name="btnEdit" class="btn btn-outline-info btn-sm ml-3 btnEdit" data-toggle="tooltip" data-placement="top" title="editar" id="' + orden + '"><i class="fa fa-pencil-square-o"></i></button>';
        _output += '<button type="button" name="btnDelete" class="btn btn-outline-danger btn-sm ml-3 btnDelete" ' + _deshabilitae + ' id="'+ orden + '"><i class="fa fa-trash-o"></i></button></div></div></td>';
                        
        $('#tblparameter').append(_output);     
            
    }

    $(document).on("click",".btnUp",function(){
        
        row_id = $(this).attr("id"); 
        id_now = $('#orden' + row_id.substr(5) + '').val();

        _ordennow = $('#orden' + id_now + '').val();
        _detallenow = $('#txtDetalle' + id_now + '').val();
        _valorvnow = $('#txtValorv' + id_now + '').val();
        _valorinow = $('#txtValori' + id_now + '').val();
        _estadonow = $('#txtEstado' + id_now + '').val();

        id_ant = id_now - 1;
        _ordenant = $('#orden' + id_ant + '').val();
        _detalleant = $('#txtDetalle' + id_ant + '').val();       
        _valorvant = $('#txtValorv' + id_ant + '').val();
        _valoriant = $('#txtValori' + id_ant + '').val();
        _estadoant = $('#txtEstado' + id_ant + '').val();

        FunOrderFirts(_ordenant,_detallenow,_valorvnow,_valorinow,_estadonow,id_now);
        FunOrderLast(_ordennow,_detalleant,_valorvant,_valoriant,_estadoant,id_ant);
        
    });

    function FunOrderFirts(orden,detalle,valorv,valori,estado,padeid)
    {        
        if(orden == '1'){
            _deshabilitar  = 'disabled';
        }
        else{
            _deshabilitar = ''
        }

        if(estado == 'Activo'){
            _checknew = 'checked';
        }else{
            _checknew = ' ';
        }

        if(padeid != 0){
            _deshabilitae = 'disabled';
            _deshabilitachk = '';
        }else{
            _deshabilitae = '';
            _deshabilitachk = 'disabled';
        }    

        _resultado = _result.find(d => d.arrydetalle == detalle);
        _resultado['arryorden'] = parseInt(orden);

        _output = '<td style="display: none;">' + orden + ' <input type="hidden" name="hidden_orden[]" id="orden' + orden + '" value="'+ orden + '" /></td>';
        _output += '<td>' + detalle + ' <input type="hidden" name="hidden_detalle[]" id="txtDetalle' + orden + '" value="' + detalle + '" /></td>';
        _output += '<td class="text-center">' + valorv + ' <input type="hidden" name="hidden_valorv[]" id="txtValorv' + orden + '" value="'+ valorv + '" /></td>';
        _output += '<td class="text-center">' + valori + ' <input type="hidden" name="hidden_valori[]" id="txtValori' + orden + '" value="'+ valori + '" /></td>';
        _output += '<td><div class="text-center"><input type="checkbox" class="form-check-input chkEstadoDe" id="chk' + orden +
                '" ' + _checknew + ' ' + _deshabilitachk + ' value=' + orden + '/></div></td>'        
        _output += '<td style="display: none;">' + estado + ' <input type="hidden" name="hidden_estado[]" id="txtEstado' + orden + '" value="'+ estado + '" /></td>';
        _output += '<td><div class="text-center"><div class="btn-group">'
        _output += '<button type="button" name="btnUp" class="btn btn-outline-primary btn-sm btnUp" ' + _deshabilitar + ' id="btnUp' + orden + '"><i class="fa fa-arrow-up"></i></button>';
        _output += '<button type="button" name="btnEdit" class="btn btn-outline-info btn-sm ml-3 btnEdit" data-toggle="tooltip" data-placement="top" title="editar" id="' + orden + '"><i class="fa fa-pencil-square-o"></i></button>';
        _output += '<button type="button" name="btnDelete" class="btn btn-outline-danger btn-sm ml-3 btnDelete" ' + _deshabilitae + ' id="'+ orden + '"><i class="fa fa-trash-o"></i></button></div></div></td>';
        $('#row_' + orden + '').html(_output);

    }

    function FunOrderLast(orden,detalle,valorv,valori,estado,padeid)
    {        

        _deshabilitar = '';

        if(estado == 'Activo'){
            _checknew = 'checked';
        }else{
            _checknew = ' ';
        }

        if(padeid != 0){
            _deshabilitae = 'disabled';
            _deshabilitachk = '';
        }else{
            _deshabilitae = '';
            _deshabilitachk = 'disabled';
        }  

        _resultado = _result.find(d => d.arrydetalle == detalle);
        _resultado['arryorden'] = parseInt(orden);

        _output = '<td style="display: none;>' + orden + ' <input type="hidden" name="hidden_orden[]" id="orden' + orden + '" value="'+ orden + '" /></td>';
        _output += '<td>' + detalle + ' <input type="hidden" name="hidden_detalle[]" id="txtDetalle' + orden + '" value="' + detalle + '" /></td>';
        _output += '<td class="text-center">' + valorv + ' <input type="hidden" name="hidden_valorv[]" id="txtValorv' + orden + '" value="'+ valorv + '" /></td>';
        _output += '<td class="text-center">' + valori + ' <input type="hidden" name="hidden_valori[]" id="txtValori' + orden + '" value="'+ valori + '" /></td>';
        _output += '<td><div class="text-center"><input type="checkbox" class="form-check-input chkEstadoDe" id="chk' + orden +
                '" ' + _checknew + ' ' + _deshabilitachk + ' value=' + orden + '/></div></td>'        
        _output += '<td style="display: none;>' + estado + ' <input type="text" name="hidden_estado[]" id="txtEstado' + orden + '" value="'+ estado + '" /></td>';
        _output += '<td><div class="text-center"><div class="btn-group">'
        _output += '<button type="button" name="btnUp" class="btn btn-outline-primary btn-sm btnUp" ' + _deshabilitar + ' id="btnUp' + orden + '"><i class="fa fa-arrow-up"></i></button>';
        _output += '<button type="button" name="btnEdit" class="btn btn-outline-info btn-sm ml-3 btnEdit" data-toggle="tooltip" data-placement="top" title="editar" id="' + orden + '"><i class="fa fa-pencil-square-o"></i></button>';
        _output += '<button type="button" name="btnDelete" class="btn btn-outline-danger btn-sm ml-3 btnDelete" ' + _deshabilitae + ' id="'+ orden + '"><i class="fa fa-trash-o"></i></button></div></div></td>';
        $('#row_' + orden + '').html(_output);

    }

    function FunOrderDelete(ordenx,rowmod,detalle,valorv,valori,estado,padeid)
    {        
        if(ordenx == 1){
            _deshabilitar  = 'disabled';
        }else{
            _deshabilitar = '';
        }

        if(estado == 'Activo'){
            _checknew = 'checked';
        }else{
            _checknew = '';
        }

        if(padeid != 0){
            _deshabilitae = 'disabled';
            _deshabilitachk = '';
            
        }else{
            _deshabilitae = '';
            _deshabilitachk = 'disabled';
        } 

        _output = '<td>' + ordenx + ' <input type="hidden" name="hidden_orden[]" id="orden' + ordenx + '" value="'+ ordenx + '" /></td>';
        _output += '<td>' + detalle + ' <input type="hidden" name="hidden_detalle[]" id="txtDetalle' + ordenx + '" value="' + detalle + '" /></td>';
        _output += '<td class="text-center">' + valorv + ' <input type="hidden" name="hidden_valorv[]" id="txtValorv' + ordenx + '" value="'+ valorv + '" /></td>';
        _output += '<td class="text-center">' + valori + ' <input type="hidden" name="hidden_valori[]" id="txtValori' + ordenx + '" value="'+ valori + '" /></td>';
        _output += '<td><div class="text-center"><input type="checkbox" class="form-check-input chkEstadoDe" id="chk' + ordenx +
                '" ' + _checknew + ' ' + _deshabilitachk + ' value=' + ordenx + '/></div></td>'        
        _output += '<td>' + estado + ' <input type="text" name="hidden_estado[]" id="txtEstado' + ordenx + '" value="'+ estado + '" /></td>';
        _output += '<td><div class="text-center"><div class="btn-group">'
        _output += '<button type="button" name="btnUp" class="btn btn-outline-primary btn-sm btnUp" ' + _deshabilitar + ' id="btnUp' + ordenx + '"><i class="fa fa-arrow-up"></i></button>';
        _output += '<button type="button" name="btnEdit" class="btn btn-outline-info btn-sm ml-3 btnEdit" data-toggle="tooltip" data-placement="top" title="editar" id="' + ordenx + '"><i class="fa fa-pencil-square-o"></i></button>';
        _output += '<button type="button" name="btnDelete" class="btn btn-outline-danger btn-sm ml-3 btnDelete" ' + _deshabilitae + ' id="'+ ordenx + '"><i class="fa fa-trash-o"></i></button></div></div></td>';
        $('#row_' + rowmod + '').html(_output);
        console.log(_output);
    }

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
            data: {nomparametro:_nomparametro, descripcion:_descripcion, result:_result, estado:_estadocab, id:_id, opcion:1},            
            success: function(data){
            
                if(data == '0'){

                    $.redirect('parametroadmin.php', {'mensaje': 'Grabado con Exito..!!'}); 
                }else{
                
                    mensajesalertify("Nombre del Parámetro ya Existe..!","E","bottom-right",5);
                }                
            },
            error: function (error) {
                console.log(error);
            }                            
        }); 

    });


    $(document).on("click","#btnEliminarEdit",function(e){        
        _fila = $(this); 
        _row = $(this).closest('tr');  
        _data = $('#tabledata').dataTable().fnGetData(_row);
        _id = _data[0];
        _opcion = 1;
        _menu = _data[1];
        //DeletePara();
    });    

    /*function DeletePara(){    
        alertify.confirm('El Registro sera eliminado..!!', 'Esta seguro de eliminar el parametro..?', function(){ //alertify.success('Ok') 

            $.ajax({
                url: "../db/parametrocrud.php",
                type: "POST",
                dataType: "json",
                data: {id : _id, opcion : _opcion},
                success: function(data){
                    if(data == 'NO'){                                
                        mensajesalertify("Menu no se puede Eliminar, Tiene Tareas Asociadas..!","E","bottom-right",5);
                    }       
                    else {
                    
                        TableNoOrder.row(_fila.parents('tr')).remove().draw();
                        mensajesalertify("Registro Eliminado..!","S","bottom-center",5);
                    }
                },
                error: function (error) {
                    console.error(error);
                }                  
            });
            
        }
        , function(){});
    }*/

});




