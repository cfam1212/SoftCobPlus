$(document).ready(function(){

    var _estado, _opcion, _cbocedente,_cedente, _id, _gestor,_estadoges,_countgestor = 0,
    _resultges =[],_usuaid,_cedeid;

    $("#exampleModal").draggable({
        handle: ".modal-header"
    });
    $("#modalGestor").draggable({
        handle: ".modal-header"
    });     

    $('#cboCedente').select2();
    $('#cboSupervisor').select2();
    $('#cboGestor').select2();
    $('#cboCedente2').select2();
    $('#cboSupervisor2').select2();

    //agregar-modal

    $("#btnAddSu").click(function(){
        $("#formSuper").trigger("reset");
        
        _id = 0;
        _opcion = 0;
        _estado = 'Activo';
       
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
            mensajesalertify("Seleccione Cedente..!","W","top-center",5);  
            return;
        }

        if(_cbosuper == '0')
        {                   
            mensajesalertify("Seleccione Supervisor..!","W","top-center",5);  
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
                
                _boton = '<td><div class="text-center"><div class="btn-group"><button class="btn btn-outline-success btn-sm ml-3"' +
                         'id="btnAddGe"><i class="fa fa-headphones"></i></button><button class="btn btn-outline-info btn-sm ml-3"'+
                         'id="btnEditarSu"><i class="fa fa-pencil-square-o"></i></button><button class="btn btn-outline-danger btn-sm ml-3"'+
                         'id="btnEliminarSu"><i class="fa fa-pencil-trash-o"></i></button></div></div></td>'   

                TableDataSup.row.add([_supeid, _cedid,  _cede, _supe,_estado, _boton]).draw();
              
                mensajesalertify("Grabado Correctamente..!","S","bottom-center",5);  

                $("#cboCedente").val('0');
                $("#cboSupervisor").val('0');

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
        _id = _data[0];
        _cede = $(this).closest("tr").find('td:eq(2)').text(); 
        _opcion = 1;
        DeleteSuper();        
    });

    function DeleteSuper(){
       
        alertify.confirm('El registro sera eliminado..!!', 'Esta seguro de eliminar' + ' ' + _cede + '..?', function(){ //alertify.success('Ok')        
           $.ajax({
               url: "../db/depacrud.php",
               type: "POST",
               dataType: "json",
               data: {id:_id, nomdepa:_depa, estado:_estado, opcion:1, tipo:_tipo},                        
               success: function(data){
                   console.log(data);
                   if(data[0].Valor == "Existe"){
                       mensajesalertify("Departamento no se puede Eliminar, está asociada a un Usuario..!","E","bottom-right",5);  
                   }       
                   else {
                       TableData.row(_fila.parents('tr')).remove().draw();
                       mensajesalertify("Registro Eliminado","E","bottom-center",5);
                   }                            
               },
               error: function (error) {
                   console.log(error);
               }                  
           });              
        },        
            function(){ /*alertify.error('eliminar cancelado')*/});
       }

       //Modal Agregar-Gestor

    $(document).on("click","#btnAddGe",function(){

        $("#formGestor").trigger("reset"); 
        _row = $(this).closest('tr');
        _data = $('#tabledatasup').dataTable().fnGetData(_row);

        _usuaid = _data[0];
        _cedeid = _data[1];
    
        $("#tblagestor").empty();

        _output = '<thead>';
        _output += '<tr><th style="display: none;">Id</th>';
        _output += '<th>Gestor</th><th style="text-align: center;">Estado</th><th style="text-align: center;">Acciones</th></tr></thead>'
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
                    _output += '<td class="text-center">' + ' <input type="checkbox"' + _newestado + ' class="form-check-input chkEstado" id="chk' + _id + '" /></td>';
                    _output += '<td><div class="text-center"><div class="btn-group"><button class="btn btn-outline-danger btn-sm ml-3 btnDel" id="btnEliminar' + _id + '"><i class="fa fa-trash-o"></i></button></div></div></td>';
                    $('#tblagestor').append(_output); 

                    console.log(_output);
                    
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

    $(document).on("click",".chkEstado",function(){    
        _rowid = $(this).attr("id");
        _idgestor = $('#txtId' + _rowid.substring(3) + '').val();
        _check = $("#chk"+_idgestor).is(":checked");

        if(_check)
        {
            alert('Activo');
        }else{
            alert('Inactivo');
        }        
    });

    $(document).on("click","#btnGestor", function(){
        //debugger;
        _cbogestor = $('#cboGestor').val();
        _gestor = $.trim($("#cboGestor option:selected").text()); 

        if(_cbogestor == '0')
        {
            mensajesalertify("Seleccione Gestor..!","W","top-center",5);
            return;
        }

        //INSERTAR EN LA TABLA EN UN AJAX


        $("#tblagestor").empty();

        _output = '<thead>';
        _output += '<tr><th style="display: none;">Id</th>';
        _output += '<th>Gestor</th><th style="text-align: center;">Estado</th><th style="text-align: center;">Acciones</th></tr></thead>'
        $('#tblagestor').append(_output); 

        _output  = '<tbody>';
                $('#tblagestor').append(_output);         
                $.ajax({
                    url: "../db/registrocrudsp.php",
                    type: "POST",
                    dataType: "json",
                    data: {opcion:1,supid:_usuaid,gestor:_cbogestor,estado:'A'},
                    success: function(data){
                                          
                            

                            _newestado = _estado=='A' ? 'checked' : '';

                            _output = '<tr id="rowges_' + _id + '">';
                            _output += '<td style="display: none;">' + _id + ' <input type="hidden" name="hidden_id[]" id="txtId' + _id + '" value="' + _id + '" /></td>';
                            _output += '<td>' + _gestor + ' <input type="hidden" name="hidden_gestor[]" id="txtGestor' + _id + '" value="' + _gestor + '" /></td>';
                            _output += '<td class="text-center">' + ' <input type="checkbox"' + _newestado + ' class="form-check-input chkEstado" id="chk' + _id + '" /></td>';
                            _output += '<td><div class="text-center"><div class="btn-group"><button class="btn btn-outline-danger btn-sm ml-3 btnDel" id="btnEliminar' + _id + '"><i class="fa fa-trash-o"></i></button></div></div></td>';
                            $('#tblagestor').append(_output); 

                            console.log(_output);
                            
                        
                                    
                    },
                    error: function (error) {
                        console.log(error);
                    }                  
                }); 

        _output  = '</tbody>';
        $('#tblagestor').append(_output);          

          
        $('#cboGestor').val('0').change();

    });

});