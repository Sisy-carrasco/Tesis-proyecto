/*=============================================
EDITAR SESION
=============================================*/

$(document).on("click",".btnEditarSesion", function(){

 var idSesion=$(this).attr("idSesion");
 //console.log("idUsuario",idUsuario);

 var datos = new FormData();

datos.append("idSesion",idSesion);  //$post ,nombre ded la variable

$.ajax({
  url:"ajax/sesion.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta){
      
     $("#descripcion").val(respuesta["descripcion"]);
     $("#competencias").val(respuesta["competencias"]);
     $("#capacidades").val(respuesta["id_capacidades"]);
     $("#idUnidad").val(respuesta["id_unidad"]);
     $("#intervalo_puntaje_capacidades").val(respuesta["intervalo_puntaje_capacidades"]);
     $("#numero").val(respuesta["numero"]);
     $("#duracion").val(respuesta["duracion"]);
     $("#accion").val("EditarSesion");
     $("#titleSesion").html("Editar Sesion");
     $("#idSesion").val(idSesion);

  }

});

})

/*=============================================
ELIMINAR SESION
=============================================*/
$(document).on("click", ".btnEliminarSesion", function(){

  var idSesion = $(this).attr("idSesion");
  
  swal({
    title: '¿Está seguro de borrar la sesion?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar sesion!'
  }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=sesion&idSesion="+idSesion;

    }

  })

})


$(document).on("click",".btnMostrarSesion", function(){

  var idSesion=$(this).attr("idSesion");
  //console.log("idUsuario",idUsuario);
 
  var datos = new FormData();
 
 datos.append("idSesion",idSesion);  //$post ,nombre ded la variable
 
 $.ajax({
   url:"ajax/sesion.ajax.php",
     method: "POST",
     data: datos,
     cache: false,
     contentType: false,
     processData: false,
     dataType: "json",
     success: function(respuesta){
       //console.log("respuesta",respuesta);
      $("#descripcion").val(respuesta["descripcion"]);
      $("#competencias").val(respuesta["competencias"]);
      $("#capacidades").val(respuesta["capacidades"]);
      $("#idUnidad").val(respuesta["id_unidad"]);
      $("#intervalo_puntaje_capacidades").val(respuesta["intervalo_puntaje_capacidades"]);
      $("#numero").val(respuesta["numero"]);
      $("#duracion").val(respuesta["duracion"]);
      $("#accion").val("EditarSesion");
      $("#titleSesion").html("Mostrar Sesion");
      $("#idSesion").val(idSesion);
 
   }
 
 });
 
 })















