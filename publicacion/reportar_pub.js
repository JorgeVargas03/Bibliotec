
var idComentario = 0;
//var contenido = "";
var conteoRep = 0;


const pub = document.querySelector('#reportarPub');//boton de reportar publicacion
const com = document.querySelectorAll('#reportarCom');//boton de reportar en los comentarios

com.forEach(function(coms){
    coms.addEventListener('click',function(){
        //contenido = "comentario";
        idComentario = parseInt($(this).data('comid'));
    });
});


$('#subir_reporte_p').click(function(){
    var motivo = $('.form-select').val();
    //console.log(motivo);
    if(motivo ==="Seleccionar"){
        alert("Seleccione un motivo por favor");
    }else{
        $.ajax({
            URL: "publicacion_detalle.php",
            method: "POST",
            data: {repPub:1,motivo:motivo},
            succes:function(){
                $('.modal').modal('hide');
                alert("Reporte realizado con exito");
            }
        });
    }
});

$('#subir_reporte_c').click(function(){
    var motivo = $('.form-select').val();
    //console.log(motivo);
    //console.log(idContenido);
    if(motivo ==="Seleccionar"){
        alert("Seleccione un motivo por favor");
    }else{
        $.ajax({
            URL: "publicacion_detalle.php",
            method: "POST",
            data: {repCom:1,motivo:motivo,idComentario:idComentario},
            succes:function(){
                $('.modal').modal('hide');
                alert("Reporte realizado con exito");
            }
        });
    }
});

