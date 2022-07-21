$(document).ready(function(){

    $('.sortable').sortable({       
        update: function (event, ui) {
            $(this).children().each(function (index) {                    
                if ($(this).attr('data-position') != (index+1)) {
                    $(this).attr('data-position', (index+1)).addClass('updated');
                }
            });

            guardandoPosiciones();
        }
    });

    function guardandoPosiciones() {
        var positions = [];
        $('.updated').each(function () {
           positions.push([$(this).attr('data-index'), $(this).attr('data-position')]);
           $(this).removeClass('updated');
        });

        /*$.ajax({
           url: '../db/consultadatos.php',
           method: 'POST',
           dataType: 'text',
           data: {
               tipo: 50,
               update: 1,
               positions: positions
           }, success: function (response) {
                console.log(response);
           }
        });*/

        $.ajax({
            url: '../db/ordenar_menu.php',
            method: 'POST',
            dataType: 'json',
            data: {tipo: 0, orden: positions }, 
            success: function (response) {
                 //console.log(response);
            }
         });        
    }



});