<?php 
/**
 * 
 */
class ControladorNivelinferencial 
{

		/* Registro de Nivelinferencial */

	static public function ctrCrearNivelinferencial(){

		if($_POST["accion"]=="NuevoNivelinferencial"){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["descripcion"])){

				$ruta="";

				$tabla = "nivel_inferencial";

				$datos = array("descripcion" => $_POST["descripcion"]);

				$respuesta = ModeloNivelinferencial::mdlIngresarNivelinferencial($tabla, $datos);
			
				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El nivel inferencial ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "nivelinferencial";

						}

					});

					</script>';


				}	

			}else{

				echo '<script>
					swal({
						type: "error",
						title: "¡El nivel inferencial no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm:false

					}).then((result)=>{

						if(result.value){

							window.location = "nivelinferencial";

						}

					});
				</script>';

			}


		}


	}

		

	/*=============================================
	MOSTRAR NIVELinferencial
	=============================================*/

	static public function ctrMostrarNivelinferencial($item, $valor){

		$tabla = "nivel_inferencial";

		$respuesta = ModeloNivelinferencial::MdlMostrarNivelinferencial($tabla, $item, $valor);

		return $respuesta;
	}
		/*============================================================
		=            Editar nivelinferencial          =
		============================================================*/
	static public function ctrEditarNivelinferencial(){

		if($_POST["accion"]=="EditarNivelinferencial"){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["descripcion"])){

				$tabla = "nivel_inferencial";
				$datos = array("descripcion" => $_POST["descripcion"],"id_nivel_inferencial" => $_POST["idNivelinferencial"]);

				$respuesta = ModeloNivelinferencial::mdlEditarNivelinferencial($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El nivel inferencial ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "nivelinferencial";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El nivel inferencial no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "nivelinferencial";

							}
						})

			  	</script>';

			}

		}

	}




	/*=============================================
	BORRAR NIVELinferencial
	=============================================*/

	static public function ctrBorrarNivelinferencial(){

		if(isset($_GET["idNivelinferencial"])){

			$tabla ="nivel_inferencial";
			$datos = $_GET["idNivelinferencial"];

			$respuesta = ModeloNivelinferencial::mdlBorrarNivelinferencial($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El nivel inferencial ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "nivelinferencial";

								}
							})

				</script>';

			}		

		}

	}












}