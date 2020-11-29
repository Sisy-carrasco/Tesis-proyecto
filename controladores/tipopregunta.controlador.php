<?php 
/**
 * 
 */
class ControladorTipopregunta 
{

		/* Registro de Tipopregunta */

	static public function ctrCrearTipopregunta(){

		if($_POST["accion"]=="NuevoTipopregunta"){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["descripcion"])){

				$ruta="";

				$tabla = "tipo_pregunta";

				$datos = array("descripcion" => $_POST["descripcion"]);

				$respuesta = ModeloTipopregunta::mdlIngresarTipopregunta($tabla, $datos);
			
				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El tipo de pregunta ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "tipopregunta";

						}

					});

					</script>';


				}	

			}else{

				echo '<script>
					swal({
						type: "error",
						title: "¡El Tipo de pregunta no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm:false

					}).then((result)=>{

						if(result.value){

							window.location = "tipopregunta";

						}

					});
				</script>';

			}


		}


	}

		

	/*=============================================
	MOSTRAR TIPOPREGUNTA
	=============================================*/

	static public function ctrMostrarTipopregunta($item, $valor){

		$tabla = "tipo_pregunta";

		$respuesta = ModeloTipopregunta::MdlMostrarTipopregunta($tabla, $item, $valor);

		return $respuesta;
	}
		/*============================================================
		=            Editar tipopregunta          =
		============================================================*/
	static public function ctrEditarTipopregunta(){

		if($_POST["accion"]=="EditarTipopregunta"){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["descripcion"])){

				$tabla = "tipo_pregunta";
				$datos = array("descripcion" => $_POST["descripcion"],"id_tipopregunta" => $_POST["idTipopregunta"]);

				$respuesta = ModeloTipopregunta::mdlEditarTipopregunta($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El tipo de pregunta ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "tipopregunta";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El Tipo de pregunta no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "tipopregunta";

							}
						})

			  	</script>';

			}

		}

	}




	/*=============================================
	BORRAR TIPOPREGUNTA
	=============================================*/

	static public function ctrBorrarTipopregunta(){

		if(isset($_GET["idTipopregunta"])){

			$tabla ="tipo_pregunta";
			$datos = $_GET["idTipopregunta"];

			$respuesta = ModeloTipopregunta::mdlBorrarTipopregunta($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El tipo de pregunta ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "tipopregunta";

								}
							})

				</script>';

			}		

		}

	}












}