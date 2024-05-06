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
                alert("Publicacion eliminada de manera exitosa");
                $('.modal').modal('hide');
            }
        })
    })

    $("#idEliminar2").click(function(){
        idpub = parseInt($(this).data('idpub'));
    })
    $("#ConfirmarEliminar2").click(function(){
        console.log(idpub);
        $.ajax({
            url:"../../publicacion/eliminar_publicacion.php",
            method:"POST",
            data:{Confirmar:1,idpub:idpub},
            success:function(){
                alert("Publicacion eliminada de manera exitosa");
                $('.modal').modal('hide');
            }
        })
    })
})

