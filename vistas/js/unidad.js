/*=============================================
EDITAR UNIDAD
=============================================*/

$(document).on("click",".btnEditarUnidad", function(){

 var idUnidad=$(this).attr("idUnidad");
 //console.log("idUsuario",idUsuario);

 var datos = new FormData();

datos.append("idUnidad",idUnidad);  //$post ,nombre ded la variable

$.ajax({
  url:"ajax/unidad.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta){
      //console.log("respuesta",respuesta);
     $("#descripcion").val(respuesta["descripcion"]);
     generarSesion(respuesta["id_unidad"],respuesta["id_sesion"]); 
     generarTema(respuesta["id_sesion"],respuesta["id_tema"]);
     $("#competencias").val(respuesta["competencias"]);
     $("#duracion").val(respuesta["duracion"]);
     $("#numero").val(respuesta["numero"]);
     $("#semestre").val(respuesta["id_bimestre"]);
     $("#idTema").val(respuesta["id_tema"]);
     $("#tema").val(respuesta["tema"]);
     $("#capacidades").val(respuesta["id_capacidades"]);
     $("#accion").val("EditarUnidad");
     $("#titleUnidad").html("Editar Unidad");
     $("#idUnidad").val(idUnidad);

  }

});

})

/*=============================================
ELIMINAR UNIDAD
=============================================*/
$(document).on("click", ".btnEliminarUnidad", function(){

  var idUnidad = $(this).attr("idUnidad");
  
  swal({
    title: '¿Está seguro de borrar la Unidad?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar unidad!'
  }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=unidad&idUnidad="+idUnidad;

    }

  })

})


$(document).on("click",".btnMostrarUnidad", function(){

  var idUnidad=$(this).attr("idUnidad");
  //console.log("idUsuario",idUsuario);
 
  var datos = new FormData();
 
 datos.append("idUnidad",idUnidad);  //$post ,nombre ded la variable
 
 $.ajax({
   url:"ajax/unidad.ajax.php",
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
      $("#duracion").val(respuesta["duracion"]);
      $("#numero").val(respuesta["numero"]);
      $("#semestre").val(respuesta["semestre"]);
      $("#idTema").val(respuesta["id_tema"]);
      $("#tema").val(respuesta["tema"]);
      $("#capacidades").val(respuesta["capacidades"]);
      $("#accion").val("EditarUnidad");
      $("#titleUnidad").html("Mostrar Unidad");
      $("#idUnidad").val(idUnidad);
 
   }
 
 });
 
 })
function generarSesion(id_unidad,id_sesion){
  var datos = new FormData();
  datos.append("idUnidad", id_unidad);

   $.ajax({
      url:"ajax/unidad.ajax.php",
      method:"POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success:function(respuesta){
      console.log("respuesta", respuesta);

        $("#idSesion").html(respuesta);
        $("#idSesion").val(id_sesion);
      }

  })
}

$(document).on("click", ".btnActivar", function(){
var idEstado = $(this).attr("idUnidad");
  var estadoUnidad = $(this).attr("estadoUnidad");

  var datos = new FormData();
  datos.append("activarId", idUnidad);
    datos.append("activarUnidad", estadoUnidad);

    $.ajax({

    url:"ajax/unidad.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){

        if(window.matchMedia("(max-width:767px)").matches){
    
           swal({
            title: "La unidad ha sido actualizado",
            type: "success",
            confirmButtonText: "¡Cerrar!"
          }).then(function(result) {
            
              if (result.value) {

              window.location = "unidad";

           }

          });


    }
      }

    })
if(estadoUnidad == 0){

      $(this).removeClass('btn-success');
      $(this).addClass('btn-danger');
      $(this).html('Desactivado');
      $(this).attr('estadoUnidad',1);

    }else{

      $(this).addClass('btn-success');
      $(this).removeClass('btn-danger');
      $(this).html('Activado');
      $(this).attr('estadoUnidad',0);

    }
 

})












