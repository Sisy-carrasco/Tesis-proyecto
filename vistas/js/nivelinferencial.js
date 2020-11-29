/*=============================================
EDITAR Nivelinferencial
=============================================*/

$(document).on("click",".btnEditarNivelinferencial", function(){

 var idNivelinferencial=$(this).attr("idNivelinferencial");
 //console.log("idUsuario",idUsuario);

 var datos = new FormData();

datos.append("idNivelinferencial",idNivelinferencial);  //$post ,nombre ded la variable

$.ajax({
  url:"ajax/nivelinferencial.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta){
      //console.log("respuesta",respuesta);
     $("#descripcion").val(respuesta["descripcion"]);
     $("#accion").val("EditarNivelinferencial");
     $("#titleNivelinferencial").html("Editar Nivel inferencial");
     $("#idNivelinferencial").val(idNivelinferencial);

  }

});

})

/*=============================================
ELIMINAR Nivelinferencial
=============================================*/
$(document).on("click", ".btnEliminarNivelinferencial", function(){

  var idNivelinferencial = $(this).attr("idNivelinferencial");
  
  swal({
    title: '¿Está seguro de borrar el nivel inferencial?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar nivel inferencial!'
  }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=nivelinferencial&idNivelinferencial="+idNivelinferencial;

    }

  })

})


















