/*=============================================
EDITAR TIPOPREGUNTA
=============================================*/

$(document).on("click",".btnEditarTipopregunta", function(){

 var idTipopregunta=$(this).attr("idTipopregunta");
 //console.log("idUsuario",idUsuario);

 var datos = new FormData();

datos.append("idTipopregunta",idTipopregunta);  //$post ,nombre ded la variable

$.ajax({
  url:"ajax/tipopregunta.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta){
      //console.log("respuesta",respuesta);
     $("#descripcion").val(respuesta["descripcion"]);
     $("#accion").val("EditarTipopregunta");
     $("#titleTipopregunta").html("Editar Tipo de Pregunta");
     $("#idTipopregunta").val(idTipopregunta);

  }

});

})

/*=============================================
ELIMINAR TIPOPREGUNTA
=============================================*/
$(document).on("click", ".btnEliminarTipopregunta", function(){

  var idTipopregunta = $(this).attr("idTipopregunta");
  
  swal({
    title: '¿Está seguro de borrar el tipo de pregunta?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar tipo de pregunta!'
  }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=tipopregunta&idTipopregunta="+idTipopregunta;

    }

  })

})


















