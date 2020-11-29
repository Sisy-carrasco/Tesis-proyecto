/*=============================================
EDITAR Curso
=============================================*/

$(document).on("click",".btnEditarCurso", function(){

 var idCurso=$(this).attr("idCurso");
 //console.log("idUsuario",idUsuario);

 var datos = new FormData();

datos.append("idCurso",idCurso);  //$post ,nombre ded la variable

$.ajax({
  url:"ajax/curso.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta){
      //console.log("respuesta",respuesta);
     $("#nombre").val(respuesta["nombre"]);
     $("#descripcion").val(respuesta["descripcion"]);
     $("#idGrado").val(respuesta["id_grado"]);
     $("#accion").val("EditarCurso");
     $("#titleCurso").html("Editar Curso");
     $("#idCurso").val(idCurso);
     if(respuesta["foto"] !=""){

      $(".previsualizar").attr("src",respuesta["foto"]);

     }
  }

});

})

/*=============================================
ELIMINAR Curso
=============================================*/
$(document).on("click", ".btnEliminarCurso", function(){

  var idCurso = $(this).attr("idCurso");
  
  swal({
    title: '¿Está seguro de borrar el curso?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar curso!'
  }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=curso&idCurso="+idCurso;

    }

  })

})


















