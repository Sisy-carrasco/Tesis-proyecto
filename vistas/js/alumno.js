/*=============================================
SUBIENDO LA FOTO DEL USUARIO
=============================================*/
$(".foto").change(function(){

	var imagen = this.files[0];
	console.log("imagen",imagen);

	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$(".foto").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });
        /*2000000 = 2MD*/
  		}else if(imagen["size"]>2000000){

  			 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  		}else{
  			var datosImagen = new FileReader;
  			datosImagen.readAsDataURL(imagen);

  			$(datosImagen).on("load",function(event){
  				var rutaImagen= event.target.result;

  				$(".previsualizar").attr("src",rutaImagen);
  			})
  		}
  	})

/*=============================================
EDITAR ALUMNO
=============================================*/

$(document).on("click",".btnEditarAlumno", function(){

 var idAlumno=$(this).attr("idAlumno");
 //console.log("idUsuario",idUsuario);

 var datos = new FormData();

datos.append("idAlumno",idAlumno);  //$post ,nombre ded la variable

$.ajax({
  url:"ajax/alumno.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta){
      //console.log("respuesta",respuesta);
      var ls = respuesta["nombres_completos"].split(" ");console.log(ls);
      var nombres='',apellidos='';
      for(c=0;c<ls.length;c++){
        if(c>1){
          nombres=nombres+" "+ls[c];
        }else{
          apellidos=apellidos+" "+ls[c];
        }
      }
     $("#nombres").val(nombres.trim());
     $("#apellidos").val(apellidos.trim());
     $("#dniprofesor").val(respuesta["dni"]);
     $("#direccion").val(respuesta["direccion"]);
     $("#fecha_nacimiento").val(respuesta["fecha_nacimiento"]);
     $("#sexo").val(respuesta["sexo"]);
     $("#direccion").val(respuesta["direccion"]);
     $("#fotoActual").val(respuesta["foto"]);
     $("#passwordActual").val(respuesta["password"]);
     $("#idAlumno").val(respuesta["id_alumno"]);
     $('#accion').val('EditarAlumno');
     $("#titleAlumno").html("Editar Estudiante");
     $(".usuario").css('display','none');
     $("#password").val('-');
     $("#usuario").val("-");

     if(respuesta["foto"] !=""){

      $(".previsualizar").attr("src",respuesta["foto"]);

     }

  }

});

})


/*=============================================
REVISAR SI EL USUARIO YA ESTÁ REGISTRADO
=============================================*/

$("#usuario").change(function(){

  $(".alert").remove();

  var usuario = $(this).val();

  var datos = new FormData();
  datos.append("validarUsuario", usuario);

   $.ajax({
      url:"ajax/usuarios.ajax.php",
      method:"POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success:function(respuesta){
        
        if(respuesta){

          $("#usuario").parent().after('<div class="alert alert-warning">Este usuario ya existe en la base de datos</div>');

          $("#usuario").val("");

        }

      }

  })
})

$("#dniprofesor").change(function(){

  $(".alert").remove();

  var usuario = $(this).val();

  var datos = new FormData();
  datos.append("validarUsuario", usuario);

   $.ajax({
      url:"ajax/profesor.ajax.php",
      method:"POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success:function(respuesta){
        
        if(respuesta){

          $("#usuario").parent().after('<div class="alert alert-warning">Este dni ya existe en la base de datos</div>');

          $("#usuario").val("");

        }

      }

  })
})

/*=============================================
ELIMINAR ALUMNO
=============================================*/
$(document).on("click", ".btnEliminarAlumno", function(){

  var idAlumno = $(this).attr("idAlumno");
  
  swal({
    title: '¿Está seguro de dar de baja al alumno?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, dar de baja alumno!'
  }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=alumno&idAlumno="+idAlumno;

    }

  })

})



function isValidDate(day,month,year){
  var dteDate;

  // En javascript, el mes empieza en la posicion 0 y termina en la 11 
  //   siendo 0 el mes de enero
  // Por esta razon, tenemos que restar 1 al mes
  month=month-1;
  // Establecemos un objeto Data con los valore recibidos
  // Los parametros son: año, mes, dia, hora, minuto y segundos
  // getDate(); devuelve el dia como un entero entre 1 y 31
  // getDay(); devuelve un num del 0 al 6 indicando siel dia es lunes,
  //   martes, miercoles ...
  // getHours(); Devuelve la hora
  // getMinutes(); Devuelve los minutos
  // getMonth(); devuelve el mes como un numero de 0 a 11
  // getTime(); Devuelve el tiempo transcurrido en milisegundos desde el 1
  //   de enero de 1970 hasta el momento definido en el objeto date
  // setTime(); Establece una fecha pasandole en milisegundos el valor de esta.
  // getYear(); devuelve el año
  // getFullYear(); devuelve el año
  dteDate=new Date(year,month,day);

  //Devuelva true o false...
  return ((day==dteDate.getDate()) && (month==dteDate.getMonth()) && (year==dteDate.getFullYear()));
}

function validate_fecha(fecha){
  var patron=new RegExp("^(19|20)+([0-9]{2})([-])([0-9]{1,2})([-])([0-9]{1,2})$");

  if(fecha.search(patron)==0)
  {
      var values=fecha.split("-");
      if(isValidDate(values[2],values[1],values[0]))
      {
          return true;
      }
  }
  return false;
}

function validarFechaAlumno(fecha ){
  if(validate_fecha(fecha)==true)
  {
      // Si la fecha es correcta, calculamos la edad
      var values=fecha.split("-");
      var dia = values[2];
      var mes = values[1];
      var ano = values[0];

      // cogemos los valores actuales
      var fecha_hoy = new Date();
      var ahora_ano = fecha_hoy.getYear();
      var ahora_mes = fecha_hoy.getMonth()+1;
      var ahora_dia = fecha_hoy.getDate();

      // realizamos el calculo
      var edad = (ahora_ano + 1900) - ano;
      if ( ahora_mes < mes )
      {
          edad--;
      }
      if ((mes == ahora_mes) && (ahora_dia < dia))
      {
          edad--;
      }
      if (edad > 1900)
      {
          edad -= 1900;
      }

      // calculamos los meses
      var meses=0;
      if(ahora_mes>mes)
          meses=ahora_mes-mes;
      if(ahora_mes<mes)
          meses=12-(mes-ahora_mes);
      if(ahora_mes==mes && dia>ahora_dia)
          meses=11;

      // calculamos los dias
      var dias=0;
      if(ahora_dia>dia)
          dias=ahora_dia-dia;
      if(ahora_dia<dia)
      {
          ultimoDiaMes=new Date(ahora_ano, ahora_mes, 0);
          dias=ultimoDiaMes.getDate()-(dia-ahora_dia);
      }

      //document.getElementById("result").innerHTML="Tienes "+edad+" años, "+meses+" meses y "+dias+" días";
      if(edad!=10 && edad!=11){
        alert("El estudiante tiene una edad no valida, edad "+edad);
      }
  }else{
      alert("La fecha "+fecha+" es incorrecta");
  }
}

