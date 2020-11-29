/*=============================================
EDITAR CALIFICACION
=============================================*/

$(document).on("click",".btnEditarCalificacion", function(){

 var idCalificacion=$(this).attr("idCalificacion");
 //console.log("idUsuario",idUsuario);

 var datos = new FormData();

datos.append("idCalificacion",idCalificacion);  //$post ,nombre ded la variable

$.ajax({
  url:"ajax/calificacion.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta){
      //console.log("respuesta",respuesta);
     $("#letra").val(respuesta["letra"]);
     $("#valorMinimo").val(respuesta["valor_minimo"]);
     $("#valorMaximo").val(respuesta["valor_maximo"]);
     $("#accion").val("EditarCalificacion");
     $("#titleCalificacion").html("Editar Calificacion");
     $("#idCalificacion").val(idCalificacion);

  }

});

})

/*=============================================
ELIMINAR CALIFICACION
=============================================*/
$(document).on("click", ".btnEliminarCalificacion", function(){

  var idCalificacion = $(this).attr("idCalificacion");
  
  swal({
    title: '¿Está seguro de borrar la clasificacion?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar calificacion!'
  }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=calificacion&idCalificacion="+idCalificacion;

    }

  })

})


















