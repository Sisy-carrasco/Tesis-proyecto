/*=============================================
EDITAR EXAMEN
=============================================*/

$(document).on("click",".btnEditarExamen", function(){

  var idExamen=$(this).attr("idExamen");
  //console.log("idUsuario",idUsuario);

  var datos = new FormData();

  datos.append("idExamen",idExamen);  //$post ,nombre ded la variable

  $.ajax({
    url:"ajax/examen.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(respuesta){
        //console.log("respuesta",respuesta);
      $("#nombre").val(respuesta["nombre"]);
      $("#fecha_inicio").val(respuesta["fecha_inicio"]);
      $("#fecha_fin").val(respuesta["fecha_fin"]);
      $("#fecha_nacimiento").val(respuesta["fecha_nacimiento"]);
      $("#tiempo").val(respuesta["tiempo"]);
      $("#idGrado").val(respuesta["id_grado"]);
      $("#idUnidad").val(respuesta["id_unidad"]);
      $("#idExamen").val(respuesta["id_examen"]);
      $("#idNivelCritico").val(respuesta["id_nivel_critico"]);
      $("#idNivelInferencial").val(respuesta["id_nivel_inferencial"]);
      $("#idNivelLiteral").val(respuesta["id_nivel_literal"]);
      generarSeccionExamen(respuesta["id_grado"],respuesta["id_seccion"]);
      generarCursoExamen(respuesta["id_grado"],respuesta["id_curso"]);
      generarTema(respuesta["id_unidad"],respuesta["id_tema"]);
      generarLecturaExamen(respuesta["id_tema"],respuesta["id_lectura"]);
      generarSesionExamen(respuesta["id_unidad"],respuesta["id_sesion_critico"],respuesta["id_sesion_inferencial"],respuesta["id_sesion_literal"]);
      $('#accion').val('EditarExamen');
      $("#titleExamen").html("Editar Examen");
      agregarDetalleExamen(idExamen,"Critico");
      agregarDetalleExamen(idExamen,"Literal");
      agregarDetalleExamen(idExamen,"Inferencial");
    }

  });

})


/*=============================================
ELIMINAR EXAMEN
=============================================*/
$(document).on("click", ".btnEliminarExamen", function(){

  var idExamen = $(this).attr("idExamen");
  
  swal({
    title: '¿Está seguro de borrar el examen?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar examen!'
  }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=examen&idExamen="+idExamen;

    }

  })

})

function generarSeccionExamen(id_grado,id_seccion){
  var datos = new FormData();
  datos.append("idGrado", id_grado);

   $.ajax({
      url:"ajax/examen.ajax.php",
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

function generarCursoExamen(id_grado,id_curso){

  var datos = new FormData();
  datos.append("idGrado2", id_grado);

   $.ajax({
      url:"ajax/examen.ajax.php",
      method:"POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success:function(respuesta){
        $("#idCurso").html(respuesta);
        $("#idCurso").val(id_curso);
      }

  })
}

function generarLecturaExamen(id_tema,id_lectura){

  var datos = new FormData();
  datos.append("idTema", id_tema);

   $.ajax({
      url:"ajax/examen.ajax.php",
      method:"POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success:function(respuesta){
        $("#idLectura").html(respuesta);
        $("#idLectura").val(id_lectura);
      }

  })
}

function generarSesionExamen(id_unidad,id_sesioncritico,id_sesioninferencial,idSesionLiteral){

  var datos = new FormData();
  datos.append("idUnidad", id_unidad);

   $.ajax({
      url:"ajax/examen.ajax.php",
      method:"POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success:function(respuesta){
        $("#idSesionCritico").html(respuesta);
        $("#idSesionCritico").val(id_sesioncritico);
        $("#idSesionInferencial").html(respuesta);
        $("#idSesionInferencial").val(id_sesioninferencial);
        $("#idSesionLiteral").html(respuesta);
        $("#idSesionLiteral").val(idSesionLiteral);
      }

  })
}

function agregarPregunta(tabla){
  var id= tabla + Math.round(Math.random()*10000);
  $("#tb"+tabla).append("<tr id='tr"+id+"'><td><select onchange=\"mostrarOpcion(this.value,'"+id+"');\" id='cboTipoPregunta"+id+"' name='cboTipoPregunta"+id+"' class='form-control input-lg'><option value='3'>Respuesta Libre</option><option value='2'>Opcion</option></select></td>"+
          "<td><textarea id='txtNombre"+id+"' name='txtNombre"+id+"' class='form-control input-lg'></textarea></td>"+
          "<td><textarea id='txtDescripcion"+id+"' name='txtDescripcion"+id+"' class='form-control input-lg'></textarea></td>"+
          "<td><textarea id='txtLibre"+id+"' name='txtLibre"+id+"' class='form-control input-lg'></textarea>"+
              "<input type='hidden' id='txtListaOpcion"+id+"' name='txtListaOpcion"+id+"' value='' />"+
              "<input type='hidden' id='txtOpcionCorrecto"+id+"' name='txtOpcionCorrecto"+id+"' value='' />"+
              "<table class='table table-bordered table-striped' id='tbOpcion"+id+"' style='display:none;'>"+
                "<thead>"+
                  "<tr><th class='text-center'>Opcion</th><th class='text-center'>Correcto</th><th><button type='button' class='btn btn-xs btn-info' onclick=\"agregarOpcion('"+id+"')\"><i class='fa fa-plus'></i></button></th></tr>"+
                "</thead>"+
              "</table>"+
          "</td>"+
          "<td><input type='number' id='txtPuntaje"+id+"' name='txtPuntaje"+id+"' value='0' class='form-control input-lg' style='width: 100px !important;' /></td>"+
          "<td><a href='#' onclick=\"quitarPregunta('"+tabla+"','"+id+"')\" class='btn btn-danger'><i class='fa fa-minus'></i></a></td>"+
          "</tr>");
  if($("#txtLista"+tabla).val()!=""){
    var carro = $("#txtLista"+tabla).val().split(",");
  }else{
    var carro = new Array();
  }
  carro.push(id);
  $("#txtLista"+tabla).val(carro);
}

function quitarPregunta(tabla,id){
  $("#tr"+id).remove();
  if($("#txtLista"+tabla).val()!=""){
    var carro = $("#txtLista"+tabla).val().split(",");
  }else{
    var carro = new Array();
  }
  for(c=0; c < carro.length; c++){
    if(carro[c] == id) {
        carro.splice(c,1);
    }
  }
  $("#txtLista"+tabla).val(carro);
}

function mostrarOpcion(valor,id){
  if(valor=='3'){
    $('#txtLibre'+id).css('display','');
    $("#tbOpcion"+id).css('display','none');
  }else{
    $('#txtLibre'+id).css('display','none');
    $("#tbOpcion"+id).css('display','');
  }
}

function agregarOpcion(tabla){
  var id= "tbOpcion" + tabla + Math.round(Math.random()*10000);
  $("#tbOpcion"+tabla).append("<tr id='tr"+id+"'>"+
          "<td><textarea id='txtOpcion"+id+"' name='txtOpcion"+id+"' class='form-control input-lg'></textarea></td>"+
          "<td class='text-center'><input type='radio' name='rdOpcion"+tabla+"' onclick=\"$('#txtOpcionCorrecto"+tabla+"').val('"+id+"')\" /></td>"+
          "<td><a href='#' onclick=\"quitarOpcion('"+tabla+"','"+id+"')\" class='btn btn-danger btn-xs'><i class='fa fa-minus'></i></a></td>"+
        "<tr>");
  if($("#txtListaOpcion"+tabla).val()!=""){
    var carro = $("#txtListaOpcion"+tabla).val().split(",");
  }else{
    var carro = new Array();
  }
  carro.push(id);
  $("#txtListaOpcion"+tabla).val(carro);
}

function quitarOpcion(tabla,id){
  $("#tr"+id).remove();
  if($("#txtListaOpcion"+tabla).val()!=""){
    var carro = $("#txtListaOpcion"+tabla).val().split(",");
  }else{
    var carro = new Array();
  }
  for(c=0; c < carro.length; c++){
    if(carro[c] == id) {
        carro.splice(c,1);
    }
  }
  $("#txtListaOpcion"+tabla).val(carro);
}

function agregarDetalleExamen(id_examen,tabla){
  var datos = new FormData();
  datos.append("idExamenDetalle", id_examen);
  datos.append("tabla", tabla);

   $.ajax({
      url:"ajax/examen.ajax.php",
      method:"POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success:function(respuesta){
        $("#tb"+tabla).html(" ");
        $("#tb"+tabla).append(respuesta);
        $("#txtLista"+tabla).val($("#txtListaId"+tabla).val());
      }

  })
}

$(document).on("click",".btnExamenCritico", function(){

  var idExamen=$(this).attr("idExamen");
  //console.log("idUsuario",idUsuario);

  var datos = new FormData();

  datos.append("idExamenCritico",idExamen);  //$post ,nombre ded la variable

  $.ajax({
    url:"ajax/examen.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(respuesta){
        //console.log("respuesta",respuesta);
      $("#nombre").val(respuesta["nombre"]);
      $("#sesion").val(respuesta["sesion"]);
      $("#idExamen").val(respuesta["id_examen"]);
      $("#fecha_inicio").val(respuesta["fecha_inicio"]);
      $("#fecha_fin").val(respuesta["fecha_fin"]);
      $("#lectura").val(respuesta["lectura"]);
      $("#divDetalle").html(respuesta["detalle"]);
      $("#titleExamen").html("Resolver Examen Critico");
      $('#accion').val('ResolverCritico');
      $("#btnResponderExamen").css("display","");
      $("#btnReiniciarExamen").css("display","none");
      if(respuesta["archivo"] !=""){

        $("#btnLectura").attr("onclick","window.open('"+respuesta["archivo"]+"','_blank')");

      }

    }

  });

})

$(document).on("click",".btnExamenInferencial", function(){

  var idExamen=$(this).attr("idExamen");
  //console.log("idUsuario",idUsuario);

  var datos = new FormData();

  datos.append("idExamenInferencial",idExamen);  //$post ,nombre ded la variable

  $.ajax({
    url:"ajax/examen.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(respuesta){
        //console.log("respuesta",respuesta);
      $("#nombre").val(respuesta["nombre"]);
      $("#sesion").val(respuesta["sesion"]);
      $("#idExamen").val(respuesta["id_examen"]);
      $("#fecha_inicio").val(respuesta["fecha_inicio"]);
      $("#fecha_fin").val(respuesta["fecha_fin"]);
      $("#lectura").val(respuesta["lectura"]);
      $("#divDetalle").html(respuesta["detalle"]);
      $("#titleExamen").html("Resolver Examen Inferencial");
      $('#accion').val('ResolverInferencial');
      $("#btnResponderExamen").css("display","");
      $("#btnReiniciarExamen").css("display","none");
      if(respuesta["archivo"] !=""){

        $("#btnLectura").attr("onclick","window.open('"+respuesta["archivo"]+"','_blank')");

      }

    }

  });

})

$(document).on("click",".btnExamenLiteral", function(){

  var idExamen=$(this).attr("idExamen");
  //console.log("idUsuario",idUsuario);

  var datos = new FormData();

  datos.append("idExamenLiteral",idExamen);  //$post ,nombre ded la variable

  $.ajax({
    url:"ajax/examen.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(respuesta){
        //console.log("respuesta",respuesta);
      $("#nombre").val(respuesta["nombre"]);
      $("#sesion").val(respuesta["sesion"]);
      $("#idExamen").val(respuesta["id_examen"]);
      $("#fecha_inicio").val(respuesta["fecha_inicio"]);
      $("#fecha_fin").val(respuesta["fecha_fin"]);
      $("#lectura").val(respuesta["lectura"]);
      $("#divDetalle").html(respuesta["detalle"]);
      $("#titleExamen").html("Resolver Examen Literal");
      $('#accion').val('ResolverLiteral');
      $("#btnResponderExamen").css("display","");
      $("#btnReiniciarExamen").css("display","none");
      if(respuesta["archivo"] !=""){

        $("#btnLectura").attr("onclick","window.open('"+respuesta["archivo"]+"','_blank')");

      }

    }

  });

})

function verExamen(tabla,idexamen){
  var datos = new FormData();

  datos.append("idExamenRespuesta",idexamen);  //$post ,nombre ded la variable
  datos.append("tabla",tabla);

  $.ajax({
    url:"ajax/examen.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(respuesta){
        //console.log("respuesta",respuesta);
      $("#nombre").val(respuesta["nombre"]);
      $("#sesion").val(respuesta["sesion"]);
      $("#accion").val("ReiniciarExamen");
      $("#idExamen").val(respuesta["id_examen"]);
      $("#fecha_inicio").val(respuesta["fecha_inicio"]);
      $("#fecha_fin").val(respuesta["fecha_fin"]);
      $("#lectura").val(respuesta["lectura"]);
      $("#divDetalle").html(respuesta["detalle"]);
      $("#titleExamen").html("Resolver Examen Literal");
      $("#btnResponderExamen").css("display","none");
      $("#btnReiniciarExamen").css("display","");
      if(respuesta["eliminado"]>0){
        $("#btnReiniciarExamen").css("display","none");
      }
      if(respuesta["archivo"] !=""){

        $("#btnLectura").attr("onclick","window.open('"+respuesta["archivo"]+"','_blank')");

      }
      $("#tabla").val(tabla);
    }

  });
}