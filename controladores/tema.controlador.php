<?php 
/**
 * 
 */
class ControladorTema 
{

		/* Registro de Tema */

	static public function ctrCrearTema(){

		if($_POST["accion"]=="NuevoTema"){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombre"])){

				$ruta="";

				$tabla = "tema";

				$datos = array("nombre" => $_POST["nombre"],"id_sesion" => $_POST["idSesion"]);

				$respuesta = ModeloTema::mdlIngresarTema($tabla, $datos);
			
				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El tema ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "tema";

						}

					});

					</script>';


				}	

			}else{

				echo '<script>
					swal({
						type: "error",
						title: "¡El tema no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm:false

					}).then((result)=>{

						if(result.value){

							window.location = "tema";

						}

					});
				</script>';

			}


		}


	}

		

	/*=============================================
	MOSTRAR TEMA
	=============================================*/

	static public function ctrMostrarTema($item, $valor){

		$tabla = "tema";

		$respuesta = ModeloTema::MdlMostrarTema($tabla, $item, $valor);

		return $respuesta;
	}
	static public function ctrMostrarTema1($item, $valor){

		$tabla = "tema";

		$respuesta = ModeloTema::MdlMostrarTema1($tabla, $item, $valor);

		return $respuesta;
	}
		/*============================================================
		=            Editar tema          =
		============================================================*/
	static public function ctrEditarTema(){

		if($_POST["accion"]=="EditarTema"){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombre"])){

				$tabla = "tema";
				$datos = array("nombre" => $_POST["nombre"],"id_unidad" => $_POST["idUnidad"],"id_tema" => $_POST["idTema"]);

				$respuesta = ModeloTema::mdlEditarTema($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El tema ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "tema";

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
	BORRAR TEMA
	=============================================*/

	static public function ctrBorrarTema(){

		if(isset($_GET["idTema"])){

			$tabla ="tema";
			$datos = $_GET["idTema"];

			$respuesta = ModeloTema::mdlBorrarTema($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El tema ha sido borrado correctamente",
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












}