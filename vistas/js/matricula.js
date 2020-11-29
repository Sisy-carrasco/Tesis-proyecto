/*=============================================
EDITAR MATRICULA
=============================================*/

$(document).on("click",".btnEditarMatricula", function(){

 var idMatricula=$(this).attr("idMatricula");
 //console.log("idUsuario",idUsuario);

 var datos = new FormData();

datos.append("idMatricula",idMatricula);  //$post ,nombre ded la variable

$.ajax({
  url:"ajax/matricula.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta){
      //console.log("respuesta",respuesta);
     $("#idAlumno").val(respuesta["id_alumno"]);
     $("#idGrado").val(respuesta["id_grado"]);
     generarSeccion(respuesta["id_grado"],respuesta["id_seccion"]); 
     generarProfesorMatricula(respuesta["id_seccion"],respuesta["id_profesor"]);
     $("#idCurso").val(respuesta["id_curso"]);
     $("#idProfesor").val(respuesta["id_profesor"]);
     $("#accion").val("EditarMatricula");
     $("#titleMatricula").html("Editar Matricula");
     $("#idMatricula").val(idMatricula);

  }

});

})

$(document).on("click",".btnEditarDetalleMatricula", function(){

  var idDetalleMatricula=$(this).attr("idDetalleMatricula");
  //console.log("idUsuario",idUsuario);
 
  var datos = new FormData();
 
 datos.append("idDetalleMatricula",idDetalleMatricula);  //$post ,nombre ded la variable
 
 $.ajax({
   url:"ajax/matricula.ajax.php",
     method: "POST",
     data: datos,
     cache: false,
     contentType: false,
     processData: false,
     dataType: "json",
     success: function(respuesta){
       //console.log("respuesta",respuesta);
      $("#idGrado").val(respuesta["id_grado"]);
      generarSeccion(respuesta["id_grado"],respuesta["id_seccion"]); 
      $("#idProfesor").val(respuesta["id_profesor"]);
      $("#accion").val("EditarDetalleMatricula");
      $("#titleMatricula").html("Editar Asignación Docente");
      $("#idDetalleMatricula").val(idDetalleMatricula);
 
   }
 
 });
 
 })

/*=============================================
ELIMINAR MATRICULA
=============================================*/
$(document).on("click", ".btnEliminarMatricula", function(){

  var idSesion = $(this).attr("idMatricula");
  
  swal({
    title: '¿Está seguro de dar de baja la matricula?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, dar de baja la matricula!'
  }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=matricula&idMatricula="+idSesion;

    }

  })

})

$(document).on("click", ".btnEliminarDetalleMatricula", function(){

  var idSesion = $(this).attr("idDetalleMatricula");
  
  swal({
    title: '¿Está seguro de dar de baja la asignación de docente?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, dar de asignación de docente!'
  }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=asignacionmatricula&idDetalleMatricula="+idSesion;

    }

  })

})

function generarSeccion(id_grado,id_seccion){
  var datos = new FormData();
  datos.append("idGrado", id_grado);

   $.ajax({
      url:"ajax/matricula.ajax.php",
      method:"POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success:function(respuesta){
        $("#idSeccion").html(respuesta);
        $("#idSeccion").val(id_seccion);
      }

  })
}

function generarProfesorMatricula(id_seccion,id_profesor){
  var datos = new FormData();
  datos.append("idSeccion", id_seccion);

   $.ajax({
      url:"ajax/matricula.ajax.php",
      method:"POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success:function(respuesta){
        $("#idProfesor").html(respuesta);
        $("#idProfesor").val(id_profesor);
      }

  })
}

$(document).on("click",".btnMostrarMatricula", function(){

  var idMatricula=$(this).attr("idMatricula");
  //console.log("idUsuario",idUsuario);
 
  var datos = new FormData();
 
 datos.append("idMatricula",idMatricula);  //$post ,nombre ded la variable
 
 $.ajax({
   url:"ajax/matricula.ajax.php",
     method: "POST",
     data: datos,
     cache: false,
     contentType: false,
     processData: false,
     dataType: "json",
     success: function(respuesta){
       //console.log("respuesta",respuesta);
      $("#idAlumno").val(respuesta["id_alumno"]);
      $("#idGrado").val(respuesta["id_grado"]);
      generarSeccion(respuesta["id_grado"],respuesta["id_seccion"]); 
      $("#idCurso").val(respuesta["id_curso"]);
      $("#idProfesor").val(respuesta["id_profesor"]);
      $("#accion").val("EditarSesion");
      $("#titleMatricula").html("Mostrar Matricula");
      $("#idMatricula").val(idMatricula);
 
   }
 
 });
 
 })














