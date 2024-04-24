$(document).ready(function(){
    var idpub=0;
    $("idEliminar").click(function(){
        idpub = parseInt($(this).data('ibpub'));
    })
    $("#ConfirmarEliminar").click(function(){
        $.ajax({
            url:"../../publicacion/eliminar_publicacion.php",
            method:"POST",
            DATA:{Confirmar:1,idpub:idpub},
            success:function(){
                alert("si");
                $('.modal').modal('hide');
            }
        })
    })
})