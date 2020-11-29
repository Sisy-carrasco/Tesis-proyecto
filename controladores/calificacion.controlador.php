<?php 
/**
 * 
 */
class ControladorCalificacion 
{

		/* Registro de Calificacion */

	static public function ctrCrearCalificacion(){

		if($_POST["accion"]=="NuevoCalificacion"){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["letra"])){

				$ruta="";

				$tabla = "calificacion";

				$datos = array("letra" => $_POST["letra"],"valor_minimo"=>$_POST["valorMinimo"],"valor_maximo"=>$_POST["valorMaximo"]);

				$respuesta = ModeloCalificacion::mdlIngresarCalificacion($tabla, $datos);
			
				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡La calificacion ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "calificacion";

						}

					});

					</script>';


				}	

			}else{

				echo '<script>
					swal({
						type: "error",
						title: "¡La calificacion no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm:false

					}).then((result)=>{

						if(result.value){

							window.location = "calificacion";

						}

					});
				</script>';

			}


		}


	}

		

	/*=============================================
	MOSTRAR CALIFICACION
	=============================================*/

	static public function ctrMostrarCalificacion($item, $valor){

		$tabla = "calificacion";

		$respuesta = ModeloCalificacion::MdlMostrarCalificacion($tabla, $item, $valor);

		return $respuesta;
	}
		/*============================================================
		=            Editar calificacion          =
		============================================================*/
	static public function ctrEditarCalificacion(){

		if($_POST["accion"]=="EditarCalificacion"){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["letra"])){

				$tabla = "calificacion";
				$datos = array("letra" => $_POST["letra"],"valor_minimo"=>$_POST["valorMinimo"],"valor_maximo"=>$_POST["valorMaximo"],"id_calificacion" => $_POST["idCalificacion"]);

				$respuesta = ModeloCalificacion::mdlEditarCalificacion($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La calificacion ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "calificacion";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La letra no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "calificacion";

							}
						})

			  	</script>';

			}

		}

	}




	/*=============================================
	BORRAR CALIFICACION
	=============================================*/

	static public function ctrBorrarCalificacion(){

		if(isset($_GET["idCalificacion"])){

			$tabla ="calificacion";
			$datos = $_GET["idCalificacion"];

			$respuesta = ModeloCalificacion::mdlBorrarCalificacion($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La calificacion ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "calificacion";

								}
							})

				</script>';

			}		

		}

	}












}