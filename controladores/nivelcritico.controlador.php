<?php 
/**
 * 
 */
class ControladorNivelcritico 
{

		/* Registro de Nivelcritico */

	static public function ctrCrearNivelcritico(){

		if($_POST["accion"]=="NuevoNivelcritico"){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["descripcion"])){

				$ruta="";

				$tabla = "nivel_critico";

				$datos = array("descripcion" => $_POST["descripcion"]);

				$respuesta = ModeloNivelcritico::mdlIngresarNivelcritico($tabla, $datos);
			
				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El nivel critico ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "nivelcritico";

						}

					});

					</script>';


				}	

			}else{

				echo '<script>
					swal({
						type: "error",
						title: "¡El nivel critico no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm:false

					}).then((result)=>{

						if(result.value){

							window.location = "nivelcritico";

						}

					});
				</script>';

			}


		}


	}

		

	/*=============================================
	MOSTRAR NIVELCRITICO
	=============================================*/

	static public function ctrMostrarNivelcritico($item, $valor){

		$tabla = "nivel_critico";

		$respuesta = ModeloNivelcritico::MdlMostrarNivelcritico($tabla, $item, $valor);

		return $respuesta;
	}
		/*============================================================
		=            Editar nivelcritico          =
		============================================================*/
	static public function ctrEditarNivelcritico(){

		if($_POST["accion"]=="EditarNivelcritico"){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["descripcion"])){

				$tabla = "nivel_critico";
				$datos = array("descripcion" => $_POST["descripcion"],"id_nivel_critico" => $_POST["idNivelcritico"]);

				$respuesta = ModeloNivelcritico::mdlEditarNivelcritico($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El nivel critico ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "nivelcritico";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El nivel critico no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "nivelcritico";

							}
						})

			  	</script>';

			}

		}

	}




	/*=============================================
	BORRAR NIVELCRITICO
	=============================================*/

	static public function ctrBorrarNivelcritico(){

		if(isset($_GET["idNivelcritico"])){

			$tabla ="nivel_critico";
			$datos = $_GET["idNivelcritico"];

			$respuesta = ModeloNivelcritico::mdlBorrarNivelcritico($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El nivel critico ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "nivelcritico";

								}
							})

				</script>';

			}		

		}

	}












}