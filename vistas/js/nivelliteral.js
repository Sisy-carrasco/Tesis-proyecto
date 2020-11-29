/*=============================================
EDITAR Nivelliteral
=============================================*/

$(document).on("click",".btnEditarNivelliteral", function(){

 var idNivelliteral=$(this).attr("idNivelliteral");
 //console.log("idUsuario",idUsuario);

 var datos = new FormData();

datos.append("idNivelliteral",idNivelliteral);  //$post ,nombre ded la variable

$.ajax({
  url:"ajax/nivelliteral.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta){
      //console.log("respuesta",respuesta);
     $("#descripcion").val(respuesta["descripcion"]);
     $("#accion").val("EditarNivelliteral");
     $("#titleNivelliteral").html("Editar Nivel literal");
     $("#idNivelliteral").val(idNivelliteral);

  }

});

})

/*=============================================
ELIMINAR Nivelliteral
=============================================*/
$(document).on("click", ".btnEliminarNivelliteral", function(){

  var idNivelliteral = $(this).attr("idNivelliteral");
  
  swal({
    title: '¿Está seguro de borrar el nivel literal?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar nivel literal!'
  }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=nivelliteral&idNivelliteral="+idNivelliteral;

    }

  })

})


















