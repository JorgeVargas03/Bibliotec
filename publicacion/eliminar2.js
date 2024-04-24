$(document).ready(function(){
    var idpub=0;
    $("#idEliminar").click(function(){
        idpub = parseInt($(this).data('idpub'));
    })
    $("#ConfirmarEliminar").click(function(){
        console.log(idpub);
        $.ajax({
            url:"../../publicacion/eliminar_publicacion.php",
            method:"POST",
            data:{Confirmar:1,idpub:idpub},
            success:function(){
                alert("si");
                $('.modal').modal('hide');
            }
        })
    })
})