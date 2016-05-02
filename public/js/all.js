//pega a var de token para passar nos ajax
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

function busca_sub_categorias(){
    $.ajax({
        type : "POST",
        url : "/ajax/subcategorias_listar",
        data : { categoria_id : $('#categoria').val(), _token: CSRF_TOKEN },
        success : function(data){

            $("#subcategoria").html("<option value=''>Selecione</option>");

            for(subcategoria in data) {
                $("#subcategoria").append("<option value='" + data[subcategoria].id + "'>" + data[subcategoria].nome + "</option>");
            }

        }
    });
}

$(function(){

    if($('#categoria').val() != undefined && $('#subcategoria').val() != undefined){
        if($('#categoria').val().length > 0 && $('#subcategoria').val().length == 0){
           busca_sub_categorias();
        }
    }
    $('#categoria').change(function(){
       busca_sub_categorias();
    });

    setTimeout(function(){
        $('#notificacao').slideUp();
    }, 1500);

});
//# sourceMappingURL=all.js.map
