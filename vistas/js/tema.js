/*=============================================
EDITAR TEMA
=============================================*/

$(document).on("click",".btnEditarTema", function(){

 var idTema=$(this).attr("idTema");
 //console.log("idUsuario",idUsuario);

 var datos = new FormData();

datos.append("idTema",idTema);  //$post ,nombre ded la variable

$.ajax({
  url:"ajax/tema.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta){
      //console.log("respuesta",respuesta);
     $("#nombre").val(respuesta["descripcion"]);
     $("#idUnidad").val(respuesta["id_unidad"]);
     $("#accion").val("EditarTema");
     $("#titleTema").html("Editar Tema");
     $("#idTema").val(idTema);

  }

});

})

/*=============================================
ELIMINAR TEMA
=============================================*/
$(document).on("click", ".btnEliminarTema", function(){

  var idTema = $(this).attr("idTema");
  
  swal({
    title: '¿Está seguro de borrar el tema?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar tema!'
  }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=tema&idTema="+idTema;

    }

  })

})


















