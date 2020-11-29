<?php 
/**
 * 
 */
class ControladorGrado 
{

		/* Registro de Grado */

	static public function ctrCrearGrado(){

		if($_POST["accion"]=="NuevoGrado"){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombre"])){

				$ruta="";

				$tabla = "grado";

				$datos = array("nombre" => $_POST["nombre"]);

				$respuesta = ModeloGrado::mdlIngresarGrado($tabla, $datos);
			
				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El grado ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "grado";

						}

					});

					</script>';


				}	

			}else{

				echo '<script>
					swal({
						type: "error",
						title: "¡El Grado no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm:false

					}).then((result)=>{

						if(result.value){

							window.location = "grado";

						}

					});
				</script>';

			}


		}


	}

		

	/*=============================================
	MOSTRAR GRADO
	=============================================*/

	static public function ctrMostrarGrado($item, $valor){

		$tabla = "grado";

		$respuesta = ModeloGrado::MdlMostrarGrado($tabla, $item, $valor);

		return $respuesta;
	}
		/*============================================================
		=            Editar grado          =
		============================================================*/
	static public function ctrEditarGrado(){

		if($_POST["accion"]=="EditarGrado"){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombre"])){

				$tabla = "grado";
				$datos = array("nombre" => $_POST["nombre"],"id_grado" => $_POST["idGrado"]);

				$respuesta = ModeloGrado::mdlEditarGrado($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El grado ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "grado";

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

							window.location = "grado";

							}
						})

			  	</script>';

			}

		}

	}




	/*=============================================
	BORRAR GRADO
	=============================================*/

	static public function ctrBorrarGrado(){

		if(isset($_GET["idGrado"])){

			$tabla ="grado";
			$datos = $_GET["idGrado"];

			$respuesta = ModeloGrado::mdlBorrarGrado($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El grado ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "grado";

								}
							})

				</script>';

			}		

		}

	}












}