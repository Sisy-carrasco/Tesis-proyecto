<?php 
/**
 * 
 */
class ControladorLectura 
{

		/* Registro de Lectura */

	static public function ctrCrearLectura(){

		if($_POST["accion"]=="NuevoLectura"){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombre"])){

				$ruta="";

				if(isset($_FILES["archivo"]["tmp_name"]) && $_FILES["archivo"]["tmp_name"]!=""){
					var_dump($_FILES["archivo"]["tmp_name"]); // verificar si el archivo temporal esta enviaando

					/* Creamos el directorio donde vamos a guardar la foto del usuario */
					$directorio="vistas/img/archivo/".$_POST["nombre"];
					//crear directorio
					mkdir($directorio,0755);

					/*============================================================
					=            Guardamos la imagen en el directorio          =
					============================================================*/
					$aleatorio=mt_rand(100,999);
					$ruta="vistas/img/archivo/".$_POST["nombre"]."/".$_FILES['archivo']['name'];
					move_uploaded_file($_FILES['archivo']['tmp_name'],  $ruta);
				
				}

				$tabla = "lectura";

				$datos = array("descripcion" => $_POST["nombre"],"archivo"=>"hola","id_tema"=>$_POST["idTema"],"id_sesion"=>$_POST["idSesion"]);
				// $datos = array("id_tema" => $_POST["idTema"],"id_sesion"=>$_POST["idSesion"]);


				$respuesta = ModeloLectura::mdlIngresarLectura($tabla, $datos);
			
				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El lectura ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "lectura";

						}

					});

					</script>';


				}	

			}else{

				echo '<script>
					swal({
						type: "error",
						title: "¡El lectura no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm:false

					}).then((result)=>{

						if(result.value){

							window.location = "lectura";

						}

					});
				</script>';

			}


		}


	}

		

	/*=============================================
	MOSTRAR LECTURA
	=============================================*/

	static public function ctrMostrarLectura($item, $valor){

		$tabla = "lectura";

		$respuesta = ModeloLectura::MdlMostrarLectura($tabla, $item, $valor);

		return $respuesta;
	}
		/*============================================================
		=            Editar lectura          =
		============================================================*/
	static public function ctrEditarLectura(){

		if($_POST["accion"]=="EditarLectura"){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombre"])){

				$ruta = $_POST["archivoAnterior"];

				if(isset($_FILES["archivo"]["tmp_name"]) && $_FILES["archivo"]["tmp_name"]!=""){
					var_dump($_FILES["archivo"]["tmp_name"]); // verificar si el archivo temporal esta enviaando

					$nuevoAlto=500;
					/* Creamos el directorio donde vamos a guardar la foto del usuario */
					$directorio="vistas/img/archivo/".$_POST["nombre"];
					//crear directorio
					mkdir($directorio,0755);

					/*============================================================
					=            Guardamos la imagen en el directorio          =
					============================================================*/

					$aleatorio=mt_rand(100,999);
					$ruta="vistas/img/archivo/".$_POST["nombre"]."/".$_FILES['archivo']['name'];
					move_uploaded_file($_FILES['archivo']['tmp_name'],  $ruta);
				
				}


				$tabla = "lectura";
				$datos = array("nombre" => $_POST["nombre"],"archivo" => $ruta,"id_tema" => $_POST["idTema"],"id_sesion"=>$_POST["idSesion"],"id_lectura" => $_POST["idLectura"]);

				$respuesta = ModeloLectura::mdlEditarLectura($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La lectura ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "lectura";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "tema";

							}
						})

			  	</script>';

			}

		}

	}




	/*=============================================
	BORRAR LECTURA
	=============================================*/

	static public function ctrBorrarLectura(){

		if(isset($_GET["idLectura"])){

			$tabla ="lectura";
			$datos = $_GET["idLectura"];

			$respuesta = ModeloLectura::mdlBorrarLectura($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La lectura ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "lectura";

								}
							})

				</script>';

			}		

		}

	}












}