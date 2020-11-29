<?php 
/**
 * 
 */
class ControladorNivelliteral 
{

		/* Registro de Nivelliteral */

	static public function ctrCrearNivelliteral(){

		if($_POST["accion"]=="NuevoNivelliteral"){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["descripcion"])){

				$ruta="";

				$tabla = "nivel_literal";

				$datos = array("descripcion" => $_POST["descripcion"]);

				$respuesta = ModeloNivelliteral::mdlIngresarNivelliteral($tabla, $datos);
			
				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El nivel literal ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "nivelliteral";

						}

					});

					</script>';


				}	

			}else{

				echo '<script>
					swal({
						type: "error",
						title: "¡El nivel literal no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm:false

					}).then((result)=>{

						if(result.value){

							window.location = "nivelliteral";

						}

					});
				</script>';

			}


		}


	}

		

	/*=============================================
	MOSTRAR NIVELliteral
	=============================================*/

	static public function ctrMostrarNivelliteral($item, $valor){

		$tabla = "nivel_literal";

		$respuesta = ModeloNivelliteral::MdlMostrarNivelliteral($tabla, $item, $valor);

		return $respuesta;
	}
		/*============================================================
		=            Editar nivelliteral          =
		============================================================*/
	static public function ctrEditarNivelliteral(){

		if($_POST["accion"]=="EditarNivelliteral"){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["descripcion"])){

				$tabla = "nivel_literal";
				$datos = array("descripcion" => $_POST["descripcion"],"id_nivel_literal" => $_POST["idNivelliteral"]);

				$respuesta = ModeloNivelliteral::mdlEditarNivelliteral($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El nivel literal ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "nivelliteral";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El nivel literal no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "nivelliteral";

							}
						})

			  	</script>';

			}

		}

	}




	/*=============================================
	BORRAR NIVELliteral
	=============================================*/

	static public function ctrBorrarNivelliteral(){

		if(isset($_GET["idNivelliteral"])){

			$tabla ="nivel_literal";
			$datos = $_GET["idNivelliteral"];

			$respuesta = ModeloNivelliteral::mdlBorrarNivelliteral($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El nivel literal ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "nivelliteral";

								}
							})

				</script>';

			}		

		}

	}












}