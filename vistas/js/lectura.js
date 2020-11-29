/*=============================================
EDITAR LECTURA
=============================================*/

$(document).on("click",".btnEditarLectura", function(){

 var idLectura=$(this).attr("idLectura");
 //console.log("idUsuario",idUsuario);

 var datos = new FormData();

datos.append("idLectura",idLectura);  //$post ,nombre ded la variable

$.ajax({
  url:"ajax/lectura.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta){
      //console.log("respuesta",respuesta);
     $("#nombre").val(respuesta["descripcion"]);
     $("#idTemaa").val(respuesta["id_tema"]);
     $("#idUnidad").val(respuesta["id_unidad"]);
     $("#idSesion").val(respuesta["id_sesion"]);
     generarTema(respuesta["id_sesion"],respuesta["id_tema"]);
     $("#accion").val("EditarLectura");
     $("#titleLectura").html("Editar Lectura");
     $("#idLectura").val(idLectura);
     $("#archivoAnteriro").val(respuesta["archivo"]);

  }

});

})

/*=============================================
ELIMINAR LECTURA
=============================================*/
$(document).on("click", ".btnEliminarLectura", function(){

  var idLectura = $(this).attr("idLectura");
  
  swal({
    title: '¿Está seguro de borrar la lectura?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar lectura!'
  }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=lectura&idLectura="+idLectura;

    }

  })

})

function generarTema(id_sesion,id_tema){

  var datos = new FormData();
  console.log("idSesion",id_sesion);
  datos.append("idSesion", id_sesion);

   $.ajax({
      url:"ajax/lectura.ajax.php",
      method:"POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success:function(respuesta){
        console.log("respuesta",respuesta);
        $("#idTemaa").html(respuesta);
        $("#idTemaa").val(id_tema);
      }

  })
}

$(document).on("click",".btnMostrarLectura", function(){

  var idLectura=$(this).attr("idLectura");
  //console.log("idUsuario",idUsuario);
 
  var datos = new FormData();
 
 datos.append("idLectura",idLectura);  //$post ,nombre ded la variable
 
 $.ajax({
   url:"ajax/lectura.ajax.php",
     method: "POST",
     data: datos,
     cache: false,
     contentType: false,
     processData: false,
     dataType: "json",
     success: function(respuesta){
       //console.log("respuesta",respuesta);
      $("#nombre").val(respuesta["descripcion"]);
      $("#idTemaa").val(respuesta["id_tema"]);
      $("#idUnidad").val(respuesta["id_unidad"]);
      $("#idSesion").val(respuesta["id_sesion"]);
      generarTema(respuesta["id_sesion"],respuesta["id_tema"]);
      $("#accion").val("EditarLectura");
      $("#titleLectura").html("Mostrar Lectura");
      $("#idLectura").val(idLectura);
      $("#archivoAnteriro").val(respuesta["archivo"]);
 
   }
 
 });
 
 })














