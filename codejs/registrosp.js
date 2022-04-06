$(document).ready(function(){

    var _estado, _opcion, _cbocedente,_cedente, _id, _gestor, _estadoges, _countgestor = 0,
    _resultges =[], _usuaid, _cedeid, _idsuper, _fila;

    $("#exampleModal").draggable({
        handle: ".modal-header"
    });
    $("#modalGestor").draggable({
        handle: ".modal-header"
    });     

    // $('#cboCedente').select2();
    // $('#cboSupervisor').select2();
    // $('#cboGestor').select2();
    $('#cboCedente2').select2();
    $('#cboSupervisor2').select2();

    $("#cboCedente").select2({
        dropdownParent: $("#superModal")
    }); 
    $("#cboSupervisor").select2({
        dropdownParent: $("#superModal")
    }); 
    $("#cboGestor").select2({
        dropdownParent: $("#modalGestor")
    });        


    //agregar-modal

    $("#btnAddSu").click(function(){
        $("#formSuper").trigger("reset");
        
        _id = 0;
        _opcion = 0;
        _estado = 'Activo';


        $('#cboCedente').val('0').change();
        $('#cboSupervisor').val('0').change();
        $("#header").css("background-color","#BCBABE");
        $("#header").css("color","black");
        $(".modal-title").text("Nuevo Registro");  
        $("#superModal").modal("show");
       
    });

    //Grabar Supervisor directo Base de Datos
    $("#formSuper").submit(function(e){
        e.preventDefault();
        //debugger;
        _cbocedente = $.trim($("#cboCedente").val());  
        _cedente = $("#cboCedente option:selected").text(); 
        _cbosuper = $.trim($("#cboSupervisor").val());  
        _supervisor = $("#cboSupervisor option:selected").text(); 

        if(_cbocedente == '0')
        {                   
            mensajesalertify("Seleccione Cedente..!","W","top-right",5);  
            return;
        }

        if(_cbosuper == '0')
        {                   
            mensajesalertify("Seleccione Supervisor..!","W","top-right",5);  
            return;
        }        

        $.ajax({
            url: "../db/registrocrudsp.php",
            type: "POST",
            dataType: "json",
            data: {idsupervisor: _cbosuper, idcedente: _cbocedente, estado: _estado, opcion: 0},
            success: function(data){    
                _supeid = data[0].IdSupe;
                _cedid = data[0].IdCede;
                _cede = data[0].Cedente;
                _supe = data[0].Supervisor;
                _estado = data[0].Estado;

                _checked = '';

                if(_estado == 'Activo'){
                    _checked = 'checked';
                } 

                _chekestado = '<td><div class="text-center"><input type="checkbox" class="form-check-input chkEstadoSu" id="chk' + _supeid +
                                '" ' + _checked + ' value=' + _supeid + '/></div></td>';
                
                _boton = '<td><div class="text-center"><div class="btn-group"><button class="btn btn-outline-primary btn-sm ml-3 btnAddGe"' +
                         'id="btnAddGe' + _supeid + '"><i class="fa fa-headphones"></i></button><button class="btn btn-outline-danger btn-sm ml-3"'+
                         'id="btnEliminarSu" data-toggle="tooltip" data-placement="top" title="eliminar"><i class="fa fa-trash-o"></i></button></div></div></td>'   

                TableDataSup.row.add([_supeid, _cedid,  _cede, _supe, _boton, _chekestado]).draw();
              
                // mensajesalertify("Grabado Correctamente..!","S","top-center",5);  

                /*$("#cboCedente").val('0');
                $("#cboSupervisor").val('0');*/

                $("#superModal").modal("hide");               
            },
            error: function (error) {
                console.log(error);
            }
        });
       
    });
    
    //Eliminar Supervisor
    $(document).on("click","#btnEliminarSu",function(e){
        _fila = $(this);  
        _row = $(this).closest('tr');
        _data = $('#tabledatasup').dataTable().fnGetData(_row);
        _idsuper = _data[0];
        _supervisor = _data[3]; 
        DeleteSuper(); 
    });

    function DeleteSuper(){
       
        alertify.confirm('El Supervisor sera eliminado..!!', 'Esta seguro de eliminar' + ' ' + _supervisor + '..?', function(){        
           $.ajax({
               url: "../db/registrocrudsp.php",
               type: "POST",
               dataType: "json",
               data: {idsupervisor: _idsuper, opcion: 3},                        
               success: function(data){
                   if(data[0].Respuesta == "Existe"){
                       mensajesalertify("No se puede Eliminar, Tiene Gestores Asociados..!","W","top-right",5);  
                   }       
                   else {
                    TableDataSup.row(_fila.parents('tr')).remove().draw();
                    mensajesalertify("Supervisor Eliminado","E","top-center",5);
                   }                            
               },
               error: function (error) {
                   console.log(error);
               }                  
           });              
        },        
        function(){});
    }

       //Modal Agregar-Gestor

    $(document).on("click",".btnAddGe",function(){

        $("#formGestor").trigger("reset"); 
        _row = $(this).closest('tr');
        
        _data = $('#tabledatasup').dataTable().fnGetData(_row);

        _usuaid = _data[0];
        _cedeid = _data[1];

        $("#tblagestor").empty();

        _output = '<thead>';
        _output += '<tr><th style="display: none;">Id</th>';
        _output += '<th>Gestor</th><th style="width:12% ; text-align: center">Opciones</th><th style="width:10% ; text-align: center">Estado</th></tr></thead>'
        $('#tblagestor').append(_output); 

        _output  = '<tbody>';
        $('#tblagestor').append(_output);         

        $.ajax({
            url: "../db/consultadatos.php",
            type: "POST",
            dataType: "json",
            data: {tipo:39, auxv1: "", auxv2: "", auxv3: "", auxv4: "", auxv5: "", auxv6: "", auxi1: _cedeid, auxi2: _usuaid, auxi3:0, auxi4:0, 
            auxi5:0, auxi6:0, opcion:0},
            success: function(data){
                $.each(data,function(i,item){                    
                    _id = data[i].Id;
                    _gestor = data[i].Gestor;
                    _estado = data[i].Estado;

                    _newestado = _estado=='A' ? 'checked' : '';

                    _output = '<tr id="rowges_' + _id + '">';
                    _output += '<td style="display: none;">' + _id + ' <input type="hidden" name="hidden_id[]" id="txtId' + _id + '" value="' + _id + '" /></td>';
                    _output += '<td>' + _gestor + ' <input type="hidden" name="hidden_gestor[]" id="txtGestor' + _id + '" value="' + _gestor + '" /></td>';
                    _output += '<td><div class="text-center"><div class="btn-group"><button type="button" class="btn btn-outline-danger btn-sm ml-3 btnDel" data-toggle="tooltip" data-placement="top" title="eliminar" id="btnEli' + _id + '"><i class="fa fa-trash-o"></i></button></div></div></td>';
                    _output += '<td class="text-center">' + ' <input type="checkbox"' + _newestado + ' class="form-check-input chkEstado" id="chk' + _id + '" /></td>';
                    $('#tblagestor').append(_output); 
                });
            },
            error: function (error) {
                console.log(error);
            }                  
        }); 

        _output  = '</tbody>';
        $('#tblagestor').append(_output);          
           
        // $('#hidden_row_id').val(row_id);
        $("#headercat").css("background-color","#BCBABE");
        $("#headercat").css("color","black");
        $(".modal-title").text("Agregar Gestor");       
        //$("#btnAddGestor").text("Guardar");
        $("#modalGestor").modal("show");

    });

    //UPDATE ESTADO GESTOR MODAL

    $(document).on("click",".chkEstado",function(){    
        let _rowid = $(this).attr("id");
        let _idgestor = $('#txtId' + _rowid.substring(3) + '').val();
        let _check = $("#chk" + _idgestor).is(":checked");
        let _estadochk;

        if(_check)
        {
            _estadochk = 'A';
        }else{
            _estadochk = 'I';
        } 
        
        $.ajax({
            url: "../db/registrocrudsp.php",
            type: "POST",
            dataType: "json",
            data: {idgestor: _idgestor, estado: _estadochk, opcion: 2},
            success: function(data){
               
            },
            error: function (error) {
                console.log(error);
            }                 
        });
    });

     //UPDATE ESTADO SUPERVISOR TABLA

     $(document).on("click",".chkEstadoSu",function(){ 
        let _rowid = $(this).attr("id");
        let _idsuper = _rowid.substring(3);
        let _check = $("#chk" + _idsuper).is(":checked");
        let _estadosuper;

        let  _row = $(this).closest('tr');
        let _data = $('#tabledatasup').dataTable().fnGetData(_row);
        let _cedeid = _data[1];


        if(_check){
            _estadosuper = 'Activo';
            $("#btnAddGe" + _idsuper).prop("disabled", "");
           
        }else{
            _estadosuper = 'Inactivo';
            $("#btnAddGe" + _idsuper).prop("disabled", "disabled");
        }

        $.ajax({
            url: "../db/registrocrudsp.php",
            type: "POST",
            dataType: "json",
            data: {idsupervisor: _idsuper,idcedente:_cedeid, estado: _estadosuper, opcion: 5},
            success: function(data){
               
            },
            error: function (error) {
                console.log(error);
            }                 
        });

    });

  
   //INSERTAR GESTOR BASE DE DATOS

    $(document).on("click","#btnGestor", function(){
        //debugger;
        _cbogestor = $('#cboGestor').val();
        _gestor = $.trim($("#cboGestor option:selected").text()); 

        if(_cbogestor == '0')
        {
            mensajesalertify("Seleccione Gestor..!","W","top-right",5);
            return;
        }

        $.ajax({
            url: "../db/registrocrudsp.php",
            type: "POST",
            dataType: "json",
            data: {idsupervisor: _usuaid, idgestor: _cbogestor, estado: 'A', opcion: 1},
            success: function(data){
                if(data[0].Existe == 'Existe'){
                    mensajesalertify("Gestor ya esta Agregado..!","W","top-right",5);  
                }
                else{
                    $("#tblagestor").empty();

                    _output = '<thead>';
                    _output += '<tr><th style="display: none;">Id</th>';
                    _output += '<th>Gestor</th><th  style="width:12% ; text-align: center">Opciones</th><th style="width:10% ; text-align: center">Estado</th></tr></thead>'
                    $('#tblagestor').append(_output); 
            
                    _output  = '<tbody>';
                    $('#tblagestor').append(_output);  

                    $.each(data,function(i,item){      
                        _id = data[i].Id;
                        _gestor = data[i].Gestor;
                        _estado = data[i].Estado;
                        
                        _output = '<tr id="rowges_' + _id + '">';
                        _output += '<td style="display: none;">' + _id + ' <input type="hidden" name="hidden_id[]" id="txtId' + _id + '" value="' + _id + '" /></td>';
                        _output += '<td>' + _gestor + ' <input type="hidden" name="hidden_gestor[]" id="txtGestor' + _id + '" value="' + _gestor + '" /></td>';
                        _output += '<td><div class="text-center"><div class="btn-group"><button type="button" class="btn btn-outline-danger btn-sm ml-3 btnDel" id="btnEli' + _id + '"><i class="fa fa-trash-o"></i></button></div></div></td>';
                        _output += '<td class="text-center">' + ' <input type="checkbox" checked class="form-check-input chkEstado" id="chk' + _id + '" /></td>';
                        $('#tblagestor').append(_output); 
                    });
                    
                    _output  = '</tbody>';
                    $('#tblagestor').append(_output);                     
                }
            },
            error: function (error) {
                console.log(error);
            }                  
        }); 

        $('#cboGestor').val('0').change();

    });


    /*Eliminar Gestor */

    $(document).on("click",".btnDel",function(){    
        let _rowid = $(this).attr("id");
        let _idgestor = $('#txtId' + _rowid.substring(6) + '').val();
        let _gestor = $('#txtGestor' + _idgestor).val();

        alertify.confirm('El Gestor sera eliminado..!!', 'Esta seguro de eliminar' + ' ' + _gestor + '..?', function(){       
            
            $.ajax({
                url: "../db/registrocrudsp.php",
                type: "POST",
                dataType: "json",
                data: {idsupervisor: _usuaid, idgestor: _idgestor, opcion: 4},
                success: function(data){
                    
                    $("#tblagestor").empty();

                    _output = '<thead>';
                    _output += '<tr><th style="display: none;">Id</th>';
                    _output += '<th>Gestor</th><th style="text-align: center;">Estado</th><th style="text-align: center;">Acciones</th></tr></thead>'
                    $('#tblagestor').append(_output); 
            
                    _output  = '<tbody>';
                    $('#tblagestor').append(_output);  

                    $.each(data,function(i,item){      
                        _id = data[i].Id;
                        _gestor = data[i].Gestor;
                        _estado = data[i].Estado;
                        
                        _output = '<tr id="rowges_' + _id + '">';
                        _output += '<td style="display: none;">' + _id + ' <input type="hidden" name="hidden_id[]" id="txtId' + _id + '" value="' + _id + '" /></td>';
                        _output += '<td>' + _gestor + ' <input type="hidden" name="hidden_gestor[]" id="txtGestor' + _id + '" value="' + _gestor + '" /></td>';
                        _output += '<td class="text-center">' + ' <input type="checkbox" checked class="form-check-input chkEstado" id="chk' + _id + '" /></td>';
                        _output += '<td><div class="text-center"><div class="btn-group"><button type="button" class="btn btn-outline-danger btn-sm ml-3 btnDel" id="btnEli' + _id + '"><i class="fa fa-trash-o"></i></button></div></div></td>';
                        $('#tblagestor').append(_output); 
                    });

                    _output  = '</tbody>';
                    $('#tblagestor').append(_output); 
                    mensajesalertify("Gestor Eliminado","E","top-center",5);	                      
                },
                error: function (error) {
                    console.log(error);
                }                 
            });
         },        
         function(){}); 
    });    

});