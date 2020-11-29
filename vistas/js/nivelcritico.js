/*=============================================
EDITAR Nivelcritico
=============================================*/

$(document).on("click",".btnEditarNivelcritico", function(){

 var idNivelcritico=$(this).attr("idNivelcritico");
 //console.log("idUsuario",idUsuario);

 var datos = new FormData();

datos.append("idNivelcritico",idNivelcritico);  //$post ,nombre ded la variable

$.ajax({
  url:"ajax/nivelcritico.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta){
      //console.log("respuesta",respuesta);
     $("#descripcion").val(respuesta["descripcion"]);
     $("#accion").val("EditarNivelcritico");
     $("#titleNivelcritico").html("Editar Nivel Critico");
     $("#idNivelcritico").val(idNivelcritico);

  }

});

})

/*=============================================
ELIMINAR Nivelcritico
=============================================*/
$(document).on("click", ".btnEliminarNivelcritico", function(){

  var idNivelcritico = $(this).attr("idNivelcritico");
  
  swal({
    title: '¿Está seguro de borrar el nivel critico?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar nivel critico!'
  }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=nivelcritico&idNivelcritico="+idNivelcritico;

    }

  })

})


















