$(document).ready(function(){

    var _estado, _opcion, _cbocedente,_cedente, _id;

    $("#exampleModal").draggable({
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
       
        $("#header").css("background-color","#183456");
        $("#header").css("color","white");
        $(".modal-title").text("Nuevo Registro");  
        $("#superModal").modal("show");
       
    });

    
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
                
                _boton = '<td><div class="text-center"><div class="btn-group"><button class="btn btn-outline-info btn-sm ml-3"' +
                         'id="btnEditar"><i class="fa fa-pencil-square-o"></i></button><button class="btn btn-outline-danger btn-sm ml-3"'+
                         'id="btnEliminar"><i class="fa fa-trash-o"></i></button><button class="btn btn-outline-danger btn-sm ml-3"'+
                         'id="btnEliminar"><i class="fa fa-pencil-square-o"></i></button></div></div></td>'   

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


});