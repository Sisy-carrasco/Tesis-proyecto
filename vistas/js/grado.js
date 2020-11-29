/*=============================================
EDITAR GRADO
=============================================*/

$(document).on("click",".btnEditarGrado", function(){

 var idGrado=$(this).attr("idGrado");
 //console.log("idUsuario",idUsuario);

 var datos = new FormData();

datos.append("idGrado",idGrado);  //$post ,nombre ded la variable

$.ajax({
  url:"ajax/grado.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta){
      //console.log("respuesta",respuesta);
     $("#nombre").val(respuesta["nombre"]);
     $("#accion").val("EditarGrado");
     $("#titleGrado").html("Editar Grado");
     $("#idGrado").val(idGrado);

  }

});

})

/*=============================================
ELIMINAR GRADO
=============================================*/
$(document).on("click", ".btnEliminarGrado", function(){

  var idGrado = $(this).attr("idGrado");
  
  swal({
    title: '¿Está seguro de borrar el grado?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar grado!'
  }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=grado&idGrado="+idGrado;

    }

  })

})


















