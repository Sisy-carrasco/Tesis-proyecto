/*=============================================
EDITAR GRADO
=============================================*/

$(document).on("click",".btnEditarSeccion", function(){

 var idSeccion=$(this).attr("idSeccion");

 var datos = new FormData();

datos.append("idSeccion",idSeccion);  //$post ,nombre ded la variable

$.ajax({
  url:"ajax/seccion.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta){
      //console.log("respuesta",respuesta);
     $("#nombre").val(respuesta["nombre"]);
     $("#idGrado").val(respuesta["id_grado"]);
     $("#descripcion").val(respuesta["descripcion"]);
     $("#accion").val("EditarSeccion");
     $("#titleSeccion").html("Editar Seccion");
     $("#idSeccion").val(idSeccion);

  }

});

})

/*=============================================
ELIMINAR SECCION
=============================================*/
$(document).on("click", ".btnEliminarSeccion", function(){

  var idSeccion = $(this).attr("idSeccion");
  
  swal({
    title: '¿Está seguro de borrar la seccion?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar seccion!'
  }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=seccion&idSeccion="+idSeccion;

    }

  })

})


















